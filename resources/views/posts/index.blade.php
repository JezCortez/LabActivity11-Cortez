@extends('layouts.app')

@section('content')
<form method="GET" action="{{ route('posts.index') }}" class="mb-6 flex flex-col gap-2 sm:flex-row">
    <input name="q" value="{{ request('q') }}" placeholder="Search title"
           class="w-full rounded border bg-white p-2 text-sm sm:flex-1">
    <select name="category" class="rounded border bg-white p-2 text-sm">
        <option value="">All categories</option>
        @foreach ($categories as $c)
            <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
        @endforeach
    </select>
    <button class="rounded bg-emerald-600 px-4 py-2 text-sm text-white hover:bg-emerald-700">Filter</button>
</form>

<div class="grid gap-4 md:grid-cols-2">
    @forelse ($posts as $post)
        <article class="rounded-lg border bg-white p-4">
            <div class="mb-2 flex flex-wrap items-center gap-2 text-xs">
                @if ($post->is_pinned)
                    <span class="rounded bg-amber-100 px-1.5 py-0.5 text-amber-800">Pinned</span>
                @endif
                <span class="rounded bg-neutral-100 px-1.5 py-0.5 text-neutral-600">{{ $post->category }}</span>
            </div>
            <h2 class="font-medium">
                <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a>
            </h2>
            <p class="mt-2 text-xs text-neutral-500">
                {{ $post->published_at->format('M d, Y') }} · Author #{{ $post->author_id }} · {{ $post->views }} views
            </p>
        </article>
    @empty
        <p class="text-neutral-500 md:col-span-2">No posts match your search.</p>
    @endforelse
</div>

<div class="mt-6">{{ $posts->links() }}</div>

@if ($posts->total() > 0)
    <p class="mt-4 text-sm text-neutral-500">
        Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
    </p>
@endif
@endsection
