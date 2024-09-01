
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
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            text-align: center;
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
    </style>
</head>

<body>

<div id="myModal" class="modal" style="display: none;">
    <div class="modal-content">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        <br>
        <br>
        <p>Voulez-vous continuer ?</p>
        <button id="acceptBtn">Accepter</button>
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
                <h1 class="text-center">SDK LARAVEL</h1>
            </div>
            <div class="col-md-4">
                <form method="POST" action="">
                    @csrf
                    <div class="col-md-12">
                        <div class="mt-3">
                            <label for="exampleInputMontant" class="form-label">Montant:</label>
                            <input type="number" class="form-control" id="exampleInputMontant" name="amount" value="100" aria-describedby="emailHelp">
                        </div>
                        <div class="mt-3">
                            <label for="exampleInputMontant" class="form-label">Numero</label>
                            <input type="tel" class="form-control" id="exampleInputMontant" name="numero" value="" aria-describedby="emailHelp">
                        </div>
                        <div class="mt-3">

                            <label for="exampleInputDevise" class="form-label">Devise:</label>
                            <select class="form-select" name="currency" aria-label="Default select example">
                                <option selected value="CDF">CDF</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <button type="submit" class="btn btn-success">Effectuer le payer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
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
</html>
