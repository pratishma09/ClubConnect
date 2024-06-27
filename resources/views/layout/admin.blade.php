<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>ClubConnect</title>
</head>
<body>
    <div class="flex">
        <div class="h-screen sticky bg-purple-800 flex flex-col justify-between">
            @include('components.sidenav')
        </div>
            
        
        <div class="flex-1 h-screen overflow-auto">
            @yield('content')
        </div>
        
    </div>
    @include('sweetalert::alert')
</body>
</html>