@extends("layouts.app")
@section('title', 'Show Post')
@section('content')

<div class="container">
    <h2 class="mt-5">Post {{ $post->id }}</h2>
    <hr width="70">
    <p><b>ID: </b>{{ $post->id }}</p>
    <p><b>Title: </b>{{ $post->title }}</p>
    <p><b>Body: </b>{{ $post->body }}</p>
    <b>Comments: </b>
    @foreach($post->comments as $comment)
    <p>{{ $comment->body }}</p>
    @endforeach

    <form action="{{ route('comments.store', ['post' => $post->id]) }}" method="POST">
        @csrf
        <textarea name="body" rows="3"></textarea>
        <button type="submit">Submit Comment</button>
    </form>
</div>

@endsection
