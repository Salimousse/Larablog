<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier l'article {{ $article->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form method="post" action="{{ route('articles.update', $article->id) }}">
            @csrf
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4">
                            <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                &larr; Retour au tableau de bord
                            </a>
                        </div>
                        
                        <!-- Input de titre de l'article -->
                        <div class="mb-4">
                            <label for="title" class="sr-only">Titre</label>
                            <input type="text" value="{{ $article->title }}" name="title" id="title" placeholder="Titre de l'article" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                        </div>

                        <!-- Contenu de l'article -->
                        <div class="mb-4">
                            <label for="content" class="sr-only">Contenu</label>
                            <textarea rows="20" name="content" id="content" placeholder="Contenu de l'article" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">{{ $article->content }}</textarea>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700">
                        <!-- choix catégorie -->
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <label for="categories" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catégories :</label>
                            <select name="categories[]" id="categories" multiple class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $article->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                        <!-- Action sur le formulaire -->
                        <div class="grow">
                            <input type="checkbox" name="draft" id="draft" {{ $article->draft ? 'checked' : '' }} class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                            <label for="draft" class="text-gray-700 dark:text-gray-300">Article en brouillon</label>
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Modifier l'article
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    
</x-app-layout>