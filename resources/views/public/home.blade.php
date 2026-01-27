<x-guest-layout>
    <div class="text-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Les articles les plus likés
        </h2>
    </div>

    <div>
        @forelse ($articles as $article)
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold">{{ $article->title }}</h2>
                <p class="text-gray-700 dark:text-gray-300">{{ substr($article->content, 0, 50) }}...</p>
                <div class="text-sm text-gray-500">Likes : {{ $article->likes }}</div>
                <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="text-red-500 hover:text-red-700">Lire la suite</a>
            </div>
            <hr>
        @empty
            <p>Aucun article populaire pour le moment.</p>
        @endforelse
    </div>
</x-guest-layout>