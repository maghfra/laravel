<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', ['comments' => $comments]);
    }
    public function create($postId)
    {
        $post = Post::find($postId); // Fetch the post by ID
        return view("comments.create", ["post" => $post]); // Pass the post to the view
    }


 public function store(Request $request, $postId)
{
    $request->validate([
        'body' => 'required|string',
    ]);

    // Find the post by ID
    $post = Post::findOrFail($postId);

    // Create a new comment associated with the post
    $post->comments()->create([
        'user_id' => auth()->id(),
        'body' => $request->body,
    ]);

    return redirect()->back()->with('success', 'Comment added successfully.');
}

    function show($id){
        $comment = Comment::find($id);
        return view('comments.show',['comment'=>$comment]);
    }
    function edit($id){
        $comment = Comment::find($id);
        return view('comments.edit',['comment'=>$comment]);
    }
    function update($id, Request $request){
        $comment = Comment::find($id);
        $comment->body = $request->body;
        $comment->save();
        return redirect('/comments');

    }
    function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
    
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

}