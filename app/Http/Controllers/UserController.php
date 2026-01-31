<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
{
    return view('articles.create') ->with('categories', Category::all());

    
    


}

public function store(Request $request)
{
    // On récupère les données du formulaire
    $data = $request->only(['title', 'content', 'draft', 'category_id', 'tags']);

    // Créateur de l'article (auteur)
    $data['user_id'] = Auth::user()->id;

    // Gestion du draft
    $data['draft'] = isset($data['draft']) ? 1 : 0;

    // On crée l'article

    $article = Article::create($data);
    // $article est l'article sauvé en base de données (resultat de la méthode create ou d'un update)
    // Exemple pour ajouter des catégories à l'article en venant du formulaire
    $article->tags()->sync($request->input('tags'));
    $article->categories()->sync($request->input('categories'));

   
   
    
    
     
    return redirect()->route('dashboard');
}

public function index(Request $request)
{
    $user = Auth::user();
    $query = Article::where('user_id', $user->id)->with(['categories','tags']);

    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->whereHas('categories', function($q) use ($request) {
            $q->where('categories.id', $request->category);
        });
    }

    if ($request->filled('tag')) {
        $query->whereHas('tags', function($q) use ($request) {
            $q->where('tags.id', $request->tag);
        });
    }

    $articles = $query->paginate(5);

    return view('dashboard', ['articles' => $articles]);
}


public function edit(Article $article)
{
    // On vérifie que l'utilisateur est bien le créateur de l'article
    if ($article->user_id !== Auth::user()->id) {
        abort(403);
    }

    // On retourne la vue avec l'article
    return view('articles.edit', [
        'article' => $article,
        'categories' => Category::all()
    ]);
}

public function update(Request $request, Article $article)
{
    // On vérifie que l'utilisateur est bien le créateur de l'article
    if ($article->user_id !== Auth::user()->id) {
        abort(403);
    }

  

    // On récupère les données du formulaire

    $data = $request->only(['title', 'content', 'draft']);

    // Gestion du draft
    $data['draft'] = isset($data['draft']) ? 1 : 0;

    // On met à jour l'article

    $article->update($data);
    // Synchroniser les catégories sélectionnées
    if ($request->has('categories')) {
        $article->categories()->sync($request->input('categories'));
    }

    


    // On redirige l'utilisateur vers la liste des articles (avec un flash)
    return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
}


public function remove(Article $article)
{
    // On vérifie que l'utilisateur est bien le créateur de l'article
    if ($article->user_id !== Auth::user()->id) {
        abort(403);
    }

    $article = Article::find($article->id);

    // On supprime l'article
    $article->delete();

    // On redirige l'utilisateur vers la liste des articles (avec un flash)
    return redirect()->route('dashboard')->with('success', 'Article supprimé !');
}

public function like(Article $article)
{
    // On incrémente le nombre de likes
    $article->likes = $article->likes + 1;
    $article->save();

    // On redirige l'utilisateur vers la page précédente
    return redirect()->back();

}
}