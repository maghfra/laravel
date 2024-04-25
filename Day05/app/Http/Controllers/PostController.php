<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Http\Controllers\Auth;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
       $posts=Post::all();
       return view('posts.index',['posts' => $posts]);
    }
    function create(){
        
        return view('posts.create');
    }
    function store(StorePostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id=auth()->user()->id;
    
        $timestamp = now()->timestamp;
    
         $originalFilename = $request->image->getClientOriginalName();
     
         $filename = $timestamp . '_' . $originalFilename;
     
         $request->image->move(public_path('images'), $filename);
     
         $post->image = $filename;
    
        $post->save();
    
        return redirect("/posts");
    }
    
    function show($id){
        $post=Post::find($id);
        return view('posts.show',['post' => $post]);
    }
    function edit($id){
        $post=Post::find($id);
        return view('posts.edit',['post' => $post]);
    }
    function update($id, UpdatePostRequest $request) {
        $request->validate([]);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
    
        // Store the original filename
        $originalFilename = $post->image;
    
        // If a new image is provided in the request, update the image
        if ($request->hasFile('image')) {
            $timestamp = now()->timestamp;
            $filename = $timestamp . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $filename);
            $post->image = $filename;
    
            // Check if the original file exists before deleting it
            if (File::exists(public_path('images/' . $originalFilename))) {
                File::delete(public_path('images/' . $originalFilename));
            }
        }
    
        $post->save();
    
        return redirect('/posts');
    }
    
    function destroy($id) {
        $post = Post::find($id);
    
        if ($post) {
            $imageFilename = $post->image;
            if (File::exists(public_path('images/' . $imageFilename))) {
                File::delete(public_path('images/' . $imageFilename));
            }
    
            $post->delete();
        }
    
        return redirect('/posts');
    }
    
}
