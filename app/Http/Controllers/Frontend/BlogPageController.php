<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Contracts\View\View;

class BlogPageController extends Controller
{
    public function index(string $locale): View
    {
        app()->setLocale($locale);

        $posts = $this->publishedPostsQuery()
            ->paginate(9)
            ->withQueryString();

        return view('pages.blog.index', [
            'posts' => $posts,
            'isGrid' => false,
        ]);
    }

    public function grid(string $locale): View
    {
        app()->setLocale($locale);

        $posts = $this->publishedPostsQuery()
            ->paginate(9)
            ->withQueryString();

        return view('pages.blog.index', [
            'posts' => $posts,
            'isGrid' => true,
        ]);
    }

    public function show(string $locale, string $slug): View
    {
        app()->setLocale($locale);

        $post = $this->publishedPostsQuery()
            ->where('slug', $slug)
            ->firstOrFail();

        $recentPosts = $this->publishedPostsQuery()
            ->where('id', '!=', $post->id)
            ->limit(5)
            ->get();

        return view('pages.blog.show', [
            'post' => $post,
            'recentPosts' => $recentPosts,
        ]);
    }

    private function publishedPostsQuery()
    {
        return BlogPost::query()
            ->where('is_published', true)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->latest('published_at')
            ->latest('id');
    }
}
