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
        By <a href="{{ route('authors.show', $post->author) }}" class="hover:underline">{{ $post->author->name }}</a>
        · {{ $post->published_at->format('M d, Y') }}
        · {{ $post->views }} views
        · {{ $post->comments_count }} comments
    </p>

    <div class="mt-3 flex flex-wrap gap-1">
        @foreach ($post->tags as $tag)
            <a href="{{ route('posts.index', ['tag' => $tag->name]) }}"
               class="rounded-full border px-2 py-0.5 text-xs text-neutral-600 hover:bg-neutral-50">{{ $tag->name }}</a>
        @endforeach
    </div>
</article>
