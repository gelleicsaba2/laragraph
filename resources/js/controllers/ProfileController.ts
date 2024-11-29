import { Controller, Init } from './Controller'
import storage from '../services/Storage'

export class ProfileController implements Controller, Init {

    constructor() {
        console.log("ProfileController construct")
    }
    init() {
        console.log('ProfileController init')
        const values = storage.getValues();
        const name = values['name'];
        const fullname = values['fullname'];
        const email = values['email'];
        console.log([name,fullname,email]);
        (document.getElementById('profile__name') as HTMLInputElement).value = name;
        (document.getElementById('profile__fullname') as HTMLInputElement).value = fullname;
        (document.getElementById('profile__email') as HTMLInputElement).value = email
    }
}
export default new ProfileController()

