<?php

namespace App\Http\Controllers;

use App\Http\Requests\BienRequest;
use App\Models\Abonnement;
use App\Models\Bien;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class BienController extends Controller
{
    public function index()
    {
        if(Auth::user()->categorie == 2){

            $user = Abonnement::where('user_id', Auth::user()->id)->get();
            if($user->isEmpty()){
                return to_route('contract');
            }
            return view('bien.index');
        }
        return to_route('anauthorize');
    }
    public function anauthorized(){
        return view('bien.anauthorize');
    }

    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BienRequest $request)
    {

        /** @var UploadedFile $image_principale */

        $image_principale = $request->file('image_principale');
        $ImagePathPrincipale = $image_principale->store('bien', 'public');

        $imagesPaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                if ($image instanceof UploadedFile) {
                    $imagePath = $image->store('bien', 'public');
                    $imagesPaths[] = $imagePath;
                }
            }
        }

        if ($ImagePathPrincipale) {
            array_unshift($imagesPaths, $ImagePathPrincipale);
        }


        $bien = Bien::create([
            'chambre' => $request->chambre,
            'commune' => $request->commune,
            'type_bien'=> $request->type_bien,
            'quartier' => $request->quartier,
            'avenue' => $request->avenue,
            'description'=>$request->description,
            'loyer'=>$request->loyer,
            'garantie'=>$request->garantie,
            'prix_vente'=>$request->prix_vente,
            'surface' => $request->surface,
            'user_id'=>$request->user()->id,
        ]);

        Images::create([
            'images' => json_encode($imagesPaths),
            'bien_id'=> $bien->id,
        ]);
    }
    public function show(string $id)
    {
        $bien = Bien::find($id);
        $imagebiens = Images::find($id);
        $ToutesImages = json_decode($imagebiens->images);
        $imagePrincipale = $ToutesImages[0];
        array_shift($ToutesImages);

        $Others = Bien::where('type_bien',$bien->type_bien)
            ->where('id','!=',$bien->id)
            ->take(5)
            ->get();

        $OthersWithImages = $Others->map(function ($otherBien) {
            $otherImageBiens = Images::where('bien_id', $otherBien->id)->first();
            $otherImages = $otherImageBiens ? json_decode($otherImageBiens->images) : [];
            $otherImagePrincipale = $otherImages[0] ?? null;

            return [
                'id' => $otherBien->id, // Si vous souhaitez afficher le titre également
                'imagePrincipale' => $otherImagePrincipale,
            ];
        });

            return view('bien.show', compact('bien', 'imagePrincipale', 'ToutesImages', 'OthersWithImages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bien $bien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bien $bien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bien $bien)
    {
        //
    }
}
