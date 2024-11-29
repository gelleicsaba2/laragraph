import { Controller, Init, Destroy } from './Controller'
import { GraphqlService } from '../services/GraphqlService'
import storage from '../services/Storage'
import { PageController } from './PageController'

export class NavbarController implements Controller, Init {

    constructor() {
        console.log("NavbarController construct")
    }

    init() {
        window["pageController"].changeRoute("home")
    }

    async logout() {
        const hash = storage.getValueOrDefault('hash', 'invalid-hash')
        const name = storage.getValueOrDefault('name', 'invalid-name')
        const rsp = await (window["graphqlService"] as GraphqlService).logoutUser(name, hash)
        if (rsp?.success) {
            (window["pageController"] as PageController).destroy()
            storage.storeValues({hash: '', name: '', fullname: '', email: ''})
            document.location.replace("/")
        }
    }

}
export default new NavbarController()

