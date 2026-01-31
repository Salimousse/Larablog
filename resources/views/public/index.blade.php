
<x-guest-layout>


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
            <select name="tag" class="rounded border-gray-300 px-3 py-2 w-full sm:w-48">
                <option value="">Tous les tags</option>
                @foreach(\App\Models\Tag::all() as $tag)
                    <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full sm:w-auto">Filtrer</button>
        </form>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach ($articles as $article)
            <x-article-card :article="$article" :excerpt-length="30" />
        @endforeach
    </div>
</x-guest-layout>