import { GraphqlService } from '../services/GraphqlService'
import { Controller, Init } from './Controller'
import storage from '../services/Storage'
import { PageController } from './PageController';
import { dateTimeText } from '../services/utils'
import { MessageController } from './MessageController'

export class newTodoController implements Controller, Init {

    id?: number;
    uid?: number;
    hash?: string;

    async init(params?: any) {
        console.log(params);
        this.uid = params.uid;
        this.hash = params.hash;

        (document.getElementById('formStartDate') as HTMLInputElement).value =
            dateTimeText(new Date()).substring(0,16);

    }

    async post() {
        console.log("newTodoController post()")
        const todo_start = (document.getElementById('formStartDate') as HTMLInputElement).value;
        let todo_end = (document.getElementById('formEndDate') as HTMLInputElement).value;
        if (todo_end == '') {
            todo_end = todo_start
        }
        const todo = (document.getElementById('formTodo') as HTMLInputElement).value;
        const todoObject = {
            uid: this.uid??0,
            todo_start: todo_start,
            todo_end: todo_end,
            todo: todo
        };
        if (todoObject.todo_start.trim() == '') {
            (window["messageController"] as MessageController)
                .start("Start date is empty!")
            return;
        }
        if (todoObject.todo.trim() == '') {
            (window["messageController"] as MessageController)
                .start("Todo text is empty!")
            return;
        }
        console.log("post " + JSON.stringify(todoObject));
        const rsp = await (window['graphqlService'] as GraphqlService)
            .newTodo(todoObject, this.hash??'invalid-hash');
        console.log(rsp)
        if (rsp?.success) {
            (window['pageController'] as PageController).changeRoute('todos',
                window['todoController'] as Init)
        }

    }




}
export default new newTodoController()