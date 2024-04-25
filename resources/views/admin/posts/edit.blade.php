@extends('layouts.admin')
@section('title')
 {{$title}}
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Edit Post') }}
    <div>
<a style="margin-top:20px;" class="btn btn-success float-left" href="{{ url()->previous() }}">
                Back to list
            </a></div></div>
    <div class="card-body">
        <form method="POST"
        action="{{route('post.update', $post->id) }}"
        enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ __('Post Title') }}</label>
                <textarea class="form-control @error('title') 'is-invalid' @enderror }}"
                    type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>{{$post->title}}</textarea>
                @error('title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <span class="help-block">{{ __('Title Field Required') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="content">{{ __('Post Content') }}</label>
                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
                type="text" raw="5" name="content" id="content"
                value="{{ old('content', $post->content) }}" required>{{$post->content}}</textarea>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ __('Content Field Required') }}</span>
            </div>
            <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                <label for="tag">Tags</label>
                <select type="select" id="tag" name="tag[]" class="form-control select2" multiple="multiple"
                value="{{ old('tags', isset($tag) ? $tag->name : '') }}"

                >
                @foreach($tags as $id =>$tag)
                <option value="{{$id}}"
                {{($post->tags->pluck('id')->contains($id)) ? 'selected' : ''}}
                >{{$tag}}</option>
                @endforeach
                </select>
                    @if($errors->has('tags'))
                    <em class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </em>
                @endif
                <p class="helper-block">
                    Post tag
                </p>
            </div>
            <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                <label for="category">Category</label>
                <select type="select" id="category" name="category_id" class="form-control select2" required
                >
                @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ ($post->category_id == $id) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <em class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </em>
                @endif
                <p class="helper-block">
                    Post category
                </p>
            </div>

                <div class="max-auto uploader">
                    <input id="file-upload" type="file" name="cover" accept="image/*" onchange="readURL(this);">
                    <label id="file-upload" for="file-upload">
                        <img id="file-image" src="{{asset('storage/cover/blog/thumbnail/'.$post->cover)}}" alt="Preview" class="" >
                        <div id="start">
                            <i class="fas fa-download" aria-hidden="true"></i>
                            <div>Change this image</div>
                            <div id="notimage" class="hidden">Please select an image</div>
                            <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                            <br>
                            <span class="text-danger">{{ $errors->first('cover') }}</span>
                        </div>
                    </label>
                </div>


{{--                <label class="required" for="cover">{{ __('Post Cover') }}</label>--}}
{{--                <textarea class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"--}}
{{--                          type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required>{{$post->title}}</textarea>--}}
{{--                @if($errors->has('title'))--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('title') }}--}}
{{--                    </div>--}}
{{--                @endif--}}


                        <div class="form-group">
                <button class="btn btn-danger float-right" type="submit">
                    {{ __('Update') }}
                </button>
                <a  class="btn btn-success float-left" href="{{ url()->previous() }}">
                Back to list
            </a>
            </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ asset('js/select2.min.js') }}"></script>

<script src="{{ asset('js/select2.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2();
    });

    function readURL(input, id) {
        id = id || '#file-image';

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
            $('#file-image').removeClass('hidden');
            $('#start').hide();
        }
    }

</script>
@endsection
