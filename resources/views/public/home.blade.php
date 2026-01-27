<x-guest-layout>
    <div class="text-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Les articles les plus likés
        </h2>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @forelse ($articles as $article)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="block hover:underline">
                    <h2 class="text-2xl font-bold text-white dark:text-gray-900">{{ $article->title }}</h2>
                    <p class="text-gray-700 dark:text-gray-300">{{ substr($article->content, 0, 50) }}...</p>
                </a>
                <div class="mt-2">
                    @foreach($article->categories as $category)
                        <span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded mr-1">{{ $category->name }}</span>
                    @endforeach
                </div>
                <div class="text-sm text-gray-500 mt-2">Likes : {{ $article->likes }}</div>
            </div>
        </div>
        @empty
            <p>Aucun article populaire pour le moment.</p>
        @endforelse
    </div>
</x-guest-layout>