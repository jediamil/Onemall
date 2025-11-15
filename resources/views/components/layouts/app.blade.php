<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>{{$title}}</title>
</head>
<body class="bg-cyan-100" style="font-family: 'Work Sans', sans-serif;">

    <div class="flex flex-col md:flex-row pt-0 md:pt-15">
        <x-partials.sidebar></x-partials.sidebar>
        <main class="w-full pb-10"> {{ $slot }} </main>
    </div>
    
</body>
</html>