<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private const PER_PAGE = 10;

    public function index(Request $request): View
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->when($request->filled('q'), function (Builder $query) use ($request): void {
                $query->where('title', 'like', '%'.(string) $request->string('q').'%');
            })
            ->when($request->filled('category'), function (Builder $query) use ($request): void {
                $query->where('category', (string) $request->string('category'));
            })
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(self::PER_PAGE)
            ->withQueryString();

        $categories = Post::query()
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show(int $id): View
    {
        $post = Post::findOrFail($id);

        abort_unless($post->is_published, 404);

        $post->views++;
        $post->save();

        return view('posts.show', compact('post'));
    }
}
