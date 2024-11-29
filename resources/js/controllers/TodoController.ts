import { GraphqlService } from '../services/GraphqlService'
import { Init } from './Controller'
import { dateTimeText, addFromTemplate, WEEKDAYS } from '../services/utils'
import storage from '../services/Storage'
import { PageController } from './PageController'

export class TodoController implements Init {

    sort = 'asc';
    searchText = '';

    async getTodos() {
        const hash = storage.getValueOrDefault('hash', 'invalid-hash')
        const _time = dateTimeText(new Date())
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
        console.log(`Todo Remove ${id}`)
    }
    async init() {
        console.log("TodoController init")
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
