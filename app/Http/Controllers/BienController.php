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
    public function acceuil(Request $request)
    {
        $query = Bien::query();

        if($request->has('commune')){
            $query->where('commune',$request->input('commune'));
        }
        $BienLocations =  $query->clone()->where('type_bien','Location')
            ->take(5)
            ->get();
        $ImagesBienLocations = $BienLocations->map(function ($Bien) {
            $ImageBiens = Images::where('bien_id', $Bien->id)->first();
            $Images = $ImageBiens ? json_decode($ImageBiens->images) : [];
            $ImagePrincipale = $Images[0] ?? null;

            return [
                'id' => $Bien->id,
                'imagePrincipale' => $ImagePrincipale,
            ];
        });

        $BienVentes = $query->clone()->where('type_bien', 'Vente')
            ->take(5)
            ->get();

        $ImagesBienVentes = $BienVentes->map(function ($Bien) {
            $ImageBiens = Images::where('bien_id', $Bien->id)->first();
            $Images = $ImageBiens ? json_decode($ImageBiens->images) : [];
            $ImagePrincipale = $Images[0] ?? null;

            return [
                'id' => $Bien->id,
                'imagePrincipale' => $ImagePrincipale,
            ];
        });


        return view('accueil', compact('ImagesBienVentes', 'ImagesBienLocations'));
    }
    public function index()
    {

        if(Auth::user()->categorie == 2){
            /*
            $user = Abonnement::where('user_id', Auth::user()->id)->get();
            if($user->isEmpty()){
                return to_route('contract');
            }*/
            return view('bien.index');
        }
        return to_route('anauthorize');
    }

    public function bienLocation(Request $request){
        $query = Bien::query();

        if($request->has('commune')){
            $query->where('commune',$request->input('commune'));
        }
        $BienLocations =  $query->clone()->where('type_bien','Location')
            ->take(5)
            ->get();
        $ImagesBienLocations = $BienLocations->map(function ($Bien) {
            $ImageBiens = Images::where('bien_id', $Bien->id)->first();
            $Images = $ImageBiens ? json_decode($ImageBiens->images) : [];
            $ImagePrincipale = $Images[0] ?? null;

            return [
                'id' => $Bien->id,
                'imagePrincipale' => $ImagePrincipale,
            ];
        });
        return view('bien.bienLocation', compact('ImagesBienLocations'));
    }
    public function bienVente(Request $request)
    {
        $query = Bien::query();

        if($request->has('commune')){
            $query->where('commune',$request->input('commune'));
        }

        $BienVentes = $query->clone()->where('type_bien', 'Vente')
            ->take(5)
            ->get();

        $ImagesBienVentes = $BienVentes->map(function ($Bien) {
            $ImageBiens = Images::where('bien_id', $Bien->id)->first();
            $Images = $ImageBiens ? json_decode($ImageBiens->images) : [];
            $ImagePrincipale = $Images[0] ?? null;

            return [
                'id' => $Bien->id,
                'imagePrincipale' => $ImagePrincipale,
            ];
        });

        return view('bien.bienVente', compact('ImagesBienVentes'));
    }
    public function anauthorized(){
        return view('bien.anauthorize');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(BienRequest $request)
    {
        $user = Abonnement::where('user_id', Auth::user()->id)->get();
        if($user->isEmpty()){
            return to_route('abonnement');
        }

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



}
