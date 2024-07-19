<section>
    <div class="flex justify-end">
        <h1 class="text-sm text-right bg-indigo-500 text-white inline-block rounded-lg px-2 py-1">
            {{ $article->category->name }}
        </h1>
    </div>

    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ $article->title }}
    </h2>
    @if($article->image_path)
        <div class="mt-2">
            <img src="{{ $article->image_path }}" alt="{{ $article->title }}" class="rounded-full h-20 w-20 object-cover">
        </div>
    @endif

    <div class="flex justify-end font-bold">
        @foreach($article->tags as $tag)
            #{{ $tag->name }}
        @endforeach
    </div>


</section>

