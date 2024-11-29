import { Controller, Init, Destroy } from './Controller'
import { createClient } from 'graphqurl'
import storage from '../services/Storage'
import axios from 'axios'

export class PageController implements Controller, Init, Destroy {
    private fullname?: string
    private interval?: any
    constructor() {
        console.log("PageController construct")
    }
    async checkValidUser(): Promise<boolean> {
        const hash = storage.getValueOrDefault("hash", false)
        if (! hash) {
            return false
        }
        const fullname = storage.getValueOrDefault("fullname", "")
        this.fullname = fullname
        const client = createClient({
            endpoint: 'http://127.0.0.1:8000/graphql'
        })
        const rsp = await client.query({
            "query": `mutation { checkUser(hash: "${hash}", passive: false) {success responseCode} }`
        })
        console.log(rsp)
        return rsp?.data?.checkUser?.success
    }
    async checkPassiveUser(): Promise<number> {
        const hash = storage.getValueOrDefault("hash", false)
        if (! hash) {
            return -1
        }
        const fullname = storage.getValueOrDefault("fullname", "")
        this.fullname = fullname
        const client = createClient({
            endpoint: 'http://127.0.0.1:8000/graphql'
        })
        const rsp = await client.query({
            "query": `mutation { checkUser(hash: "${hash}", passive: true) {success responseCode} }`
        })
        console.log(rsp)
        return rsp?.data?.checkUser?.responseCode
    }


    async checkAutoLogout() {
        const validUser = await this.checkValidUser()
        if (! validUser) {
            document.location.replace("/")
        }
        return validUser
    }
    async checkAutoLogin() {
        const validUser = await this.checkValidUser()
        if (validUser) {
            document.location.replace("/main")
        }
        return validUser
    }
    init() {
        (document.getElementById("fullname") as HTMLElement).innerText = this.fullname??""

        this.interval = setInterval(() => {
            this.checkPassiveUser().then((remain) => {
                console.log("checkPassiveUser ", remain)
                if (remain<0) {
                    clearInterval(this.interval)
                    document.location.replace("/")
                }
            })
        },20000)
    }
    destroy() {
        clearInterval(this.interval)
    }

    changeRoute(route: string, targetInit?: Init, initParams?: any) {
        axios.get(`http://127.0.0.1:8000/${route}`).then((content) => {
            this.checkValidUser();
            (document.getElementById("route") as HTMLElement).innerHTML = content.data;
            if (targetInit) {
                (targetInit as Init).init(initParams)
            }
        })
    }
}
export default new PageController()

