<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SDK-LARAVEL</title>
    <style>
        .modal {
    display: flex;
    justify-content: center; /* Centre horizontalement */
    align-items: center; /* Centre verticalement */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4); /* Fond transparent noir */
}

.modal-content {
    padding: 20px;
    background-color: white; /* Couleur de fond du contenu */
    border: 1px solid #888;
    border-radius: 10px; /* Coins arrondis */
    max-width: 600px; /* Largeur maximale pour le contenu */
    width: 900%; /* S'assure que le contenu prend la largeur disponible jusqu'à max-width */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ombre pour l'effet visuel */
    margin: 0 auto; /* Centre horizontalement le contenu */
}

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    button {
    padding: 10px 20px; /* Ajoute de l'espace à l'intérieur du bouton */
    border: none; /* Supprime la bordure par défaut */
    border-radius: 5px; /* Coins arrondis */
    font-size: 16px; /* Taille de la police */
    cursor: pointer; /* Change le curseur au survol */
    transition: background-color 0.3s, color 0.3s; /* Animation lors du survol */
}

#acceptBtn {
    background-color: #5DBEFF; /* Couleur de fond du bouton Accepter */
    color: white; /* Couleur du texte */
}

#declineBtn {
    background-color: #f44336; /* Couleur de fond du bouton Refuser */
    color: white; /* Couleur du texte */
     /* Espace entre les deux boutons */
}

button:hover {
    opacity: 0.9; /* Légère transparence lors du survol */
}
    </style>
</head>

<body>

<div id="myModal" class="modal" style="display: none;">
    <div class="modal-content">
        <strong>Contrat d'Abonnement</strong>

        <p>Il a été convenu et arrêté ce qui suit :</p>

        <p><i><strong>Article 1 : Abonnement</strong></i></p>
        <p>Pour pouvoir publier un bien immobilier sur la plateforme, Le Propriétaire doit souscrire à un abonnement semestriel d'un montant de 5000 Francs Congolais (FC).</p>

        <p><i><strong>Article 2 : Frais de Commission</strong></i></p>
        <p>
            1. En cas de vente réussie de son bien immobilier par l'intermédiaire de la plateforme :
            <ul>
                <li>Le Propriétaire s'engage à payer une commission de 10% du prix de vente à L'intermédiaire.</li>
                <li>L'Acheteur du bien s'engage à payer une commission de 5% du prix de vente à L'intermédiaire.</li>
            </ul>
        </p>
        <p>2. Ces commissions ne seront exigibles que dans le cas où les négociations entre Le Propriétaire et l'Acheteur sont conclues de manière positive, et qu'une vente effective est réalisée.</p>

        <i><strong>Article 5 : Conformité Légale</strong></i>
        <p>Le présent contrat est rédigé et exécuté en conformité avec les dispositions de l'arrêté du 10 août 2017, qui encadre les transactions immobilières et les obligations des parties dans le cadre de l'intermédiation immobilière.</p>

        <i><strong>Article 4 : Acceptation des Conditions</strong></i>
        <p>En souscrivant à l'abonnement et en utilisant la plateforme pour publier un bien immobilier, Le Propriétaire accepte expressément les termes et conditions du présent contrat.</p>

        <p>Voulez-vous continuer ?</p>
        <button id="acceptBtn">Accepter</button>
        <br>
        <button id="declineBtn">Refuser</button>
    </div>
</div>

<div class="pt-5">
    <div class="container">
        <div class="row justify-content-center">
            @if(session()->has('info'))
                <div class="alert alert-primary text-center" role="alert">
                    {{session('info')}}
                </div>
            @endif
            <div class="col-md-9 text-center p-2">
                <h1 class="text-center">Fazi Abonnement</h1>
            </div>
            <div class="col-md-4">
                <form method="POST" action="">
                    @csrf
                    <div class="col-md-12">
                        <div class="mt-3">
                            <label for="exampleInputMontant" class="form-label">Montant:</label>
                            <input type="number" class="form-control" id="exampleInputMontant" readonly name="amount" value="5000" aria-describedby="emailHelp">
                        </div>
                        <div class="mt-3">
                            <label for="exampleInputMontant" class="form-label">Numéro</label>
                            <input type="tel" class="form-control" id="exampleInputMontant" name="numero" value="" aria-describedby="emailHelp" pattern="^\d{10}$" required>
                            <small class="text-muted">Entrez un numéro de téléphone valide à 10 chiffres.</small>
                        </div>
                        <div class="mt-3">
                            <label for="exampleInputMontant" class="form-label">Montant:</label>
                            <input type="text" class="form-control" id="exampleInputMontant" readonly name="amount" value="CDF" aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="btn" style="background-color:#5DBEFF; color:white">Effectuer le payemen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = document.getElementById("myModal");
        var acceptBtn = document.getElementById("acceptBtn");
        var declineBtn = document.getElementById("declineBtn");
        var span = document.getElementsByClassName("close")[0];

        // Afficher le modal lorsque la page se charge
        modal.style.display = "block";

        // Fermer le modal lorsque l'utilisateur clique sur "Accepter"
        acceptBtn.onclick = function () {
            modal.style.display = "none";
        }

        // Rediriger vers la page précédente lorsque l'utilisateur clique sur "Refuser"
        declineBtn.onclick = function () {
            window.history.back();
        }

        // Fermer le modal lorsque l'utilisateur clique sur "X"
        span.onclick = function () {
            modal.style.display = "none";
        }

        // Fermer le modal lorsque l'utilisateur clique en dehors du modal
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>

</body>
</html>
