<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vérification d'abonnement</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-center">
<div class="container mt-5">
    <h2 class="text-warning">Votre abonnement est en cours de vérification</h2>
    <h3 class="text-danger">Ne quittez pas cette page sinon votre abonnement sera annulé</h3>
    <p class="mt-3">Redirection dans <span id="countdown">20</span> secondes...</p>
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<input type="hidden" id="hiddenNumero" value="{{$numero}}">

<!-- JavaScript -->
<script>
    // Fonction de redirection
    function redirectToRoute() {
        const hidden = document.getElementById("hiddenNumero").value;
        window.location.href = "/save-abonnement/" + hidden;
    }

    // Initialisation du compte à rebours
    let countdownTime = 20;
    const countdownElement = document.getElementById("countdown");

    const countdownInterval = setInterval(() => {
        countdownTime--;
        countdownElement.textContent = countdownTime;

        if (countdownTime <= 0) {
            clearInterval(countdownInterval);
            redirectToRoute(); // Rediriger une fois le compte à rebours terminé
        }
    }, 1000); // Met à jour chaque seconde

    // Redirection après 20 secondes
    setTimeout(redirectToRoute, 20000);
</script>

<!-- Bootstrap JS (Optionnel, pour des fonctionnalités interactives supplémentaires) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
