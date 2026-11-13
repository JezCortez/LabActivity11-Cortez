<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    // "Cortez" has 6 letters, so 6 posts per page.
    private const PER_PAGE = 6;

    public function index(Request $request)
    {
        $posts = Post::query()
            ->with(['author', 'tags'])
            ->withCount('comments')
            ->where('is_published', true)
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%' . $request->q . '%'))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->category))
            ->when($request->filled('tag'), fn ($query) => $query->whereHas(
                'tags',
                fn ($t) => $t->where('name', $request->tag)
            ))
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(self::PER_PAGE)
            ->withQueryString();

        $categories = Post::query()->distinct()->orderBy('category')->pluck('category');
        $tagNames = Tag::orderBy('name')->pluck('name');

        return view('posts.index', compact('posts', 'categories', 'tagNames'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        abort_unless($post->is_published, 404);

        $post->views += 1;
        $post->save();

        $post->load(['author', 'tags', 'comments.user']);

        return view('posts.show', compact('post'));
    }

    public function create(Request $request)
    {
        abort_unless($request->user()->author, 403);

        return view('posts.create', [
            'tags' => Tag::orderBy('name')->get(),
            'categories' => Post::CATEGORIES,
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $data = Arr::except($request->validated(), ['tags']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        $post = $request->user()->author->posts()->create($data);
        $post->tags()->sync($request->validated('tags'));

        if ($post->is_published) {
            return redirect()->route('posts.show', $post->id)->with('status', 'Post published.');
        }

        return redirect()->route('posts.index')->with('status', 'Draft saved.');
    }
}
