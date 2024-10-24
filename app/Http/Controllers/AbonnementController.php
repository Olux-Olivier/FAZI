<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class AbonnementController extends Controller
{
    public function index()
    {

        return view('abonnement.index');
    }
    public function contract()
    {
        return view('abonnement.contract');
    }
    public function verify()
    {

    }
    public function Payment(Request $request)
    {
        $data = [
            'mer_id' => 'KewR5@W26yfZ&8=',  // Encodage des valeurs
            'password' => '4%=tZa9=AhH67Dw',
            'montant' => '100',
            'devise' => 'CDF',
            'reference' => '121956784',
            'reseau' => 'airtel',
            'numero' => $request->numero
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->asForm()->post('https://www.town-event.com/api/town_api.php', $data);
        $numero = $request['numero'];
        return view('abonnement.verify', compact('numero'));
    }

    public function save_abonnement($numero)
    {
        Abonnement::create([
            'numero' => $numero,
            'montant' => 5000,
            'user_id' => Auth::user()->id,
        ]);
        return to_route('mes-biens');
    }

    //configuration de l'api la notification


    //configuration de l'api de retour
    public function return_url (Request $request)
    {
        /* 1- recuperation des données postées par CinetPay
         * https://docs.cinetpay.com/api/1.0-fr/checkout/retour#les-etapes-pour-configurer-lurl-de-retour */
        if (isset($request->transaction_id) || isset($request->token))
        {
            /* 2- on vérifie l'état de la transaction sur CinetPay ou dans notre base de donnée
            * https://docs.cinetpay.com/api/1.0-fr/checkout/notification#2-verifier-letat-de-la-transaction */
            $cinetpay_check = [
                "apikey" => env("APIKEY"),
                "site_id" => env("SITE_ID"),
                "transaction_id" => $request->transaction_id
            ];
            // appel fonction de requête pour récupérer le statut chez CinetPay
            $response = $this->getPayStatus($cinetpay_check);
            //On recupère la réponse de CinetPay
            $response_body = json_decode($response,true);
            if($response_body['code'] == '00')
            {
                /* correct, on redirige le client vers la page souhaité */
                return back()->with('info', 'Felicitation, votre paiement a été effectué avec succès');
            }
            else
            {
                /* correct, on redirige le client vers la page souhaité */
                return back()->with('info', 'Echec, votre paiement a échoué');
            }
        }
        else{
            print("transaction non fourni");
        }
    }

    public function getPayStatus($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-checkout.cinetpay.com/v2/payment/check',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 45,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                "content-type:application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err)
            print ($err);
        else
            return ($response);
    }
    public function sendmail($mailUtilisateur, $nomUtilisateur){

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
            $mail->addAddress($mailUtilisateur, $nomUtilisateur);     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Confirmation  ';
            $mail->Body    = 'Votre Abonnement a ete effectue avec succes !';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}
