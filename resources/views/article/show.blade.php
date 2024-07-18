<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ $article->title }}
                            </h2>
                        </header>
                        <main>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {!! $article->body !!}
                            </p>
                        </main>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
