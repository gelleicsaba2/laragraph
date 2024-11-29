import { Controller } from './Controller'
import { GraphqlService } from '../services/GraphqlService'
import { MessageController } from './MessageController'
import storage from '../services/Storage'

export class LoginController implements Controller {
    constructor() {
        console.log("LoginController construct")
    }
    async post() {
        const inputName = document.getElementById('login_form_name') as HTMLInputElement | null;
        const inputPass = document.getElementById('login_form_pass') as HTMLInputElement | null;
        const loginName = inputName?.value??"";
        const loginPass = inputPass?.value??"";
        const rsp = await (window["graphqlService"] as GraphqlService).loginUser(loginName, loginPass);
        if (rsp && rsp.success) {
            const hash = rsp.hash
            const fullname = rsp.fullname
            const email = rsp.email
            storage.storeValues({hash: hash, fullname: fullname, name: loginName, email: email})
            document.location.replace('/main')
        } else {
            if (! rsp.success && rsp.responseCode === -1) {
                (window["messageController"] as MessageController)
                    .start(`Incorrect name or password! (code: ${rsp.responseCode})`)
            } else {
                (window["messageController"] as MessageController)
                    .start("Server application error!")
            }
        }
    }
    signUp() {
        document.location.replace("/signup")
    }
}
export default new LoginController()

