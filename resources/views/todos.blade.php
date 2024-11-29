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
            <a class="underline" href="#" onclick="todoController.edit(${id}, ${uid})">Edit</a><br>
            <a class="underline" href="#" onclick="todoController.remove(${id}, ${uid})">Remove</a>
        </div>
    </div>
</template>

<div class="flex text-sm mt-2 ml-5 mb-5" style="width: 1000px">
    <div><input type="text"
        id="inputSearch"
        class="rounded text-black border-neutral-300 border-2 text-base"
        placeholder="Search"
        onkeydown="todoController.search(event)"
    ></input></div>

    <div id="ascicon" style="display: block;margin-top:4px;margin-left:15px"><a href="#" onclick="todoController.sortDesc()"><x-sorticon size="18px" color="rgb(82 82 82)" direction="asc" /></a></div>
    <div id="descicon" style="display: none;margin-top:4px;margin-left:15px"><a href="#" onclick="todoController.sortAsc()"><x-sorticon size="18px" color="rgb(82 82 82)" direction="desc" /></a></div>

</div>
<div class="text-xl font-extralight" id="TodosPlace"></div>
