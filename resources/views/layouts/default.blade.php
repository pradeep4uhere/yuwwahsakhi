<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Yuwaah Sakhi') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
         <!----======== CSS ======== -->
        <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
        <!----===== Iconscout CSS ===== -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>
    <body class="font-sans antialiased">
    @yield('content')
    @include('admin.menu')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{asset('asset/js/script.js')}}"></script>
    <script>
      function deleteConfirm(id, route) {
            // Display confirmation alert
            var confirmDelete = confirm("Are you sure you want to delete this data?");
            if (confirmDelete) {
                window.location.href = route.replace('__ID__', id);
            }
        }
        </script>
    </body>
</html>