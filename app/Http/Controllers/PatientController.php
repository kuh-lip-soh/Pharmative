<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Http\Request;
use App\Models\Patient;
use Auth;

class PatientController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $patients = Patient::where('nom', 'LIKE', '%' . $search . '%')->orderBy('nom', 'asc')->get();

        return response()->json($patients);
    }
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('pharm.patient.edit', compact('patient'));
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $dateNaissance = $request->input('dateNaissance');
        $taille = $request->input('taille');
        $poids = $request->input('poids');
        $adresse = $request->input('adresse');
        $telephone = $request->input('telephone');

        $patient = $user->patient;
        $patient->nom = $nom;
        $patient->prenom = $prenom;
        $patient->date_de_naissance = $dateNaissance;
        $patient->taille = $taille;
        $patient->poids = $poids;
        $patient->adresse = $adresse;
        $patient->telephone = $telephone;
        $patient->save();

        $user->email = $email;
        $user->save();

        return redirect()->route('patient.profile')->with('success', 'Votre profil a été mis à jour avec succès.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_de_naissance' => 'required|date',
            'poids' => 'numeric',
            'taille' => 'numeric',
            'adresse' => 'required|string',
            'telephone' => 'required|string',
        ]);

        try {
            $patient = Patient::findOrFail($id);
            $patient->nom = $request->input('nom');
            $patient->prenom = $request->input('prenom');
            $patient->date_de_naissance = $request->input('date_de_naissance');
            $patient->poids = $request->input('poids');
            $patient->taille = $request->input('taille');
            $patient->adresse = $request->input('adresse');
            $patient->telephone = $request->input('telephone');
            $patient->save();



            return redirect()->route('pharm.patient')->with('success', 'Informations du pharmacien mises à jour avec succès.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pharm.patient')->with('error', 'Pharmacien non trouvé.');
        } catch (Exception $e) {
            return redirect()->route('pharm.patient')->with('error', 'Une erreur est survenue lors de la mise à jour des informations du pharmacien.');
        }
    }
}