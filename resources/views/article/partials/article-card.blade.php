<a href="{{ route('articles.show', $article) }}">
    <section>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $article->title }}
        </h2>
        @if($article->image_path)
            <div class="mt-2">
                <img src="{{ $article->image_path }}" alt="{{ $article->title }}" class="rounded-full h-20 w-20 object-cover">
            </div>
        @endif
    </section>
</a>

