<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $articles = Article::orderBy('nom', 'asc')->get();
        $utilisations = Article::distinct('utilisation')->pluck('utilisation');

        return view('pharm.stock.index', compact('articles', 'utilisations'));
    }
    public function article($id)
    {
        $article = Article::findOrFail($id);
        return view('article', compact('article'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $articles = Article::where('nom', 'LIKE', '%' . $search . '%')->orderBy('nom', 'asc')->get();

        return response()->json($articles);
    }
    public function show(Article $article)
    {
        return view('pharm.stock.show', compact('article'));
    }
    public function medicament()
    {
        $articles = Article::where('type', 'Médicament')->paginate(10);
        return view('medicament', compact('articles'));
    }
    public function materiel()
    {
        $articles = Article::where('type', 'Matériel')->paginate(10);
        return view('materiel', compact('articles'));
    }

    public function espacebebe()
    {
        $articles = Article::where('type', 'Espace Bébé')->paginate(10);
        return view('espacebebe', compact('articles'));
    }

}