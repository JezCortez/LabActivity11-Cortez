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
        By <a href="{{ route('authors.show', $post->author) }}" class="hover:underline">{{ $post->author->name }}</a>
        · {{ $post->published_at->format('F d, Y') }}
        · {{ $post->views }} views
    </p>

    <div class="mt-3 flex flex-wrap gap-1">
        @foreach ($post->tags as $tag)
            <a href="{{ route('posts.index', ['tag' => $tag->name]) }}"
               class="rounded-full border px-2 py-0.5 text-xs text-neutral-600 hover:bg-neutral-50">{{ $tag->name }}</a>
        @endforeach
    </div>

    <p class="mt-4 text-sm leading-relaxed">{{ $post->body }}</p>
</article>

<section class="mt-8">
    <h2 class="mb-3 font-medium">Comments ({{ $post->comments->count() }})</h2>

    @auth
        @include('partials.errors')

        <form method="POST" action="{{ route('comments.store', $post->id) }}" class="mb-6 space-y-2">
            @csrf
            <textarea name="body" rows="3" placeholder="Write a comment"
                      class="w-full rounded border bg-white p-2 text-sm">{{ old('body') }}</textarea>
            @error('body') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            <button class="rounded bg-emerald-600 px-4 py-2 text-sm text-white hover:bg-emerald-700">Post comment</button>
        </form>
    @endauth

    @guest
        <p class="mb-6 text-sm text-neutral-500">
            <a href="{{ route('login') }}" class="text-emerald-700 hover:underline">Sign in to comment</a>
        </p>
    @endguest

    <div class="space-y-3">
        @forelse ($post->comments->sortByDesc('created_at') as $comment)
            <div class="rounded-lg border bg-white p-3 text-sm">
                <p class="text-xs text-neutral-500">{{ $comment->user->name }} · {{ $comment->created_at->diffForHumans() }}</p>
                <p class="mt-1">{{ $comment->body }}</p>
            </div>
        @empty
            <p class="text-sm text-neutral-500">No comments yet.</p>
        @endforelse
    </div>
</section>
@endsection
