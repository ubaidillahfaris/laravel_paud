<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="handheldfriendly" content="true" />
        <meta name="MobileOptimized" content="width" />
        <meta name="description" content="Mordenize" />
        <meta name="author" content="" />
        <meta name="keywords" content="Mordenize" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        @routes
        @vite([
            'resources/js/app.js', 
            "resources/js/Pages/{$page['component']}.vue"
        ])
        @inertiaHead
    </head>

    <body class="font-sans antialiased">
        @inertia
    </body>
    <script src="/libs/jquery/dist/jquery.min.js"></script>
    <script src="/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--  core files -->
    <script src="/js/app.min.js"></script>
    <script src="/js/app.init.js"></script>
    <script src="/js/app-style-switcher.js"></script>
    <script src="/js/sidebarmenu.js"></script>
    <script src="/js/custom.js"></script>
</html>
