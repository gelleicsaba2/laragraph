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
                    pageController.checkAutoLogout().then((valid) => {
                        if (valid) {
                            document.getElementById("main").style.display = 'block';
                            pageController.init()
                        }
                    })
                })
            })()
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div id="main" style="display: none">
            <div class="flex justify-center">
                <div style="min-width: 1100px; max-width: 1400px; margin-bottom: 50px">
                    @include('./navbar')

                    <div id="route" class="ml-10 mr-10"></div>

                </div>
            </div>
        </div>
    </body>
</html>
