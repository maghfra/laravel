@extends("layouts.app")
@section('title','edit a comment')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Comment</div>

                    <div class="card-body">
                        <form action="/comments/{{ $comment['id']}}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                               <label for="body" class="form-label">Body</label>
                               <textarea class="form-control" id="body" name="body" rows="3" required>{{ $comment['body'] }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

