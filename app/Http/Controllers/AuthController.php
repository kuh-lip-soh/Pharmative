<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use App\Models\Patient;
use App\Models\Pharmacien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function loginForm()
    {
        return view('patient.login');
    }
    function signupForm()
    {
        return view('patient.signup');
    }

    function loginFormPharm()
    {
        return view('pharm.login');
    }
    public static function authentified_user_data()
    {
        $id = Auth::user()->id;
        $role = Auth::user()->role;
        if ($role == 'Pharmacien') {
        }

        return compact('id', 'nom', 'prenom');
    }

    public static function isAdmin()
    {
        if (Auth::user()->role == "Pharmacien")
            return true;
        else
            return false;
    }

    public function loginPatient(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $hasPatientProfile = Pharmacien::where('user_id', Auth::user()->id);
            if (Auth::user()->role == 'Patient') {
                return redirect()->route('patient.profile');
            } else if (Auth::user()->role == 'Pharmacien' && $hasPatientProfile) {
                return redirect()->route('patient.profile');
            } else {
                auth()->logout();
                return back()->withErrors([
                    'email' => 'Accès non autorisé.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne sont pas valides.',
        ]);
    }



    public function loginPharm(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            if (Auth::user()->role == 'Pharmacien') {
                return redirect()->route('pharm.dashboard');
            } else {
                auth()->logout();
                return back()->withErrors([
                    'email' => 'Accès non autorisé.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne sont pas valides.',
        ]);
    }


    public function signup(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'date_de_naissance' => 'required|date',
            'adresse' => 'required',
            'telephone' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'Patient',
        ]);

        $patient = Patient::create([
            'user_id' => $user->id,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_de_naissance' => $request->date_de_naissance,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
        ]);

        Auth::login($user);

        return redirect()->route('patient.profile');
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}