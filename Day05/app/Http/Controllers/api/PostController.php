<?php

namespace App\Http\Controllers\api;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index(){
        $posts = Post::with('user')->paginate(5);
        return PostResource::collection($posts);
    }
    function store(StorePostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id=$request->user_id;
    
        $timestamp = now()->timestamp;
    
         $originalFilename = $request->image->getClientOriginalName();
     
         $filename = $timestamp . '_' . $originalFilename;
     
         $request->image->move(public_path('images'), $filename);
     
         $post->image = $filename;
    
        $post->save();
    
        return "post added";
    }
    function show($id){
        $post=Post::with('user')->find($id);
        return new PostResource($post);
    }
    function update($id, UpdatePostRequest $request) {
        $post = Post::find($id);
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user_id;
    
        if ($request->hasFile('image')) {
            $timestamp = now()->timestamp;
            $filename = $timestamp . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $filename);
            $post->image = $filename;
    
            // Delete the original file if it exists
            if ($post->image && File::exists(public_path('images/' . $post->image))) {
                File::delete(public_path('images/' . $post->image));
            }
        }
    
        // Save the updated post
        $post->save();
    
        return response()->json(['message' => 'Post updated successfully', 'post' => $post], 200);
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
    
        return "post has been deleted";
    }
}
