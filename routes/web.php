<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BienController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentaireController;

Route::get('/essai', function(){
    return view('bien.bien');
});


Route::get('/', [BienController::class,'acceuil'])->name('index');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::get('logout',[AuthController::class,'logout'])->middleware(['auth'])->name('logout');
Route::post('/auth',[AuthController::class,'auth']);

Route::get('/signup',[AuthController::class,'signup'])->name('signup');
Route::post('/register',[AuthController::class,'register'])->name('register');

Route::get('/dashboard',[\App\Http\Controllers\AdminController::class,'index'])->middleware(['auth'])->name('dashboard');



Route::resource('bien', BienController::class);
Route::get('/bienLocation', [BienController::class,'bienLocation'])->name('bien.location');
Route::get('/bienVente', [BienController::class,'bienVente'])->name('bien.vente');
Route::get('/anauthorize',[BienController::class,'anauthorized'])->middleware(['auth'])->name('anauthorize');
Route::resource('commentaire', CommentaireController::class)->names([
    'index' => 'commentaire.index',
    'create' => 'commentaire.create',
    'edit' => 'commentaire.edit',
    'update' => 'commentaire.update'
]);

Route::middleware('auth')->group(function () {
    Route::get('commentaire/create', [CommentaireController::class, 'create'])->name('commentaire.create');
});

Route::get('/admin',function () {
    User::create([
        'nom' => 'John' ,
        'prenom' => 'Doe',
        'categorie' => 3,
        'adresse' => 'adresse de l\'administrateur',
        'telephone' => '0854721056',
        'email' => '20kw174@esisalama.org',
        'password' => Hash::make('12345678'),
    ]);
});

Route::get('/contract',[\App\Http\Controllers\AbonnementController::class, 'contract'])->name('contract');

Route::get('/abonnement', [\App\Http\Controllers\AbonnementController::class, 'index'])->middleware(['auth'])->name('abonnement');
Route::post('/abonnement', [\App\Http\Controllers\AbonnementController::class, 'Payment'])->middleware(['auth']);
Route::post('/abonnement-verify',[\App\Http\Controllers\AbonnementController::class, 'verify'])->middleware(['auth']);
Route::get('/save-abonnement/{numero}',[\App\Http\Controllers\AbonnementController::class, 'save_abonnement'])->middleware(['auth'])->name('save-abonnement');

Route::match(['get','post'],'/notify_url', [\App\Http\Controllers\AbonnementController::class, 'notify_url'])->name('notify_url');
Route::match(['get','post'],'/return_url', [\App\Http\Controllers\AbonnementController::class, 'return_url'])->name('return_url');

Route::post('/commande',[\App\Http\Controllers\CommandeController::class,'index'])->middleware(['auth']);
Route::post('/validerCommande',[\App\Http\Controllers\CommandeController::class,'store'])->middleware(['auth']);
Route::get('/commandeSucces',[\App\Http\Controllers\CommandeController::class, 'succes'])->middleware(['auth'])->name('commande.succes');
Route::delete('/commande/{commande}',[App\Http\Controllers\CommandeController::class,'destroy'])->middleware(['auth'])->name('commande.destroy');

Route::get('/mes-biens',[\App\Http\Controllers\BienController::class,'MesBiens'])->middleware(['auth'])->name('mes-biens');

Route::get('/admin-dashboard',[\App\Http\Controllers\AdminController::class,'index'])->middleware(['auth'])->name('admin-dashboard');
Route::get('/adim-dashboard/compteClient',[\App\Http\Controllers\AdminController::class,'compteClient'])->middleware(['auth'])->name('adim-dashboard.compteClient');
Route::get('/admin-dashboard/compteProprietaire',[\App\Http\Controllers\AdminController::class,'compteProprietaire'])->middleware(['auth'])->name('admin-dashboard.compteProprietaire');
Route::get('/admin-dashboard/commandes',[\App\Http\Controllers\AdminController::class,'commandes'])->middleware(['auth'])->name('admin-dashboard.commandes');
Route::get('/admin-dashboard/biens',[\App\Http\Controllers\AdminController::class,'biens'])->middleware(['auth'])->name('admin-dashboard.biens');
Route::delete('/admin-delete/{bien}',[\App\Http\Controllers\AdminController::class,'admin_bien_destroy'])->middleware(['auth'])->name('admin-delete');
Route::delete('/admin-delete-bien/{bien}',[\App\Http\Controllers\AdminController::class,'admin_bien_delete'])->middleware(['auth'])->name('admin-delete-bien');
