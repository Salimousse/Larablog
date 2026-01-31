@props(['article', 'excerptLength' => 50, 'showLikes' => false])

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="block hover:underline">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $article->title }}</h2>
            <p class="text-gray-700 dark:text-gray-300">{{ \Illuminate\Support\Str::limit($article->content, $excerptLength) }}</p>
        </a>

        <div class="mt-2">
            @foreach($article->categories as $category)
                <span class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs px-2 py-1 rounded mr-1">{{ $category->name }}</span>
            @endforeach
        </div>

        @if($showLikes)
            <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">Likes : {{ $article->likes }}</div>
        @endif

        @isset($actions)
            <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-3 flex justify-end space-x-4">
                {{ $actions }}
            </div>
        @endisset
    </div>
</div>
