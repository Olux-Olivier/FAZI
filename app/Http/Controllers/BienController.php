<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\User;
use App\Models\Images;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\BienRequest;
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;
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

        $BienVentes = $query->clone()->where('type_bien', 'Vente')
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
        $mailAdmin = User::where('categorie',3 )->get('email');
        $this->sendmail($mailAdmin, Auth::user()->nom, Auth::user()->prenom, $bien['type_bien']);

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
            
            $nbBienVente = Bien::where('user_id', Auth::user()->id)
                                ->where('type_bien', 'vente')->count();
            $nbBienLocation = Bien::where('user_id', Auth::user()->id)
                                ->where('type_bien','location')->count();

            

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

            return view('bien.mesbien',compact('ImagesBiens', 'nbBienLocation', 'nbBienVente'));
        }
    }

    public function edit(Bien $bien)
    {

    }

    public function sendmail($mailAdministrateur, $nomUtilisateur, $PrenomUtilisateur, $Type_bien){

        $mail = new PHPMailer();

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'fazilubumbashi@gmail.com';                     //SMTP username
            $mail->Password   = 'eouafnuyjkmtdfyd';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('fazilubumbashi@gmail.com', 'FAZI Lubumbashi');
            $mail->addAddress($mailAdministrateur);     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Commande';
            $mail->Body    = '
                <h1>Nouvelle commande reçue</h1>
                <p>Bonjour cher Administrateur,</p>
                <p>Un bien de '.$Type_bien .' a ete publie par :<strong><br></strong>'. $nomUtilisateur.' '. $PrenomUtilisateur .'</p>';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }


}
