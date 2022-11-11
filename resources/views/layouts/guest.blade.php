<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Store</title>

    <link rel="icon" href="https://pngimg.com/uploads/circle/circle_PNG36.png" type="image/png">
   

    <!-- Fonts -->
   <!-- Google Web Fonts -->
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

   <!-- Font Awesome -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

   <!-- Libraries Stylesheet -->
   <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

   <!-- Customized Bootstrap Stylesheet -->
   <link href="{{asset('css/store.min.css')}}" rel="stylesheet">

    <!-- Scripts -->
    @vite([ 'resources/js/app.js'])
</head>
<body>
   
    @include('store.partials._header')
    @yield('content')
    @include('store.partials._footer')
    
</body>
</html>
