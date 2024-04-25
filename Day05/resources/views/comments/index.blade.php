@extends("layouts.app")
@section('title','list all comments')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Comments</div>
                    <a class="m-3" href="/comments/create"><button class="btn btn-success">create new Comment</button></a>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Body</th>
                                    <th>Show</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($comments as $comment)
                                    <tr>
                                        <th scope="row">{{ $comment['id'] }}</th>
                                        <td>{{ $comment['body'] }}</td>
                                        <td><a href="/comments/{{ $comment['id'] }}"><button type="submit" class="btn btn-info">View</button></a></td>
                                        <td><a href="/comments/{{ $comment['id'] }}/edit"><button type="submit" class="btn btn-warning">Edit</button></a></td>
                                        <td> 
                                           <form action="/comments/{{ $comment['id'] }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                           </form>
                                       </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No comments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

