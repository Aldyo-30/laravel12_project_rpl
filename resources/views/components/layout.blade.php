<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="/img/logo.png" type="image/png">
    <title>Berita Desa</title>
</head>

<body class="font-inter h-full bg-gray-100">
    <x-navbar></x-navbar>
    <main class="">
        <div class="mx-auto max-w-7xl py-6 sm:px-9 lg-px6 mb-20">
            {{-- content --}}
            {{ $slot }}
        </div>
    </main>
</body>

</html>