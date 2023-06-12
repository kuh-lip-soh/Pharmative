<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Livraison;
use App\Models\Paiement;
use App\Models\Patient;
use App\Models\Pharmacien;
use App\Models\Vente;
use Auth;
use Session;

class NavController extends Controller
{
    function index()
    {
        $medicaments = Article::where('type', 'Médicament')->inRandomOrder()->take(5)->get();
        $materiels = Article::where('type', 'Matériel')->inRandomOrder()->take(5)->get();
        $espacesBebe = Article::where('type', 'Espace Bébé')->inRandomOrder()->take(5)->get();
        return view('main', compact('medicaments', 'materiels', 'espacesBebe'));
    }
    public function getPanierCount()
    {
        $panierCount = 0;
        if (Session::has('panier')) {
            $panier = Session::get('panier');
            $panierCount = count($panier);
        }

        return response()->json(['count' => $panierCount]);
    }
    function patientProfile()
    {
        if (Auth::user()) {
            $patient = Auth::user()->patient;
            $ventes = $patient->ventes()->with('paiement', 'livraison')->get();

            return view('patient.profile', compact('ventes'));
        } else
            return redirect('/');
    }

    function patientCommande(Vente $vente)
    {
        if (Auth::user()) {
            $vente = Vente::join('patients', 'ventes.patient', '=', 'patients.id')
                ->where('ventes.id', $vente->id)
                ->select('ventes.*')
                ->first();
            $articles = $vente->articles;
            $paiement = Paiement::where('vente', $vente->id);
            $livraison = Livraison::where('vente', $vente->id);

            return view('patient.commande', compact('vente', 'articles', 'paiement', 'livraison'));
        } else
            return redirect('/');
    }


    function dashboard()
    {
        if (Auth::user()->role == "Pharmacien")
            return view('pharm.dashboard');
        else
            return redirect('/');
    }
    function vente()
    {
        if (Auth::user()->role == "Pharmacien")
            return view('pharm.vente.index');
        else
            return redirect('/');
    }
    function historique()
    {
        if (Auth::user()->role == "Pharmacien")
            return view('pharm.vente.historique');
        else
            return redirect('/');
    }
    function achat()
    {
        if (Auth::user()->role == "Pharmacien")
            return view('pharm.achat');
        else
            return redirect('/');
    }
    function stock()
    {
        if (Auth::user())
            if (Auth::user()->role == "Pharmacien")
                return view('pharm.stock.index');
            else
                return redirect('/');
    }
    function patient()
    {
        if (Auth::user()->role == "Pharmacien") {
            $patients = Patient::all();
            return view('pharm.patient.index', compact('patients'));
        } else
            return redirect('/');
    }
    function personnel()
    {
        if (Auth::user()->role == "Pharmacien") {
            $pharmaciens = Pharmacien::all();
            return view('pharm.personnel.index', compact('pharmaciens'));
        } else
            return redirect('/');
    }


}