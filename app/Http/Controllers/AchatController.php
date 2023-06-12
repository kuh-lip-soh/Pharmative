<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Achat;

class AchatController extends Controller
{
    public function index()
    {
        $achats = Achat::all();
        return view('pharm.achat.index', compact('achats'));
    }

    public function create()
    {
        $achat = new Achat();
        $achat->montant = 0;
        $achat->fournisseur = 'Aucun';
        $achat->save();

        return redirect()->route('pharm.achat.edit', ['achat' => $achat->id]);
    }
    public function edit(Achat $achat)
    {
        return view('pharm.achat.edit', compact('achat'));
    }
    public function add(Request $request, $id)
    {
        $achat = Achat::findOrFail($id);

        $articleId = $request->input('product-options');
        $quantite = $request->input('product-quantity');
        $fournisseur = $request->input('fournisseur');

        $article = Article::findOrFail($articleId);

        $achat->articles()->attach($articleId, ['quantite' => $quantite]);

        $achat->fournisseur = $fournisseur;
        $achat->montant += $article->prix * $quantite;
        $achat->save();

        return redirect()->route('pharm.achat.edit', $achat->id)->with('success', 'Article ajouté avec succès.');
    }
    public function delete($achatId, $articleId)
    {
        $achat = Achat::findOrFail($achatId);

        if ($achat->articles()->where('article_id', $articleId)->exists()) {

            $achat->articles()->detach($articleId);

            $montant = 0;
            foreach ($achat->articles as $article) {
                $montant += $article->pivot->quantite * $article->prix;
            }
            $achat->montant = $montant;
            $achat->save();

            return redirect()->route('achat.edit', $achat->id)->with('success', 'Article supprimé avec succès de l\'achat.');
        }

        return redirect()->route('achat.edit', $achat->id)->with('error', 'L\'article n\'est pas associé à l\'achat.');
    }

    public function destroy(Achat $achat)
    {
        $achat->articles()->detach();
        $achat->delete();

        return redirect()->route('pharm.achat')->with('success', 'Achat supprimé avec succès.');
    }
}