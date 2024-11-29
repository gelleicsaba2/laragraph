import { createClient } from 'graphqurl'


export class GraphqlService {

    private client = createClient({
        endpoint: 'http://127.0.0.1:8000/graphql'
    })

    public async loginUser(loginName: string, loginPass: string): Promise<any> {
        const rsp = await this.client.query({
            "query": `mutation { loginUser(name: "${loginName}", pass: "${loginPass}") {success hash fullname email responseCode expire} }`
        })
        return rsp?.data?.loginUser
    }
    public async logoutUser(name: string, hash: string): Promise<any> {
        const rsp = await this.client.query({
            "query": `mutation { logoutUser(name: "${name}", hash: "${hash}") {success responseCode} }`
        })
        return rsp?.data?.logoutUser
    }

    public async signupUser(name: string, pass: string, fullname: string, email: string): Promise<any> {
        const rsp = await this.client.query({
            "query": `mutation { signup(name: "${name}", pass: "${pass}", fullname: "${fullname}", email: "${email}") {success responseCode} }`
        })
        return rsp?.data?.signup
    }
    public async todos(_time: string, hash: string, sort?: string, search?: string) {
        if (!search) {
            console.log(`query {todos (hash: "${hash}", start: "${_time}", sort: "${sort??'asc'}") {success responseCode data { id todo todo_start todo_end uid } } }`)
            const rsp = await this.client.query({
                "query": `query {todos (hash: "${hash}", start: "${_time}", sort: "${sort??'asc'}") {success responseCode data { id todo todo_start todo_end uid } } }`
            })
            return rsp?.data?.todos
        } else {
            console.log(`query {todos (hash: "${hash}", start: "${_time}", sort: "${sort??'asc'}", search: "${search}") {success responseCode data { id todo todo_start todo_end uid } } }`)
            const rsp = await this.client.query({
                "query": `query {todos (hash: "${hash}", start: "${_time}", sort: "${sort??'asc'}", search: "${search}") {success responseCode data { id todo todo_start todo_end uid } } }`
            })
            return rsp?.data?.todos
        }
    }
    public async changeTodo(todo: any, hash: string) {
        const rsp = await this.client.query({
            "query": `mutation { changeTodo(hash: "${hash}", id: ${todo['id']}, todo: "${todo['todo']}", todo_start: "${todo['todo_start']}", todo_end: "${todo['todo_end']}", uid: ${todo['uid']}) {success responseCode } }`
        })
        return rsp?.data?.changeTodo
    }
    public async todoById(id: number, hash: string) {
        const rsp = await this.client.query({
            "query": `query { todoById(hash: "${hash}", id: ${id}) {success responseCode data { id todo todo_start todo_end uid } } }`
        })
        return rsp?.data?.todoById

    }


}
export default new GraphqlService()