<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // "Cortez" has 6 letters, so 6 posts per page.
    private const PER_PAGE = 6;

    public function index(Request $request)
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%' . $request->q . '%'))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->category))
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(self::PER_PAGE)
            ->withQueryString();

        $categories = Post::query()->distinct()->orderBy('category')->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        abort_unless($post->is_published, 404);

        $post->views += 1;
        $post->save();

        return view('posts.show', compact('post'));
    }
}
