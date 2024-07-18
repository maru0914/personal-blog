<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('tags.update', $tag) }}">
            @csrf
            @method('PATCH')
            <textarea
                name="name"
                placeholder="{{ __('Please enter new tag name') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('name', $tag->name) }}</textarea>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
                <a href="{{ route('tags.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
