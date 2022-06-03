<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Post;
use App\Category;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=> 'required|max:250',
            'content'=>'required|min:5',
            'category_id'=>'exists:categories,id'
            // aggiungere controllo
        ],
        [
            'title.required'=>'Titolo deve essere valorizzato',
            'title.max'=>'Hai superato i 250 caratteri',
            'content.min'=>'Non hai inserito sufficienti caratteri',
            'category_id.exist'=>'Categoria selezionata non esiste',
        ]);
        $postData = $request->all();
        $newPost = new Post();
        $newPost->fill($postData);

        $newPost->slug= Post::convertToSlug($newPost->title);

        $newPost->save();
        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        if(!$post){
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        if(!$post){
            abort(404);
        }
        $categories = Category::all();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        // simil store
        $request->validate([
            'title'=> 'required|max:250',
            'content'=>'required|min:5',
            'category_id'=>'exists:categories,id'
            // aggiungere controllo
        ],
        [
            'title.required'=>'Titolo deve essere valorizzato',
            'title.max'=>'Hai superato i 250 caratteri',
            'content.min'=>'Non hai inserito sufficienti caratteri',
            'category_id.exist'=>'Categoria selezionata non esiste',
        ]);

        $postData = $request->all();
        $post->fill($postData);

        $post->slug= Post::convertToSlug($post->title);

        $post->update();
        return redirect()->route('admin.posts.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
