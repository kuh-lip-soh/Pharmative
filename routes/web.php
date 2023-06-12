<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\PharmacienController;
use App\Http\Controllers\AchatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(NavController::class)->group(function () {

    Route::get('/', 'index')->name('/');
    Route::get('contact', 'contact')->name('contact');
    Route::get('/panier/count', 'getPanierCount')->name('panier.count');


});

Route::controller(ArticleController::class)->group(function () {

    Route::get('medicament', 'medicament')->name('medicament');
    Route::get('materiel', 'materiel')->name('materiel');
    Route::get('espacebebe', 'espacebebe')->name('espacebebe');

    Route::get('/article/{id}', 'article')->name('article');
    Route::post('/article/search', 'search')->name('article.search');

});

Route::controller(VenteController::class)->group(function () {

    Route::get('panier', 'showCart')->name('panier');
    Route::post('/panier/ajouter/{article}', 'addToCart')->name('ajouter.panier');
    Route::post('/panier/valider', 'validateCart')->name('valider.panier');
    Route::post('/panier/supprimer/{article}', 'deleteFromCart')->name('supprimer.panier');

    Route::get('/paiement/{paiement}', 'paiement')->name('paiement');
    Route::post('/validatePaiement/{id}', 'validatePaiement')->name('validatePaiement');
    Route::post('/validateLivraison/{id}', 'validateLivraison')->name('validateLivraison');


});

Route::group(['prefix' => 'patient'], function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('patient.login');
    Route::post('/login', [AuthController::class, 'loginPatient'])->name('patient.login.submit');
    Route::get('/signup', [AuthController::class, 'signupForm'])->name('patient.signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('patient.signup.submit');

    Route::get('/profile', [NavController::class, 'patientProfile'])->name('patient.profile');
    Route::get('/profile/{vente}/commande', [NavController::class, 'patientCommande'])->name('patient.profile.commande');
    Route::post('/profile/update', [PatientController::class, 'updateProfile'])->name('patient.profile.update');
});

Route::group(['prefix' => 'pharm'], function () {
    Route::get('/login', [AuthController::class, 'loginFormPharm'])->name('pharm.login');
    Route::post('/login', [AuthController::class, 'loginPharm'])->name('pharm.login.submit');

    Route::get('/dashboard', [NavController::class, 'dashboard'])->name('pharm.dashboard');

    Route::get('/patient', [NavController::class, 'patient'])->name('pharm.patient');
    Route::get('/patient/{patient}/edit', [PatientController::class, 'edit'])->name('pharm.patient.edit');
    Route::put('/patient/{patient}', [PatientController::class, 'update'])->name('pharm.patient.update');

    Route::get('/personnel', [NavController::class, 'personnel'])->name('pharm.personnel');
    Route::get('/personnel/{pharmacien}/edit', [PharmacienController::class, 'edit'])->name('pharm.personnel.edit');
    Route::put('/personnel/{pharmacien}', [PharmacienController::class, 'update'])->name('pharm.personnel.update');


    Route::get('/vente', [VenteController::class, 'index'])->name('pharm.vente');
    Route::get('/vente/historique', [VenteController::class, 'historique'])->name('pharm.vente.historique');
    Route::post('/vente/add', [VenteController::class, 'add'])->name('pharm.vente.add');
    Route::post('/vente/cancel', [VenteController::class, 'cancel'])->name('pharm.vente.cancel');
    Route::post('/vente/validate', [VenteController::class, 'validate'])->name('pharm.vente.validate');
    Route::delete('/vente/remove/{key}', [VenteController::class, 'remove'])->name('pharm.vente.remove');
    Route::get('/vente/{vente}/edit', [VenteController::class, 'edit'])->name('pharm.vente.edit');
    Route::put('/vente/{vente}', [VenteController::class, 'update'])->name('pharm.vente.update');
    Route::put('/vente/livraison/{livraison}', [VenteController::class, 'updateLivraison'])->name('pharm.vente.updateLivraison');
    Route::delete('/vente/{vente}', [VenteController::class, 'destroy'])->name('pharm.vente.destroy');
    Route::post('/vente/historique/searchPatient', [PatientController::class, 'search'])->name('pharm.vente.historique.searchPatient');
    Route::post('/vente/searchArticle', [ArticleController::class, 'search'])->name('pharm.vente.searchArticle');
    Route::post('/vente/searchPatient', [PatientController::class, 'search'])->name('pharm.vente.searchPatient');

    Route::get('/stock', [ArticleController::class, 'index'])->name('pharm.stock');
    Route::get('/stock/{article}', [ArticleController::class, 'show'])->name('pharm.stock.show');

    Route::get('/achat', [AchatController::class, 'index'])->name('pharm.achat');
    Route::post('/achat/create', [AchatController::class, 'create'])->name('pharm.achat.create');
    Route::get('/achat/{achat}/edit', [AchatController::class, 'edit'])->name('pharm.achat.edit');
    Route::post('/achat/{achat}/add', [AchatController::class, 'add'])->name('pharm.achat.add');
    Route::delete('/achat/{achat}/{article}', [AchatController::class, 'delete'])->name('pharm.achat.delete');
    Route::put('/achat/{achat}', [AchatController::class, 'update'])->name('pharm.achat.update');
    Route::delete('/achat/{achat}', [AchatController::class, 'destroy'])->name('pharm.achat.destroy');





});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/pharmaciens', [DataController::class, 'pharmList']);