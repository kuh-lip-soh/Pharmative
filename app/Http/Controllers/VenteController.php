<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Vente;
use App\Models\Paiement;
use App\Models\Livraison;
use Auth;
use DB;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');

        if (empty($cart)) {
            $tableRows = [];
            $totalPrice = 0;
        } else {
            $tableRows = [];
            $totalPrice = 0;

            foreach ($cart as $key => $item) {
                if (!isset($item['product_id'])) {
                    continue;
                }

                $product = Article::find($item['product_id']);

                $cartItem = [
                    'name' => isset($item['product_name']) ? $item['product_name'] : $product->nom,
                    'quantity' => $item['quantity'],
                    'price' => $product->prix,
                    'total' => $product->prix * $item['quantity'],
                    'key' => $key,
                ];

                $tableRows[] = $cartItem;

                $totalPrice += $cartItem['total'];
            }
        }

        return view('pharm.vente.index', compact('tableRows', 'totalPrice'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product-options' => 'required',
            'product-quantity' => 'required|integer|min:1',
        ]);

        $productId = $request->input('product-options');
        $quantity = $request->input('product-quantity');

        $product = Article::find($productId);
        $cartItem = [
            'product_id' => $product->id,
            'quantity' => $quantity,
        ];

        session()->push('cart', $cartItem);
        return redirect()->route('pharm.vente')->with('success', 'Article ajouté.');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('pharm.vente')->with('success', 'Article supprimé.');
    }

    public function cancel()
    {
        session()->forget('cart');

        return redirect()->route('pharm.vente')->with('success', 'Vente annulée.');
    }

    public function validate(Request $request, array $rules, array $messages = [], array $attributes = [])
    {
        $patientId = $request->input('patient-options');
        $cartItems = session()->get('cart');

        $montant = 0;
        $vente = Vente::create([
            'patient' => $patientId,
            'montant' => 0,
            'etat' => false,
        ]);

        if (!empty($cartItems)) {
            foreach ($cartItems as $cartItem) {
                $vente->articles()->attach($cartItem['product_id'], ['quantite' => $cartItem['quantity']]);
                $prix = Article::find($cartItem['product_id'])->prix;
                $montant += $cartItem['quantity'] * $prix;
            }

            $vente->montant = $montant;
            $vente->save();
        }
        DB::commit();

        session()->forget('cart');

        return redirect()->route('pharm.vente')->with('success', 'Vente validée.');
    }
    public function historique()
    {
        $ventes = Vente::join('patients', 'ventes.patient', '=', 'patients.id')
            ->select('ventes.*', 'patients.nom', 'patients.prenom')
            ->get();

        return view('pharm.vente.historique', compact('ventes'));
    }

    public function edit(Vente $vente)
    {
        $vente = Vente::join('patients', 'ventes.patient', '=', 'patients.id')
            ->where('ventes.id', $vente->id)
            ->select('ventes.*', 'patients.nom', 'patients.prenom')
            ->first();
        $articles = $vente->articles;
        $paiement = Paiement::where('vente', $vente->id);
        $livraison = Livraison::where('vente', $vente->id);

        return view('pharm.vente.edit', compact('vente', 'articles', 'paiement', 'livraison'));
    }

    public function update(Request $request, Vente $vente)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);
        $vente->articles()->updateExistingPivot($request->input('article_id'), [
            'quantite' => $request->input('quantite'),
        ]);

        return redirect()->route('pharm.vente.historique', $vente)->with('success', 'Détails de la vente mis à jour.');
    }

    public function updateLivraison(Request $request, Livraison $livraison)
    {
        $livraison->adresse = $request->input('adresse');
        $livraison->save();

        return redirect()->route('pharm.vente.edit', $livraison->vente)->with('success', 'Adresse de livraison modifiée.');
    }


    public function destroy(Vente $vente)
    {
        $vente->articles()->detach();
        $vente->paiements()->delete();
        $vente->livraisons()->delete();
        $vente->delete();

        return redirect()->route('pharm.vente.historique')->with('success', 'Vente supprimée.');
    }

    public function addToCart(Request $request, Article $article)
    {
        $quantite = $request->input('quantite', 1);

        if (!$article) {
            return redirect()->back()->with('error', 'Article non trouvé.');
        }

        $panier = session()->get('panier', []);

        if (isset($panier[$article->id])) {
            $panier[$article->id]['quantite'] += $quantite;
            $panier[$article->id]['total'] += $article->prix * $quantite;
        } else {
            $panier[$article->id] = [
                'id' => $article->id,
                'nom' => $article->nom,
                'prix' => $article->prix,
                'image' => $article->image,
                'total' => $article->prix * $quantite,
                'quantite' => $quantite,
            ];
        }

        session()->put('panier', $panier);

        return redirect()->back()->with('success', 'Article ajouté au panier.');
    }

    public function showCart()
    {
        $panier = session()->get('panier', []);

        $total = 0;

        foreach ($panier as $item) {
            $article = Article::find($item['id']);
            if ($article) {
                $total += $article->prix * $item['quantite'];
            }
        }

        return view('panier', compact('panier', 'total'));
    }
    public function deleteFromCart(Article $article)
    {
        if (session()->has('panier')) {
            $panier = session('panier');
            unset($panier[$article->id]);
            session()->put('panier', $panier);
        }

        return redirect()->back()->with('success', 'L\'article a été supprimé.');
    }
    public function deleteCart()
    {
        session()->forget('panier');
        return redirect()->route('/');
    }
    public function validateCart()
    {
        if (Auth::user()) {
            $panier = session()->get('panier', []);

            $vente = new Vente();
            $vente->patient = Auth::user()->patient->id;
            $montant = 0;
            foreach ($panier as $item) {
                $montant += $item['total'];
            }
            $vente->montant = $montant;
            $vente->save();

            foreach ($panier as $item) {
                $vente->articles()->attach($item['id'], ['vente' => $vente->id, 'quantite' => $item['quantite']]);
            }

            $paiement = new Paiement();
            $paiement->vente = $vente->id;
            $paiement->save();


            session()->forget('panier');
            return view('paiement', compact('paiement'));
        } else
            return redirect()->route('patient.login');

    }
    public function validatePaiement(Request $request, $id)
    {
        $paiement = Paiement::find($id);
        $paiement->type = $request->input('payment_type');
        $paiement->code = $request->input('card-number');
        $paiement->save();


        $livraison = new Livraison();
        $livraison->vente = $paiement->vente;
        $livraison->save();
        return view('livraison', compact('livraison'));
    }
    public function validateLivraison(Request $request, $id)
    {
        $livraison = Livraison::find($id);
        $livraison->adresse = $request->input('adresse');
        $livraison->save();

        return redirect()->route('patient.profile.commande', ['vente' => $livraison->vente]);
    }

}