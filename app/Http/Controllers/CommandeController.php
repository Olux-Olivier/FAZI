<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Session::put('bien_id', $request->bien_id);
        Session::put('type_bien', $request->type_bien);


        return view('commande.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bien_id = Session::get('bien_id');
        $bien_info = Bien::find($bien_id);
        $type_bien = Session::get('type_bien');
        Commande::create([
            'nom' => $request->nom,
            'prenom'=> $request->prenom,
            'telephone'=>$request->telephone,
            'typecommande' => $type_bien,
            'adresse' => $request->adresse,
            'user_id' => Auth::id(),
            'bien_id' => $bien_id,
        ]);
        $mailAdmin = User::where('categorie',3 )->get('email');
        $this->sendmail($mailAdmin[0]->email, $request->nom, $request->prenom, $request->Adresse, $request->telephone,
        $type_bien);


        return redirect()->route('commande.succes');
    }
    public function succes()
    {
        return view('commande.succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();
        return  to_route('admin-dashboard.commandes');
    }
    public function sendmail($mailAdministrateur, $nomUtilisateur, $PrenomUtilisateur, $Adresse, $Numero, $Type_bien){

        $mail = new PHPMailer();

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'olivierkasongo539@gmail.com';                     //SMTP username
            $mail->Password   = 'xyvtpkjayhvbuwbi';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('olivierkasongo539@gmail.com', 'Fazi');
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
                <p>Une nouvelle commande vient d\'être passée sur votre application. Voici les détails :</p>
                <ul>
                    <li><strong>Nom du client :</strong>'. $nomUtilisateur.' '. $PrenomUtilisateur .'</li>
                    <li><strong>Téléphone du client :</strong> '. $Numero .'</li>
                    <li><strong>Type du Bien :</strong> '. $Type_bien .'</li>
                <ul>
            ';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}
