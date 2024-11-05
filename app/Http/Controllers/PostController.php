<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use DB;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function index(): View
    {
        return view('livewire.pages.posts.index');
    }

    public function create()
    {
        return view('livewire.pages.posts.create');
    }

    public function store(StorePostRequest $request)
    {
        //
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
