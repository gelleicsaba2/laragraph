import { Controller } from "./Controller"

export class ModalController implements Controller {

    private elemDiv: HTMLElement|null = null
    private coverDiv: HTMLElement|null = null
    private callback: Function|null = null

    show(message: string, btnText: string, callback: Function) {
        console.log("ModalController show")
        this.callback = callback
        this.coverDiv = document.createElement('div')
        this.coverDiv.innerHTML = `
            <div
                style="position: absolute;left: 0;top: 0;width:100%;height:100%;z-index:99;background-color: rgb(0 0 0);opacity:0.3"
            >
            </div>
        `

        this.elemDiv = document.createElement('div')
        this.elemDiv.innerHTML = `
            <div
                style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);width:30rem;height:8rem;z-index:100;background-color: rgb(99 102 241);border-radius: 1.5rem;padding:1rem;margin-top:-4rem"
                class="border-4 border-indigo-300"
            >
                <p class="text-center">${message}</p>
                <div class="text-center mt-5">
                    <button class="btn-primary" onclick="modalController.close()">${btnText}</button>
                </div>
            </div>
        `
        document.body.appendChild(this.coverDiv)
        document.body.appendChild(this.elemDiv)
    }

    close() {
        console.log("ModalController close");
        (()=>{
            if (this.callback) {
                this.callback()
                this.callback = null
            }
        })();
        (()=>{
            document.body.removeChild(this.elemDiv as HTMLElement)
            document.body.removeChild(this.coverDiv as HTMLElement)
            this.elemDiv = null
            this.coverDiv = null
        })();
    }

}
export default new ModalController()