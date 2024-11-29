import { GraphqlService } from '../services/GraphqlService'
import { Controller, Init } from './Controller'
import storage from '../services/Storage'
import { PageController } from './PageController';

export class ChangeTodoController implements Controller, Init {

    id?: number;
    uid?: number;
    hash?: string;

    async init(params?: any) {
        console.log(params);
        this.id = params.id;
        this.uid = params.uid;
        const hash: string = storage.getValueOrDefault('hash', 'invalid-hash');
        this.hash = hash;
        let rsp = await (window['graphqlService'] as GraphqlService).todoById(params.id, hash);
        console.log(rsp);

        (document.getElementById('formStartDate') as HTMLInputElement).value =
            rsp.data.todo_start.substring(0,16);

        (document.getElementById('formEndDate') as HTMLInputElement).value =
            rsp.data.todo_end.substring(0,16);

        (document.getElementById('formTodo') as HTMLInputElement).value = rsp.data.todo;
    }

    async post() {
        console.log("ChangeTodoController post()")
        const todo_start = (document.getElementById('formStartDate') as HTMLInputElement).value;
        let todo_end = (document.getElementById('formEndDate') as HTMLInputElement).value;
        if (todo_end == '') {
            todo_end = todo_start
        }
        const todo = (document.getElementById('formTodo') as HTMLInputElement).value;
        const todoObject = {
            id: this.id??0,
            uid: this.uid??0,
            todo_start: todo_start,
            todo_end: todo_end,
            todo: todo
        };
        console.log("post " + JSON.stringify(todoObject));
        const rsp = await (window['graphqlService'] as GraphqlService)
            .changeTodo(todoObject, this.hash??'invalid-hash');
        console.log(rsp)
        if (rsp?.success) {
            (window['pageController'] as PageController).changeRoute('todos',
                window['todoController'] as Init)
        }

    }

}
export default new ChangeTodoController()