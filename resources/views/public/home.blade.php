<x-guest-layout>
    <div class="text-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Les articles les plus likés
        </h2>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @forelse ($articles as $article)
            <x-article-card :article="$article" :excerpt-length="50" :show-likes="true" />
        @empty
            <p>Aucun article populaire pour le moment.</p>
        @endforelse
    </div>
</x-guest-layout>