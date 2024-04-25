@extends("layouts.app")
@section('title','create a comment')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Comment</div>

                    <div class="card-body">

<!-- comments/create.blade.php -->

<form action="{{ route('comments.store', ['post' => $post->id]) }}" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control" id="body" name="body" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
