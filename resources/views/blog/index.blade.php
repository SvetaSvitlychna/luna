{{--@extends('layouts.blog')--}}

{{--@section('content')--}}
{{--    <div class="w-3/4 bg-gray-500  mr-1">--}}

{{--        @foreach ($posts as $post)--}}
{{--            <article class="w-full py-2 bg-white px-8 my-8 border-blue-800 border-l-8">--}}
{{--            <div class="flex flex-col py-6">--}}
{{--                <a class="font-bold text-2xl hover:underline" href="{{route('show',$post->slug)}}">{{$post->title}}</a>--}}
{{--            </div>--}}
{{--            <div class="flex items-center justify-between pt-4 pb-6 border-b text-gray-700">--}}
{{--                    <span>Posted by: {{$post->user->profile->full_name ?? 'unknown'}}</span>--}}
{{--                    <span>Belongs to Category:<a href="{{route('category', $post->category_id)}}">--}}
{{--                            {{$post->category->name}}</a></span>--}}
{{--                    <span>Created at:{{Carbon\Carbon::parse($post->created_at)->format('Md')}}</span>--}}
{{--            </div>--}}
{{--            <div class="flex flex-col py-6">--}}
{{--                <img src="{{asset("storage/cover/blog/thumbnail/{$post->cover}")}}">--}}
{{--                    {{$post->short}}--}}
{{--            </div>--}}


{{--            --}}{{-- <p>Author:{{$post->user->profile->full_name ?? 'unknown'}}</p>   --}}

{{--            --}}{{--       @php--}}
{{--            --}}{{--         var_dump(route('user',$post->user->id));die; --}}
{{--            --}}{{--      @endphp --}}

{{--            --}}{{-- @if (isset($object->property)) {--}}
{{--      <p>Author:<a href="{{route('user', $post->user_id)}}">{{ $post->user->profile->full_name ?? 'unknown'}}</a></p>--}}
{{--      } else {--}}
{{--      error--}}
{{--      } --}}
{{--            --}}{{--    <p>Author: <a href="{{route('user',$post->user->id)}}">{{ $post->user->profile->full_name ?? 'unknown'}}</a></p>--}}


{{--                        <p>Likes {{$post->votes}}--}}
{{--                <a href="{{route('like', $post->id)}}">--}}
{{--                    <button>Like</button></a></p>--}}
{{--            --}}{{-- <a href="{{route('blog')}}">--}}
{{--                All Posts <i class="icon-angle-left"></i>--}}
{{--        </a> --}}

{{--            </article>--}}
{{--        @endforeach--}}

{{-- </div>--}}

{{--@endsection--}}

<section class="flex flex-col justify-center items-center">
    <div class="container px-5 py-24 mx-auto">
        <livewire:index-posts>

        </livewire:index-posts>
    </div>


</section>
