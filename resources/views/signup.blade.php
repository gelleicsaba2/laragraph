<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.ts'])
        @else
            <style>
            </style>
        @endif
        <script>
            (() => {
                // your page initialization code here
                // the DOM will be available here
                document.addEventListener("DOMContentLoaded", function(event) {
                    document.getElementById("main").style.display = 'block';
                })
            })()
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div id="main" style="display: none">
            <div class="flex justify-center">
                <div class="bg-indigo-500 border-indigo-300 border-4 shadow-lg w-[18rem] h-[30rem] rounded-lg py-8 px-8 text-white mt-20">
                    <div class="text-center mb-2">Name</div>
                    <div class="text-center">
                        <input type="text" class="rounded text-black" id="form_fullname"></input>
                    </div>
                    <div class="text-center mb-2">E-mail</div>
                    <div class="text-center">
                        <input type="text" class="rounded text-black" id="form_email"></input>
                    </div>
                    <div class="text-center mb-2">Login name</div>
                    <div class="text-center">
                        <input type="text" class="rounded text-black" id="form_name"></input>
                    </div>
                    <div class="text-center mt-5 mb-2">Password</div>
                    <div class="text-center">
                        <input type="password" class="rounded text-black" id="form_pass"></input>
                    </div>
                    <div class="text-center mt-5 mb-2">Password confirm</div>
                    <div class="text-center">
                        <input type="password" class="rounded text-black" id="form_confirm_pass"></input>
                    </div>
                    <div class="text-center mt-5">
                        <button class="btn-primary" onclick="signupController.post()">Sign up</button>
                    </div>
                    <div class="text-center mt-1">
                        @include('./error-msg')
                    </div>
                </div>
            </div>
            <div class="flex justify-center"><a href="#" onclick="(()=>document.location.replace('/'))()">Back to sign in</a></div>
        </div>
    </body>
</html>
