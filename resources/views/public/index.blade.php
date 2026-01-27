
<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liste des articles publiés de {{ $user->name }}
        </h2>
    </div>

    <!-- Barre de recherche et filtre -->
    <div class="max-w-2xl mx-auto mb-8">
        <form method="GET" action="" class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un titre..." class="rounded border-gray-300 px-3 py-2 w-full sm:w-64">
            <select name="category" class="rounded border-gray-300 px-3 py-2 w-full sm:w-48">
                <option value="">Toutes les catégories</option>
                @foreach(\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full sm:w-auto">Filtrer</button>
        </form>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach ($articles as $article)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="block hover:underline">
                    <h2 class="text-2xl font-bold text-white dark:text-gray-900">{{ $article->title }}</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ substr($article->content, 0, 30) }}...</p>
                </a>
                <div class="mt-2">
                    @foreach($article->categories as $category)
                        <span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded mr-1">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-guest-layout>