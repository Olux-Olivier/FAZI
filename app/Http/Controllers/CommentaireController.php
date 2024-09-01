<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Images;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CommentaireRequest;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $All = Commentaire::All();
        $Commentaires = $All->map(function ($commentaire) {
            $user = User::where('id', $commentaire->user_id)->first();
            $relativeDate = Carbon::parse($commentaire->created_at)->diffForHumans();

            return ['nom'=>$user->nom, 'prenom'=>$user->prenom,'id_commentaire'=>$commentaire->id,'commentaire'=>$commentaire->message,'user_id'=>$commentaire->user_id, 'date'=>$relativeDate];
        });
        return view('pages.commentaire.index', ['commentaires' => $Commentaires]);
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
        if(Auth::user()->id == $commentaire->user_id){
            return view('pages.commentaire.edit', ['commentaire' => $commentaire]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentaireRequest $request, Commentaire $commentaire)
    {
        $commentaire->update($request->validated());
        return to_route('commentaire.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();
        return to_route('commentaire.index');
    }
}
