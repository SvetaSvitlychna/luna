@extends('layouts.admin')
@section('title')
 {{$title}}
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Edit permission') }}
    </div>

    <div class="card-body">
        <form method="POST"
        action="{{route('permissions.update', $permission->id) }}"
        enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ __('permission title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" title="title" id="title"
                       value="{{ old('title', $permission->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ __('Title Field Required') }}</span>
            </div>
{{--            <div class="form-group">--}}
{{--                <label class="required" for="description">{{ __('Description') }}</label>--}}
{{--                <textarea class="form-control" title
="description" id="description" required>--}}
{{--                {{ $permission->description }}</textarea>--}}
{{--                <span class="help-block">{{ __('Content Field Required') }}</span>--}}
{{--            </div> --}}
{{--             <div class="form-group">--}}
{{--                <label for="status">{{ __('Is Published?') }}</label>--}}
{{--                <input class="form-control" type="checkbox" title--}}
{{--                ="status" id="published" {{ ($permission->status == 1)?'checked':'' }}>--}}
{{--                <span class="help-block">{{ __('Status permission') }}</span>--}}
{{--            </div>--}}
                        <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
