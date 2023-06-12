<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Http\Request;
use App\Models\Pharmacien;
use App\Models\Patient;

class PharmacienController extends Controller
{

    public function edit($id)
    {
        $pharmacien = Pharmacien::findOrFail($id);
        $patients = Patient::where('nom', $pharmacien->nom)->get();
        return view('pharm.personnel.edit', compact('pharmacien', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_de_naissance' => 'required|date',
            'adresse' => 'required|string',
            'telephone' => 'required|string',
            'profil_patient' => 'string',
        ]);

        try {
            $pharm = Pharmacien::findOrFail($id);
            $pharm->nom = $request->input('nom');
            $pharm->prenom = $request->input('prenom');
            $pharm->date_de_naissance = $request->input('date_de_naissance');
            $pharm->adresse = $request->input('adresse');
            $pharm->telephone = $request->input('telephone');
            $pharm->save();

            if ($patient = Patient::find(intval($request->profil_patient))) {
                $patient->user_id = $pharm->user_id;
                $patient->save();
            }


            return redirect()->route('pharm.personnel')->with('success', 'Informations du pharmacien mises à jour avec succès.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pharm.personnel')->with('error', 'Pharmacien non trouvé.');
        } catch (Exception $e) {
            return redirect()->route('pharm.personnel')->with('error', 'Une erreur est survenue lors de la mise à jour des informations du pharmacien.');
        }
    }
}