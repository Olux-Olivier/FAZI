<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Commande;
use App\Models\Images;
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

    public function commandes()
    {
        $commandes = Commande::with('bien')->get();

        // Associer l'image principale du bien à chaque commande
        $commandes = $commandes->map(function ($commande) {
            $bien = $commande->bien;
            $imagePrincipale = null;

            if ($bien) {
                $imageBiens = Images::where('bien_id', $bien->id)->first();
                $images = $imageBiens ? json_decode($imageBiens->images) : [];
                $imagePrincipale = $images[0] ?? null;
            }

            return [
                'id' => $commande->id,
                'nom' => $commande->nom,
                'prenom' => $commande->prenom,
                'telephone' => $commande->telephone,
                'adresse' => $commande->adresse,
                'typecommande' => $commande->typecommande,
                'user_id' => $commande->user_id,
                'bien_id' => $commande->bien_id,
                'imagePrincipale' => $imagePrincipale,
                'date'=>$commande->created_at,
            ];
        });

        return view('admin.commandes', compact('commandes'));
    }
    public function biens()
    {
        if(Auth::user()->categorie == 3){
            $Biens = Bien::orderBy('created_at','DESC')
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
        }
        return view('admin.biens', compact('ImagesBiens'));
    }

    public function admin_bien_destroy(Bien $bien)
    {
        $bien->delete();
        return to_route('admin-dashboard.commandes');
    }

    public function admin_bien_delete(Bien $bien)
    {
        $bien->delete();
        return to_route('admin-dashboard.biens');
    }
}
