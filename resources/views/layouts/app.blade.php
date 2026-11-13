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
        <div class="mx-auto flex max-w-4xl flex-col gap-2 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
            <a href="{{ route('posts.index') }}" class="font-semibold tracking-tight">Barangay Bulletin – Purok Cortez</a>
            <div class="flex items-center gap-4 text-sm text-neutral-600">
                @auth
                    @if (auth()->user()->author)
                        <a href="{{ route('posts.create') }}" class="hover:text-neutral-900">New post</a>
                    @endif
                    <span>Hi, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="underline hover:text-neutral-900">Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="hover:text-neutral-900">Sign in</a>
                @endguest
            </div>
        </div>
    </header>

    <main class="mx-auto w-full max-w-4xl flex-1 px-4 py-8">
        @if (session('status'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t py-4 text-center text-xs text-neutral-500">
        Barangay Matina Crossing Hall · Davao City
    </footer>
</body>
</html>
