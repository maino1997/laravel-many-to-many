<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewMail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
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
            'image' => ['nullable', 'file'],
            'content' => ['required', 'string', 'min:10'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags' => ['nullable', 'exists:tags,id']
        ]);

        $data = $request->all();

        $post = new Post();
        if (array_key_exists('image', $data)) {
            //Se mi arriva la chiave salva nella cartella post_images il campo $data['image'] e crea l'url dell'immagine
            $image_url = Storage::put('post_images', $data['image']);
            //Riassegno image in $data (che mi arriva in $request), e gli assegno l'url fatto prima che è una
            $data['image'] = $image_url;
        }
        if (array_key_exists('is_published', $data)) {
            $post->is_published = 1;
        } else {
            $post->is_published = 0;
        }
        $post->fill($data);
        $post->user_id = Auth::id();
        $post->slug = Str::slug($post->title, '-');

        $post->save();

        //Con attach() creo effettivamente la relazione se mi arriva la chiave con i tags
        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);

        //Mando la mail di conferma di creazione della mail
        $reciever = Auth::user()->email;

        //Nelle parentesi del to() dovrei mettere $reciever
        Mail::to($reciever)->send(new SendNewMail($post));

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
        $post_tags_ids = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'post_tags_ids'));
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
            'image' => ['nullable', 'file'],
            'content' => ['required', 'string', 'min:10'],
            'tags' => ['nullable', 'exists:tags,id']
        ]);

        $data = $request->all();
        if (array_key_exists('image', $data)) {
            //Controllo se il post ha già un'immagine, se si cancello quella/e precedenti e inserisco la nuova immagine
            if ($post->image) {
                Storage::delete($post->image);
            }
            //Se mi arriva la chiave salva nella cartella post_images il campo $data['image'] e crea l'url dell'immagine
            $image_url = Storage::put('post_images', $data['image']);
            //Riassegno image in $data (che mi arriva in $request), e gli assegno l'url fatto prima che è una
            $data['image'] = $image_url;
        }
        if (array_key_exists('is_published', $data)) {
            $post->is_published = true;
        }
        $post->slug = Str::slug($post->title, '-');

        $post->update($data);
        if (array_key_exists('tags', $data)) $post->tags()->sync($data['tags']);


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
        //Se elimino il post elimino la relazione con i tags
        $post->tags()->detach();
        //Se elimino il post cancello tutte le immagini relative al post
        if ($post->image) {
            Storage::delete($post->image);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', "$post->title eliminato con successo")->with('type', "success");
    }

    public function order()
    {
        $posts = Post::all();
        $categories = Category::all();

        return view('admin.posts.order', compact('posts', 'categories'));
    }
    public function toggle(Post $post)
    {
        $post->is_published = !$post->is_published;
        $post->save();
        return redirect()->route('admin.posts.index')->with('message', "$post->title pubblicato con successo")->with('type', "success");
    }
}
