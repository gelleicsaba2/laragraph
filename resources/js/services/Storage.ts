import { Service } from './Service'
import CryptoAES from 'crypto-js/aes'
import CryptoENC from 'crypto-js/enc-utf8'

const secretKey = 'abc123'
const storageName = 'storage'
class Storage implements Service {

    private encryptText(txt: string) {
        return CryptoAES.encrypt(txt, secretKey).toString()
    }

    private decryptText(txt: string) {
        return CryptoAES.decrypt(txt, secretKey).toString(CryptoENC)
    }

    public storeValues(values: any) {
        const storage = localStorage.getItem(storageName)
        let newItem: any|undefined
        if (storage) {
            const item = JSON.parse(this.decryptText(storage))
            newItem = { item, ...values}
        } else {
            newItem = values
        }
        localStorage.setItem(storageName, this.encryptText(JSON.stringify(newItem)))
    }

    public getValueOrDefault(key: string, _default: any) {
        const storage = localStorage.getItem(storageName)
        if (storage) {
            const item = JSON.parse(this.decryptText(storage))
            return item[key] != undefined ? item[key] : _default
        }
        return _default
    }
    public getValues() {
        const storage = localStorage.getItem(storageName)
        if (storage) {
            const item = JSON.parse(this.decryptText(storage))
            return item
        }
        return undefined
    }

}
export default new Storage()
