<div class="flex flex-wrap m-4 mx-4 mb-10 mt-4">
    @forelse($this->posts as $post)

        <article class="flex flex-col justify-center items-center mx-auto w-1/3 mb-6 p-4">
            <div class="bg-gray-300 h-58 w-full rounded-lg bg-cover bg-center"
                 style="background-image: url({{asset("/storage/cover/blog/{$post->cover}")}}); background-size: cover;
                 background-repeat: no-repeat;width: 150px;height: 150px;">

            </div>
            <div class="title-post text-justify">
                {{$post->title}}
            </div>
        </article>
        @empty
        <h2>No Posts yet</h2>
    @endforelse
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
