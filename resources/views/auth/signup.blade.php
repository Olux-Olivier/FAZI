<head>
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
<form action="/register" method="post">
    @csrf
    @error('nom')
    {{$message}}
    @enderror
    <input type="text" name="nom" placeholder="nom">
    <br>
    @error('nom')
    {{$message}}
    @enderror
    <input type="text" name="prenom" placeholder="prenom">
    <br>
    @error('prenom')
    {{$message}}
    @enderror
    <select name="categorie" id="">
        <option value="">Choisir une categorie</option>
        <option value="1">Client</option>
        <option value="2">Proprietaire</option>
    </select>

    <br>
    @error('telephone')
    {{$message}}
    @enderror
    <input type="text" name="telephone" placeholder="phone">
    <br>
    @error('adresse')
    {{$message}}
    @enderror
    <input type="text" name="adresse" placeholder="adresse">
    <br>
    @error('email')
    {{$message}}
    @enderror
    <input type="email" name="email" placeholder="email">
    <br>
    @error('password')
    {{$message}}
    @enderror
    <input type="password" name="password" placeholder="password">

    <input type="submit" value="S'enregistrer">
</form>
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
