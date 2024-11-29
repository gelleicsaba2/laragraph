<div class="flex text-sm mt-2 ml-5 mb-5" style="width: 1000px">
    <form>
        <div class="grid grid-rows-1 grid-cols-4 gap-4 w-full">
            <div>
                <p class="mb-1 ml-3">Start date</p>
                <input type="datetime-local"
                    id="formStartDate"
                    class="rounded-lg p-1 border-2 border-blue-400"
                >
            </div>
            <div>
                <p class="mb-1 ml-3">End date (Optional)</p>
                <input type="datetime-local"
                    id="formEndDate"
                    class="rounded-lg p-1 border-2 border-blue-400"
                >
            </div>
        </div>
        <div class="grid grid-rows-1 grid-cols-1 gap-4 w-full mt-3">
            <div>
                <p class="mb-1 ml-3">Todo:</p>
                <textarea
                    id="formTodo"
                    class="rounded-lg p-1 border-2 border-blue-400 w-full"
                    rows="4" cols="90"
                ></textarea>
            </div>
        </div>
        <div class="grid grid-rows-2 grid-cols-2 gap-4 w-full mt-3">
            <div>
                <button class="btn-primary" onclick="newTodoController.post()">Save</button><br>
                @include('./error-msg')
            </div>
            <div>
                <a href="#" class="hover:underline" onclick="(()=>{ pageController.changeRoute('todos', todoController)})()">Back</a></div>
            </div>
        </div>
    </form>
</div>