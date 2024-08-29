<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
    public function auth(LoginRequest $request)
    {

        $credentials = $request->validated();
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('index'));
        }
        return to_route('login')->withErrors([
            'email' => 'Utilisateur non trouvé'
        ])->onlyInput('email');
    }
    public function signup()
    {
        return view('auth.signup');
    }
    public function register(SignUpRequest $request)
    {
        User::create([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'categorie' => $request->get('categorie'),
            'adresse' => $request->get('adresse'),
            'telephone' => $request->get('telephone'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            $this->sendmail($request->get('email'), $request->get('nom'));
            return redirect()->intended(route('index'));
        }

        return redirect()->back()->withErrors(['auth' => 'Les informations de connexion sont incorrectes.']);
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
            $mail->Subject = 'Confirmation ';
            $mail->Body    = 'Votre Compter a ete cree avec succes';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}
