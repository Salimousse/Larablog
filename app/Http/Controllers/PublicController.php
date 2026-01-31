<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class PublicController extends Controller
{
    public function index(User $user, \Illuminate\Http\Request $request)
{
    // Construire la requête de base (articles publiés de l'utilisateur)
    $query = Article::where('user_id', $user->id)->where('draft', 0)->with(['categories','tags']);

    // Filtre par recherche de titre
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Filtre par catégorie
    if ($request->filled('category')) {
        $query->whereHas('categories', function($q) use ($request) {
            $q->where('categories.id', $request->category);
        });
    }

    // Filtre par tag
    if ($request->filled('tag')) {
        $query->whereHas('tags', function($q) use ($request) {
            $q->where('tags.id', $request->tag);
        });
    }

    $articles = $query->get();

    // On retourne la vue
    return view('public.index', [
        'articles' => $articles,
        'user' => $user
    ]);
} 

public function show(User $user, Article $article)
{
    // On vérifie que l'article appartient à l'utilisateur et n'est pas un brouillon
    if ($article->user_id !== $user->id || $article->draft) {
        abort(404);
    }

    // On retourne la vue
    return view('public.show', [
        'article' => $article,
        'user' => $user
    ]);


 


}


public function home()
{
    $articles = \App\Models\Article::orderBy('likes', 'desc')->take(5)->get();
    return view('public.home', compact('articles'));
}

}
