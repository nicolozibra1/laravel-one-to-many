<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Doctrine\DBAL\Schema\View;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $posts = Post::paginate(3);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $data['slug'] = $slug;
        $post = Post::create($data);
        if($request->has('tags')){
            $post->attach($request->tags);
        }
        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     *
     *
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     *
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     *
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $slug = Str::slug($request->title, '-');
        $data['slug'] = $slug;
        $post->update($data);
        return redirect()->route('admin.posts.show', $post->slug)->with('message', 'Il post è stato aggiornato');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     *
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', "$post->title deleted successfully.");
    }
}
