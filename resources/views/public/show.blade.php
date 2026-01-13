<x-guest-layout>
    <div class="text-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $article->title }}
        </h2>
    </div>

    <div class="text-gray-500 text-sm">
        Publié le {{ $article->created_at->format('d/m/Y') }} par <a href="{{ route('public.index', $article->user->id) }}">{{ $article->user->name }}</a>
    </div>

    <div>
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <p class="text-gray-700 dark:text-gray-300">{{ $article->content }}</p>
        </div>
    </div>

    <!-- Liste des commentaires -->
@foreach ($article->comments as $comment)
    <div class="border-t border-gray-300 mt-4 pt-4">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            <strong>{{ $comment->user->name }}</strong> a commenté le {{ $comment->created_at->format('d/m/Y H:i') }} :
        </p>
        <p class="mt-2 text-gray-800 dark:text-gray-200">{{ $comment->content }}</p>
    </div>
   
@endforeach

    <!-- Ajout d'un commentaire -->
<form action="{{ route('comments.store') }}" method="post" class="mt-6">
    @csrf
    @Auth
    <input type="hidden" name="article_id" value="{{ $article->id }}">

    <div>
        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ajouter un commentaire :</label>
        <textarea name="content" id="content" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200" required></textarea>
    </div>
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Publier</button>




    


   
    @endauth


</form>
</x-guest-layout>