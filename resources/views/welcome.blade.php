<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ecom-so</title>

        <!-- Fonts -->
        

        <!-- Styles -->
        @vite('resources/css/app.css')
    
    </head>
    <body class="antialiased">
       <div id="app">
        <hi></hi>
       </div>
       {{-- vite js --}}
       @vite('resources/js/app.js')
    </body>
</html>
