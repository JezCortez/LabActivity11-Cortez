@extends('layouts.app')

@section('title', $post->title . ' · Barangay Bulletin')

@section('content')
<a href="{{ route('posts.index') }}" class="text-sm text-emerald-700 hover:underline">← Back to bulletin</a>

<article class="mt-4 rounded-lg border bg-white p-6">
    <div class="mb-2 flex flex-wrap items-center gap-2 text-xs">
        @if ($post->is_pinned)
            <span class="rounded bg-amber-100 px-1.5 py-0.5 text-amber-800">Pinned</span>
        @endif
        <span class="rounded bg-neutral-100 px-1.5 py-0.5 text-neutral-600">{{ $post->category }}</span>
    </div>
    <h1 class="text-2xl font-semibold tracking-tight">{{ $post->title }}</h1>
    <p class="mt-1 text-xs text-neutral-500">
        {{ $post->published_at->format('F d, Y') }} · Author #{{ $post->author_id }} · {{ $post->views }} views
    </p>
    <p class="mt-4 text-sm leading-relaxed">{{ $post->body }}</p>
</article>
@endsection
