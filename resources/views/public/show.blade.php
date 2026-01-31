<x-guest-layout>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="text-center mb-4">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $article->title }}
                </h2>
            </div>

            <div class="mb-4">
                <a href="{{ url()->previous() }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                    &larr; Retour
                </a>
            </div>

            <div class="mb-2">
                @foreach($article->categories as $category)
                    <span class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs px-2 py-1 rounded mr-1">{{ $category->name }}</span>
                @endforeach
            </div>

            <div class="text-gray-500 dark:text-gray-400 text-sm mb-4">
                Publié le {{ $article->created_at->format('d/m/Y') }} par <a href="{{ route('public.index', $article->user->id) }}" class="text-blue-500 hover:underline">{{ $article->user->name }}</a>
            </div>

            @auth
            <div class="flex items-center space-x-2 mb-4">
                <a href="{{ route('article.like', $article->id) }}" class="flex items-center space-x-1 text-blue-500 hover:text-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61" clip-rule="evenodd" />
                    </svg>
                    <span>{{$article->likes}}</span>
                </a>
            </div>
            @endauth

            <div class="text-gray-900 dark:text-gray-100 mb-4">
                <p class="text-gray-700 dark:text-gray-300">{{ $article->content }}</p>
            </div>
            
            <div class="mb-4">
                @foreach($article->tags as $tag)
                    <span class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs px-2 py-1 rounded mr-1">#{{ $tag->name }}</span>
                @endforeach
            </div>

            <!-- Liste des commentaires -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Commentaires</h3>
                @forelse ($article->comments as $comment)
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <strong>{{ $comment->user->name }}</strong> le {{ $comment->created_at->format('d/m/Y H:i') }}
                        </p>
                        <p class="mt-2 text-gray-800 dark:text-gray-200">{{ $comment->content }}</p>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">Aucun commentaire pour l'instant.</p>
                @endforelse
            </div>

            <!-- Ajout d'un commentaire -->
            @auth
            <form action="{{ route('comments.store') }}" method="post" class="mt-6">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ajouter un commentaire :</label>
                    <textarea name="content" id="content" rows="3" class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-200" required></textarea>
                </div>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Publier</button>
            </form>
            @endauth
        </div>
    </div>
</x-guest-layout>