<div class="w-full bg-sky-700 border-2 border-sky-600 rounded-xl px-2 py-2 text-slate-200 align-middle mb-10">
    <div class="flex">
        <div class="flex-1 text-left text-2xl font-light ml-20">

            <div class="flex">
                <div class="ml-10 mt-2 flex-none">
                    <a href="#" class="hover:underline" onclick="window['pageController'].changeRoute('home')">Home</a>
                </div>
                <div class="ml-10 mt-2 flex-none">
                    <a href="#" class="hover:underline" onclick="window['pageController'].changeRoute('todos', todoController)">Todos</a>
                </div>
                <div class="ml-10 mt-2 flex-none">
                    <a href="#" class="hover:underline" onclick="window['pageController'].changeRoute('notes')">Notes</a>
                </div>
                <div class="ml-80 mt-2 flex-none">
                    <a href="#" class="hover:underline" onclick="window['pageController'].changeRoute('about')">About</a>
                </div>
            </div>

        </div>
        <div class="flex-initial pr-5" style="width: 300px">
            {{-- <div style="float:right"><a href="#"><svg class="h-6 w-6 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />  <circle cx="12" cy="7" r="4" /></svg></a></div> --}}
            {{-- <div style="float:right" id="fullname" class="text-sm font-bold mr-3 mt-1"></div> --}}
            {{-- label="Settings" --}}
            <div style="float:right">
                <x-dropdown class="btn-outline" label="" icon="o-user" class="btn-circle btn-outline text-white" no-x-anchor>
                    {{-- By default any click closes dropdown --}}
                    <x-menu-item title="Profile" class="text-black hover:bg-sky-700" onclick="(()=>{document.getElementsByClassName('dropdown')[0].removeAttribute('open'); pageController.changeRoute('profile', profileController);})()" />
                    <x-menu-item title="Logout" class="text-black hover:bg-sky-700" onclick="navbarController.logout()" />
                </x-dropdown>
            </div>
            <div style="float:right" id="fullname" class="text-md font-bold mr-3 mt-3"></div>
        </div>
    </div>
</div>
<script>
    (() => {
        // your page initialization code here
        // the DOM will be available here
        document.addEventListener("DOMContentLoaded", function(event) {
            navbarController.init()
        })
    })()
</script>