<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>ClubConnect</title>
</head>
<body>
    <div class="flex">
        <div class="h-screen sticky bg-purple-500 flex flex-col justify-between">
            @include('components.sidenav')
        </div>
            
        
        <div class="flex-1 h-screen overflow-auto">
            @yield('content')
        </div>
        
    </div>
    @include('sweetalert::alert')
</body>
</html>