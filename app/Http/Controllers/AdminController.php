<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        if (Auth::user()->categorie == 3) {
            return view('admin.dashboard');
        }

        return to_route('index');
    }

    public function compteClient()
    {
        $Users = User::where('categorie', 1)->get();
        return view('admin.compteClient', compact('Users'));
    }

    public function compteProprietaire()
    {
        $Users = User::where('categorie', 2)->get();
        return view('admin.compteProprietaire', compact('Users'));
    }



}
