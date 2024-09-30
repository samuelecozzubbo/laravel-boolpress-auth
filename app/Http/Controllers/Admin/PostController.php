<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Functions\Helper;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //direction
        if (isset($_GET['direction'])) {
            $direction = $_GET['direction'] == 'asc' ? 'desc' : 'asc';
        } else {
            $direction = 'desc';
        }
        //column
        if (isset($_GET['column'])) {
            $column = $_GET['column'];
            $post = Post::orderBy($column, $direction)->paginate(15);
        } else {
            $posts = POST::orderBy('id')->paginate(15);
        }

        if (isset($_GET['search'])) {
            $posts = POST::where('title', 'LIKE', '%' . $_GET['search'] . '%')->orderBy('title')->paginate(10);
        } else {
            $posts = POST::orderBy('id', $direction)->paginate(15);
        }
        //$posts = Post::orderBy('id', 'desc')->paginate(15);
        //dump(request()->query());
        $posts->appends(request()->query());
        return view('admin.posts.index', compact('posts', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['title'], Post::class);

        //VERIFICO se viene caricata l'immagine ossia se esiste la chaive path_image
        if (array_key_exists('path_image', $data)) {
            //se esiste la chiave salvo immagine dentro storage nella cartella uploads
            $image_path = Storage::put('uploads', $data['path_image']);
            //ottengo il nome originale dell'immagine
            //aggiungo i valori a $data
            $original_name = $request->file('path_image')->getClientOriginalName();
            $data['path_image'] = $image_path;
            $data['image_original_name'] = $original_name;
        }

        $post = Post::create($data);

        //Verifico che in data esista la chiave tags che sta a significare che sono stati selezionati dei tag
        if (array_key_exists('tags', $data)) {
            //Se esiste la chiave creo con attach la relazione con il post creato e gli id dei tag selezionati
            $post->tags()->attach($data['tags']);
        }
        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->all();
        if ($data['title'] != $post->title) {
            $data['slug'] = Helper::generateSlug($data['title'], Post::class);
        }

        //VERIFICO se viene caricata l'immagine ossia se esiste la chaive path_image
        if (array_key_exists('path_image', $data)) {
            //se esiste la chiave
            //elimino la vecchia img
            if ($post->path_image) {
                Storage::delete($post->path_image);
            }
            //metto la nuova
            $image_path = STORAGE::put('uploads', $data['path_image']);
            //ottengo il nome originale dell'immagine
            //aggiungo i valori a $data
            $original_name = $request->file('path_image')->getClientOriginalName();
            $data['path_image'] = $image_path;
            $data['image_original_name'] = $original_name;
        }


        $post->update($data);

        //Verifico che in data esista la chiave tags che sta a significare che sono stati selezionati dei tag
        if (array_key_exists('tags', $data)) {
            //Se invio dei tag aggiorno tutte le relazioni
            //sync aggiunge le relazioni mancanti e cancella quelle che non esistono più
            $post->tags()->sync($data['tags']);
        } else {
            //se non vengono inviati tag devo cancellare le relazioni
            //detach cancella tutte le relzioni
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //SE è PRESENTE UN IMMAGINE LA ELIMINO
        if ($post->path_image) {
            Storage::delete($post->path_image);
        }

        //in questo caso avendo messo cascadeOnDelete nella migration eliminando il post vengono automaticamente eliminate tutte le relazioni nella tabella post_tag
        //se non lo avessimo fatto dovremmo toglierle con $post->tags()->detach()
        $post->delete();

        return redirect()->route('admin.posts.index')->with('cancelled', 'Post eliminato con successo');
    }
}
