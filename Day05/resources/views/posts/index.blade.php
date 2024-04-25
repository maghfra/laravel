@extends("layouts.app")
@section('title','list all posts')
@section('content')

<div class="container">
    <h2 class="mt-5">All Posts</h2>
    <a href="/posts/create"><button class="btn btn-success mb-3">create new post</button></a>
<table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Body</th>
          <th>Image</th>
          <th>User</th>
          <th>Show</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
      @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>  
                    <td><img style="border-radius: 50px;" src="/images/{{ $post->image }}" width="200" height="200"/></td>
                    <td>{{ $post->user->name}}</td>                 
                    <td><a href="/posts/{{ $post['id'] }}"><button type="submit" class="btn btn-info">View</button></a></td>
                    <td><a href="/posts/{{ $post['id'] }}/edit"><button type="submit" class="btn btn-warning">Edit</button></a></td>
                    <td> 
                    <form action="/posts/{{ $post['id'] }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
           </td> 

                </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection
