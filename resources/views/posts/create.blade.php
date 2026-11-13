@extends('layouts.app')

@section('title', 'New post · Barangay Bulletin')

@section('content')
<h1 class="mb-4 text-2xl font-semibold tracking-tight">New post</h1>

@include('partials.errors')

<form method="POST" action="{{ route('posts.store') }}" class="space-y-4 rounded-lg border bg-white p-6">
    @csrf

    <div>
        <label class="mb-1 block text-sm font-medium">Title</label>
        <input name="title" value="{{ old('title') }}" class="w-full rounded border p-2 text-sm">
        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Category</label>
        <select name="category" class="w-full rounded border bg-white p-2 text-sm sm:w-auto">
            <option value="">Choose one</option>
            @foreach ($categories as $c)
                <option value="{{ $c }}" @selected(old('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>
        @error('category') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Body</label>
        <textarea name="body" rows="6" class="w-full rounded border p-2 text-sm">{{ old('body') }}</textarea>
        @error('body') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <p class="mb-1 text-sm font-medium">Tags</p>
        <div class="flex flex-wrap gap-4 text-sm">
            @foreach ($tags as $tag)
                <label class="flex items-center gap-1">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                           @checked(in_array($tag->id, old('tags', [])))>
                    {{ $tag->name }}
                </label>
            @endforeach
        </div>
        @error('tags') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        @error('tags.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <label class="flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_published" value="1" @checked(old('is_published'))>
        Publish now
    </label>
    @error('is_published') <p class="text-sm text-red-600">{{ $message }}</p> @enderror

    <button class="rounded bg-emerald-600 px-4 py-2 text-sm text-white hover:bg-emerald-700">Save post</button>
</form>
@endsection
