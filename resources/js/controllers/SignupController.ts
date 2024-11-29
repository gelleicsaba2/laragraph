import { Controller } from './Controller'
import { GraphqlService } from '../services/GraphqlService'
import { MessageController } from './MessageController'
import { ModalController } from './ModalController'

export class SignupController implements Controller {

    constructor() {
        console.log("SignupController construct")
    }
    async post() {
        console.log("SignupController post")
        const form_fullname = (document.getElementById('form_fullname') as HTMLInputElement | null)?.value?.trim()
        const form_email = (document.getElementById('form_email') as HTMLInputElement | null)?.value?.trim()
        const form_name = (document.getElementById('form_name') as HTMLInputElement | null)?.value?.trim()
        const form_pass = (document.getElementById('form_pass') as HTMLInputElement | null)?.value?.trim()
        const form_confirm_pass = (document.getElementById('form_confirm_pass') as HTMLInputElement | null)?.value?.trim()
        if ( (form_name??"").length < 3 ||
            (form_email??"").length < 3 ||
            (form_fullname??"").length < 3
        ) {
            (window["messageController"] as MessageController)
                .start("All field must be at least 3 letter!")
                return;
        }
        if ( (form_pass??"").length < 6) {
            (window["messageController"] as MessageController)
                .start("Password must be at least 6 letter!")
                return;
        }
        if (form_pass != form_confirm_pass) {
            (window["messageController"] as MessageController)
                .start("Password confirmation failed!")
            return;
        }
        const rsp = await (window["graphqlService"] as GraphqlService).signupUser(form_name??"", form_pass??"", form_fullname??"", form_email??"")
        if (rsp?.success) {
            (window["modalController"] as ModalController)?.show(
                    "Registration is complete. Try to sign in.",'Ok',
                ()=>{
                    document.location.replace("/")
                })
        } else {
            if (rsp?.responseCode == -5) {
                (window["messageController"] as MessageController)
                .start("Name or email already exists! (code:-5)")
                return;
            } else {
                (window["messageController"] as MessageController)
                .start("Error, sorry! Try later.")
                return;
            }
        }
    }
}
export default new SignupController()

