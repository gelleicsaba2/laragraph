import { Controller } from './Controller'

export class MessageController implements Controller {

    constructor() {
        console.log("MessageController construct")
    }
    async start(_message: string, _time?: number) {
        const errorMsgContainer: HTMLElement|null = document.getElementById('errorMsgContainer')
        if (errorMsgContainer) {
            errorMsgContainer.innerText = _message
            let opc=1.0
            errorMsgContainer.style["opacity"] = `${opc}`
            setTimeout(()=> {
                const ival = setInterval(() => {
                    errorMsgContainer.style["opacity"] = `${opc}`
                    if (opc<=0) {
                        errorMsgContainer.innerText = ""
                        clearInterval(ival)
                    }
                    opc-=0.05
                }, 10)
            }, _time ? _time : 3000)
        }
    }
}
export default new MessageController()

