<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Barangay Bulletin – Purok Cortez')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-neutral-50 text-neutral-800 antialiased">
    <header class="border-b bg-white">
        <div class="mx-auto max-w-4xl px-4 py-3">
            <a href="{{ route('posts.index') }}" class="font-semibold tracking-tight">Barangay Bulletin – Purok Cortez</a>
        </div>
    </header>

    <main class="mx-auto w-full max-w-4xl flex-1 px-4 py-8">
        @yield('content')
    </main>

    <footer class="border-t py-4 text-center text-xs text-neutral-500">
        Barangay Matina Crossing Hall · Davao City
    </footer>
</body>
</html>
