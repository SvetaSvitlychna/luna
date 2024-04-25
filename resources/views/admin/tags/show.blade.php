@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Tag
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            
                            
                            <th>Category id</th>
                            <th>Name</th>                            
                            <th>Description</th>
                            <th>created at</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                                          
                            <td>{{ $tag->id}}</td>
                            <td>{{ $tag->name}}</td>
                            <td>{{ $tag->description}}</td>
                            <td>{{ $tag->created_at}}</td>
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