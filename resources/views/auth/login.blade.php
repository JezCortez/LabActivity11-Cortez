@extends('layouts.app')

@section('title', 'Sign in · Barangay Bulletin')

@section('content')
<form method="POST" action="/login" class="mx-auto mt-6 max-w-sm space-y-4 rounded-lg border bg-white p-6">
    @csrf
    <h1 class="text-lg font-semibold">Sign in</h1>

    <div>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
               class="w-full rounded border p-2 text-sm">
        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <input type="password" name="password" placeholder="Password"
               class="w-full rounded border p-2 text-sm">
        @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <button class="w-full rounded bg-emerald-600 p-2 text-sm text-white hover:bg-emerald-700">Sign in</button>
</form>
@endsection
