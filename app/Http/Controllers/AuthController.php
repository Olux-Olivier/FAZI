<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(LoginRequest $request)
    {

        $credentials = $request->validated();
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('index'));
        }
        return to_route('login')->withErrors([
            'email' => 'Utilisateur non trouvé'
        ])->onlyInput('email');
    }
    public function signup()
    {
        return view('auth.signup');
    }
    public function register(SignUpRequest $request)
    {
        User::create([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'categorie' => $request->get('categorie'),
            'adresse' => $request->get('adresse'),
            'telephone' => $request->get('telephone'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect()->route('login');
    }
}
