
@extends('layouts.admin')
@section('title')
 {{$title}}
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        Create permission
    </div>

    <div class="card-body">
        <form action="{{ route("permissions.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Title*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($permission) ? $permission->title : '') }}" required>
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    permission Title required
                </p>
            </div>
{{--            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">--}}
{{--                <label for="description">Description</label>--}}
{{--                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($permission) ? $permission->description : '') }}">--}}
{{--                @if($errors->has('description'))--}}
{{--                    <em class="invalid-feedback">--}}
{{--                        {{ $errors->first('description') }}--}}
{{--                    </em>--}}
{{--                @endif--}}
{{--                <p class="helper-block">--}}
{{--                    Categories Description--}}
{{--                </p>--}}
{{--            </div>--}}
            <div>
                <input class="btn btn-danger" type="submit" value="save">
            </div>
        </form>


    </div>
</div>
@endsection
