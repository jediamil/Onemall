<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{$title}}</title>
</head>
<body class="bg-cyan-100">
    
    <div class="p-0 md:p-5">

    </div>
    <div class="flex flex-col md:flex-row">
        <x-partials.sidebar></x-partials.sidebar>
        <main class="w-full pb-10"> {{ $slot }} </main>
    </div>
    
</body>
</html>