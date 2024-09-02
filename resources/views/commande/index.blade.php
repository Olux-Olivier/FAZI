<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/home.css">
    <title>Document</title>
</head>
<body>
<!-- Début du formulaire -->
<div class="formStandard">
    <form action="/validerCommande" method="POST">
        <h1>Formulaire de Commande</h1>
        @csrf <!-- Ajoute le token CSRF pour la sécurité -->

        <!-- Champ pour le nom -->
        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Nom" required>
        @error('nom')
        <p style="color: red;">{{ $message }}</p>
        @enderror


        <!-- Champ pour le prénom -->
        <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" placeholder="Prenom"  required>
        @error('prenom')
        <p style="color: red;">{{ $message }}</p>
        @enderror


        <!-- Champ pour le téléphone -->
        <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" placeholder="Telephone"  required>
        @error('telephone')
        <p style="color: red;">{{ $message }}</p>
        @enderror


        <!-- Champ pour l'adresse -->
        <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" placeholder="Adresse"  required>
        @error('adresse')
        <p style="color: red;">{{ $message }}</p>
        @enderror


        <!-- Bouton de soumission -->
        <button type="submit">Envoyer</button>
    </form>
</div>
</body>
</html>

