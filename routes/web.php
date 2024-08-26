<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BienController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentaireController;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/auth',[AuthController::class,'auth']);

Route::get('/signup',[AuthController::class,'signup'])->name('signup');
Route::post('/register',[AuthController::class,'register'])->name('register');

Route::resource('bien', BienController::class);
Route::resource('commentaire', CommentaireController::class)->names([
    'index' => 'commentaire.index',
    'create' => 'commentaire.create',
    'edit' => 'commentaire.edit',
    'update' => 'commentaire.update'
]);
