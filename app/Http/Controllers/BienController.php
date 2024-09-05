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
            $query = $query->where('commune',$request->input('commune'));
        }
        if($request->has('prix_vente_max') && $request->prix_vente_max != ''){

            $query = $query->where('prix_vente','>=',$request->input('prix_vente_max'));
        }

        if($request->has('prix_vente_min') && $request->prix_vente_min != ''){
            $query = $query->where('prix_vente','<=',$request->input('prix_vente_min'));
        }

        $BienLocations =   $query->where('type_bien','Location')
            ->take(3)
            ->orderBy('created_at','DESC')
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

        $BienVentes = $query->where('type_bien', 'Vente')
            ->orderBy('created_at','DESC')
            ->take(3)
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


        return view('accueil', [
            'ImagesBienVentes' => $ImagesBienVentes,
            'ImagesBienLocations'=>$ImagesBienLocations,
            'input' => $request->commune
        ]);
    }
    public function index()
    {

        if(Auth::user()->categorie == 2){

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
            ->take(3)
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
        return view('bien.bienLocation', [
            'ImagesBienLocations'=>$ImagesBienLocations,
            'input' => $request->commune
        ]);
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

        return view('bien.bienVente', ['ImagesBienVentes'=>$ImagesBienVentes, 'input' => $request->commune]);
    }
    public function anauthorized(){
        return view('bien.anauthorize');
    }

    public function destroy(Bien $bien)
    {
        $bien->delete();
        return to_route('mes-biens')->with('succes', 'Le bien a ete supprimer avec succes !');
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

        return redirect()->route('mes-biens');
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

    public function MesBiens()
    {
        if(Auth::user()->categorie == 2 || Auth::user()->categorie == 3){
            $Biens = Bien::where('user_id',Auth::user()->id)
                ->orderBy('created_at','DESC')
                ->get();

            $ImagesBiens = $Biens->map(function ($Bien) {
                $ImageBiens = Images::where('bien_id', $Bien->id)->first();
                $Images = $ImageBiens ? json_decode($ImageBiens->images) : [];
                $ImagePrincipale = $Images[0] ?? null;

                return [
                    'id' => $Bien->id,
                    'chambre' =>$Bien->chambre,
                    'imagePrincipale' => $ImagePrincipale,
                    'id_user' => $Bien->user_id,
                    'commune' => $Bien->commune,
                    'quartier' => $Bien->quartier,
                    'avenue' => $Bien->avenue,
                    'loyer' => $Bien->loyer,
                    'garantie' => $Bien->garantie,
                    'surface' => $Bien->surface,
                    'prix'=> $Bien->prix_vente,
                    'type_bien' => $Bien->type_bien,
                ];
            });

            return view('bien.mesbien',compact('ImagesBiens'));
        }
    }

    public function edit(Bien $bien)
    {

        $imagebiens = Images::where('bien_id', $bien->id)->first();

        // Récupération des images
        $ToutesImages = json_decode($imagebiens->images);
        $imagePrincipale = $ToutesImages[0]; // Première image (image principale)
        array_shift($ToutesImages); // Supprimer l'image principale du tableau

        return view('bien.index', compact('bien', 'imagePrincipale', 'ToutesImages'));
    }

    public function update(Bien $request, $id)
    {
        $bien = Bien::findOrFail($id);
        $imageBien = Images::where('bien_id', $bien->id)->first();

        $imagesPaths = json_decode($imageBien->images, true);

        if ($request->hasFile('image_principale')){
            /** @var UploadedFile $image_principale */

            $image_principale = $request->file('image_principale');
            $imagePathPrincipale = $image_principale->store('bien', 'public');
            if (isset($imagesPaths[0])){
                $imagesPaths[0] = $imagePathPrincipale;
            }else{
                array_unshift($imagesPaths, $imagePathPrincipale);
            }
        }

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                if ($image instanceof UploadedFile) {
                    $imagePath = $image->store('bien', 'public');
                    $imagesPaths[] = $imagePath;
                }
            }
        }
        $bien->update([
                'chambre' => $request->chambre,
                'commune' => $request->commune,
                'type_bien' => $request->type_bien,
                'quartier' => $request->quartier,
                'avenue' => $request->avenue,
                'description' => $request->description,
                'loyer' => $request->loyer,
                'garantie' => $request->garantie,
                'prix_vente' => $request->prix_vente,
                'surface' => $request->surface,
        ]);

        $imageBien->update([
            'images' => json_encode($imagesPaths),
        ]);

        dd('modifier avec succes');

    }


}
