@extends('layouts.admin')
@section('title')
{{$title}}
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        Show Posts
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                    <thead>
                        <tr>


                            <th>Post id</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Category</th>
                            <th>TAgs</th>
                            <th>Cover</th>
                            <th>created at</th>

                        </tr>
                    </thead>
                    <tbody>

                            <td>{{ $post->id}}</td>
                            <td>{{ $post->title}}</td>
                            <td>{{ $post->content}}</td>
                            <td>{{ $post->category->name}}</td>
                            <td>{{ $post->tagname}}</td>
                            <td><img id="file-image" src="{{asset('storage/cover/blog/thumbnail/'.$post->cover)}}" alt="Preview" class="" ></td>
                            <td>{{ $post->created_at}}</td>
                    </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                Back to list
            </a>
        </div>

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection
