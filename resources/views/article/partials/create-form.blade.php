<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('New Article') }}
        </h2>
    </header>

    <form method="post" enctype="multipart/form-data" action="{{ route('articles.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="category" :value="__('Category')" />
            <select id="category" name="category_id" class="mt-1  border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected(old('category_id') == $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
        </div>
        <div>
            <fieldset>
                <legend>Tags</legend>
                @foreach($tags as $tag)
                    <input id="{{ $tag->name }}"
                           type="checkbox" name="tags[]"
                           value="{{ $tag->id }}"
                           @checked( in_array($tag->id, old('tags', []))) />
                    <x-input-label class="inline" :for="$tag->name" :value="$tag->name" />
                @endforeach
            </fieldset>

            <x-input-error class="mt-2" :messages="$errors->get('tags')" />
        </div>

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="body" :value="__('Body')" />
            <textarea name="body" id="body" rows="30" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('body') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('body')" />
        </div>

        <div>
            <x-input-label for="image" :value="__('Image')" />
            <input type="file" name="image" accept="image/*"/>
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <div class="flex justify-end">
            <x-primary-button>{{ __('Add') }}</x-primary-button>
        </div>
    </form>
</section>
