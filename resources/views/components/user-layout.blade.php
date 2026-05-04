<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Page</title>
     @livewireStyles
     @vite(['resources/css/app.css','resources/js/app.js'])
     <x-user-styles/>
</head>

<body>
     <x-user-header/>

    {{$slot}}
    <x-user-footer/>
    
        <!-- Footer -->
    @livewireScripts
</body>
</html>