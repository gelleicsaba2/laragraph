import { GraphqlService } from '../services/GraphqlService'
import { Init } from './Controller'
import { dateTimeText, addFromTemplate, WEEKDAYS } from '../services/utils'
import storage from '../services/Storage'
import { PageController } from './PageController'
import { ModalController } from './ModalController'

export class TodoController implements Init {

    sort = 'asc';
    searchText = '';

    async getTodos() {
        const hash = storage.getValueOrDefault('hash', 'invalid-hash')
        //const _time = dateTimeText(new Date())
        const _time = (document.getElementById('inputStartDate') as HTMLInputElement).value+" 00:00:00";
        let rsp: any = undefined
        if (! this.searchText) {
            rsp = await (window["graphqlService"] as GraphqlService).todos(_time, hash, this.sort)
        } else {
            rsp = await (window["graphqlService"] as GraphqlService).todos(_time, hash, this.sort, this.searchText)
        }
        return rsp?.data.map((q: any) =>
                {
                    return {
                        id: q.id,
                        todo: q.todo,
                        todo_start: q.todo_start.substring(0,16) +
                            ' ' + WEEKDAYS[new Date(q.todo_start).getDay()],
                        todo_end: q.todo_end.substring(0,16) +
                        ' ' + WEEKDAYS[new Date(q.todo_end).getDay()],
                        uid: q.uid
                    }
                }
        )
    }
    sortDesc() {
        (document.getElementById('ascicon') as HTMLElement).style['display'] = 'none';
        (document.getElementById('descicon') as HTMLElement).style['display'] = 'block';
        this.sort = 'desc';
        this.reload();
    }
    sortAsc() {
        (document.getElementById('descicon') as HTMLElement).style['display'] = 'none';
        (document.getElementById('ascicon') as HTMLElement).style['display'] = 'block';
        this.sort = 'asc';
        this.reload();
    }
    async search(event: any) {
        if (event.key === 'Enter') {
            console.log('ENTER!')
            this.searchText = (document.getElementById('inputSearch') as HTMLInputElement)?.value;
            this.reload();
        }
    }
    private async reload() {
        const todos = await this.getTodos()
        const place = document.getElementById("TodosPlace") as HTMLElement
        while (place.firstChild) {
            place.removeChild(place.lastChild);
        }

        const templ = document.getElementById("TodoTemplate") as HTMLTemplateElement
        const colors = [
            'background-color: rgb(5 150 105)',
            'background-color: rgb(3 105 161)',
            ]
        let n=0
        for (let todo of todos) {
            const todo_color = colors[n % colors.length]
            addFromTemplate(place, templ, {...todo,...{todo_color: todo_color}})
            ++n
        }
    }
    async edit(id: number, uid: number) {
        console.log(`Todo Edit ${id}`);
        const check = await (window['pageController'] as PageController).checkValidUser();
        if (check) {
            (window['pageController'] as PageController).changeRoute(
                `change-todo/${id}`, window['changeTodoController'] as Init, {id: id, uid: uid});
        }

    }
    async remove(id: number, uid: number) {
        const scroll = { X: window.scrollX, Y: window.scrollY }
        console.log(`Todo Remove ${id}`);
        const hash = storage.getValueOrDefault('hash', 'invalid-hash')
        let remove = await (window['graphqlService'] as GraphqlService).removeTodo({id: id, uid: uid}, hash);
        if (remove?.success) {
            (window['modalController'] as ModalController).show(
                    'Todo has been removed.',
                    'Ok',
                    async ()=>{
                        await this.reload()
                        window.scrollTo(scroll.X, scroll.Y);
                    }
                )
        } else {
            (window['modalController'] as ModalController).show(
                `There has been an error. (code:${remove?.responseCode}`,
                'Ok',
                async ()=>{
                    await this.reload()
                    window.scrollTo(scroll.X, scroll.Y);
                }
            )
        }
    }

    async newTodo() {
        console.log(`Todo New`);
        const hash = storage.getValueOrDefault("hash", false);
        const uid = await (window['graphqlService'] as GraphqlService).getUserId(hash);
        if (uid) {
            console.log(`uid: ${uid}`);
            (window['pageController'] as PageController).changeRoute(
                `new-todo`, window['newTodoController'] as Init, {uid: uid, hash: hash});
        }

    }

    async init() {
        console.log("TodoController init");

        (document.getElementById('inputStartDate') as HTMLInputElement).value =
            dateTimeText(new Date()).substring(0,10);

        const todos = await this.getTodos()
        const place = document.getElementById("TodosPlace") as HTMLElement
        const templ = document.getElementById("TodoTemplate") as HTMLTemplateElement
        const colors = [
            'background-color: rgb(5 150 105)',
            'background-color: rgb(3 105 161)',
            ]
        let n=0
        for (let todo of todos) {
            const todo_color = colors[n % colors.length]
            addFromTemplate(place, templ, {...todo,...{todo_color: todo_color}})
            ++n
        }
    }

}
export default new TodoController()
