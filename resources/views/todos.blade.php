<template id="TodoTemplate">
    <div class="flex text-sm mt-2" style="width: 1000px">
        <div class="rounded-lg text-white p-4 m-1" style="width: 180px;${todo_color}">
            ${todo_start}<br>
            ${todo_end}<br>
        </div>
        <div class="rounded-lg text-white p-4 m-1" style="width:670px;${todo_color}">
            ${todo}
        </div>
        <div class="rounded-lg text-white p-4 m-1" style="width: 100px;${todo_color}">
            <div><a class="hover:underline" href="#" onclick="todoController.edit(${id}, ${uid})">Edit</a></div>
            <div class="mt-1"><a class="hover:underline mt-2" href="#" onclick="todoController.remove(${id}, ${uid})">Remove</a></div>
        </div>
    </div>
</template>

<div class="flex text-sm mt-2 ml-5 mb-5" style="width: 1000px">
    <div><input type="text"
        id="inputSearch"
        class="rounded text-black border-neutral-300 border-2 text-base"
        style="margin-top:2px"
        placeholder="Search"
        onkeydown="todoController.search(event)"
    ></input></div>

    <div class="ml-3 mr-3">
        <input type="date"
            id="inputStartDate"
            class="rounded-lg p-1 border-2 border-blue-400"
            onkeydown="todoController.search(event)"
        >
    </div>

    <div id="ascicon" style="display: block;margin-top:4px;margin-left:5px"><a href="#" onclick="todoController.sortDesc()"><x-sorticon size="18px" color="rgb(82 82 82)" direction="asc" /></a></div>
    <div id="descicon" style="display: none;margin-top:4px;margin-left:5px"><a href="#" onclick="todoController.sortAsc()"><x-sorticon size="18px" color="rgb(82 82 82)" direction="desc" /></a></div>



    <div class="ml-12">
        <button class="btn-primary" onclick="todoController.newTodo()">New</button>
    </div>

</div>
<div class="text-xl font-extralight" id="TodosPlace"></div>
