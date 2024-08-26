<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use App\Http\Requests\CommentaireRequest;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commentaires = Commentaire::All();
        return view('pages.commentaire.index', ['commentaires' => $commentaires]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.commentaire.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentaireRequest $request)
    {
       Commentaire::create($request->validated());
        return to_route('commentaire.index')->with('succes', "Commentaire posté avec succès !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentaire $commentaire)
    {
        //
    }
}
