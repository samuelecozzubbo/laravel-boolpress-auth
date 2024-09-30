<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PageController extends Controller
{
    public function index()
    {
        $data = [
            'name' => 'Ugo',
            'surname' => 'De ughi'
        ];
        //Con with( ) ottengo le entità in relazione
        $posts = Post::orderBy('id', 'desc')->with('category', 'tags')->paginate(10);
        $success = true;
        $response = [
            'success' => $success,
            'results' => $posts,
        ];
        return response()->json($posts);

        //http://127.0.0.1:8000/api vedi il risultato


        //return response()->json($data);
        //è preferibile non utilizzare il compact
    }

    public function postBySlug($slug)
    {

        $post = Post::where('slug', $slug)->with('category', 'tags')->first();
        if ($post) {
            $success = true;
            //devo sovrascrivere il percorso assoluto per le immagini
            //Se un post non ha immagina otterrò solo store
            //allora faccio in modo che arrivi almeno l'immagine placeholder
            if ($post->path_image) {
                $post->path_image = asset('storage/' . $post->path_image);
            } else {
                $post->path_image = '/img/no-image.png';
                $post->image_original_name = 'no image';
            }
        } else {
            $success = false;
        }


        //http://127.0.0.1:8000/api/post-by-slug/unde-magni-nihil-aperiam-tenetur-totam-error
        //dump($post);
        return response()->json(compact('success', 'post'));
    }


    public function categories()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function tags()
    {
        $tags = Tag::all();

        return response()->json($tags);
    }

    public function postByCategory($slug)
    {
        //slug della categoria
        if ($slug) {
            $success = true;
            $category = Category::where('slug', $slug)->with('posts')->first();
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'category'));
    }

    public function postByTag($slug)
    {
        //slug della categoria
        if ($slug) {
            $success = true;
            $tag = Tag::where('slug', $slug)->with('posts')->first();
        } else {
            $success = false;
        }

        return response()->json(compact('success', 'tag'));
    }
}
