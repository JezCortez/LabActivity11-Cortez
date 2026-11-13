@extends('layouts.app')

@section('title', $author->name . ' · Barangay Bulletin')

@section('content')
<a href="{{ route('posts.index') }}" class="text-sm text-emerald-700 hover:underline">← Back to bulletin</a>

<div class="mt-4 mb-6">
    <h1 class="text-2xl font-semibold tracking-tight">{{ $author->name }}</h1>
    <p class="text-sm text-neutral-500">{{ $author->position }} · {{ $commentsReceived }} comments received</p>
</div>

<div class="grid gap-4 md:grid-cols-2">
    @forelse ($posts as $post)
        @include('posts._card')
    @empty
        <p class="text-neutral-500 md:col-span-2">No published posts yet.</p>
    @endforelse
</div>
@endsection
