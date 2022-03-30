<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *  @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'unique:posts', 'string', 'min:3', 'max:50'],
            'image' => ['string', 'min:10'],
            'content' => ['required', 'string', 'min:10'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['nullable', 'exists:tags,id']
        ]);

        $data = $request->all();

        $post = new Post();

        $post->fill($data);
        $post->user_id = Auth::id();
        $post->save();

        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', Rule::unique('posts')->ignore($post->id), 'string', 'min:3', 'max:50'],
            'image' => ['string', 'min:10'],
            'content' => ['required', 'string', 'min:10'],
            'tags' => ['nullable', 'exists:tags,id']
        ]);

        $data = $request->all();

        $post->update($data);

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', "$post->title eliminato con successo")->with('type', "success");
    }

    public function order()
    {
        $posts = Post::all();
        $categories = Category::all();

        return view('admin.posts.order', compact('posts', 'categories'));
    }
}
