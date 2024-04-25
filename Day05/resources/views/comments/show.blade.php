@extends("layouts.app")
@section('title','show a comment')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Comment Details</div>

                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $comment['id'] }}</p>
                        <p><strong>Body:</strong> {{ $comment['body'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

