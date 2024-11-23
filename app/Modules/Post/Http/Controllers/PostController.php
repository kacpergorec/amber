<?php

namespace App\Modules\Post\Http\Controllers;

use App\Modules\Common\Http\Controllers\Controller;
use App\Modules\Post\Models\Post;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class,'post');
    }

    public function index(): View
    {
        return view('post.index');
    }

    public function create()
    {
        return view('post.create');
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }
}
