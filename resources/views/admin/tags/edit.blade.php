@extends('layouts.admin')
@section('title')
 {{$title}}
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Edit Tag') }}
    </div>

    <div class="card-body">
        <form method="POST" 
        action="{{route('tags.update', $tag->id) }}" 
        enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ __('Tag Name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $tag->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ __('Title Field Required') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ __('Description') }}</label>
                <textarea class="form-control" name="description" id="description" required>
                {{ $tag->description }}</textarea>
                <span class="help-block">{{ __('Content Field Required') }}</span>
            </div> 
             <div class="form-group">
                <label for="status">{{ __('Is Published?') }}</label>
                <input class="form-control" type="checkbox" name="status" id="published" {{ ($tag->status == 1)?'checked':'' }}>
                <span class="help-block">{{ __('Status Category') }}</span>
            </div>
                        <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection