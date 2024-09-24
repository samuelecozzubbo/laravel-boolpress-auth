<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Functions\Helper;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        /* dump($categories); */
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['name'], Category::class);
        $category = Category::create($data);
        return redirect()->route('admin.categories.index', $category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->all());
        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['name'], Category::class);
        $category->update($data);
        return redirect()->route('admin.categories.index', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('cancelled', 'Categoria cancellata');
    }

    //Pagina con tutte le categorie filtrate
    public function categoryPosts()
    {
        $categories = Category::all();
        //dump($categories);
        return view('admin.categories.categoryPost', compact('categories'));
    }

    //pagina con solo una categoria da me cliccata
    public function postPerCategory(Category $category)
    {
        // dump($category);
        return view('admin.categories.postPerCategory', compact('category'));
    }
}
