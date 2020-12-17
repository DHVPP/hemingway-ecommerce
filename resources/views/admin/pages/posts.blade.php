@extends('layouts.admin')
@section('content')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <!--<div class="btn-toolbar mb-2 mb-md-0">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    This week
                </button>
            </div>-->
    </div>

    <!--<canvas class="my-4" id="myChart" width="900" height="380"></canvas>-->

    <h2>Blog postovi</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naslov</th>
                    <th>Datum</th>
                    <th>Edit post</th>
                    <th>Delete post</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><a href="/blog/post/{{$post->id}}">{{$post->title}}</a></td>
                    <td>{{$post->created_at}}</td>
                    <td><a href="/admin/blog/posts/{{$post->id}}">Edit post</a></td>
                    {{ Form::open(['url' => '/admin/blog/post/' . $post->id, 'method' => 'DELETE', 'id' => 'deleteForm']) }}
                    <td><a id="delete" href="#" onclick="deletePost()">Delete post</a></td>
                    {{ Form::close() }}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
<script>
    function deletePost() {
        document.getElementById('deleteForm').submit();
    }
</script>
@endsection