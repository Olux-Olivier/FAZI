<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BienController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentaireController;

Route::get('/', function () {
    return view('accueil');
})->name('index');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::post('/auth',[AuthController::class,'auth']);

Route::get('/signup',[AuthController::class,'signup'])->name('signup');
Route::post('/register',[AuthController::class,'register'])->name('register');

Route::get('/contract',[\App\Http\Controllers\AbonnementController::class, 'contract'])->name('contract');
Route::get('/abonnement', [\App\Http\Controllers\AbonnementController::class,'index'])->name('abonnement');
Route::post('/abonnement', [\App\Http\Controllers\AbonnementController::class,'store']);

Route::resource('bien', BienController::class);
Route::get('/anauthorize',[BienController::class,'anauthorized'])->name('anauthorize');
Route::resource('commentaire', CommentaireController::class)->names([
    'index' => 'commentaire.index',
    'create' => 'commentaire.create',
    'edit' => 'commentaire.edit',
    'update' => 'commentaire.update'
]);
