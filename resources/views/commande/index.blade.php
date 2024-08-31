<h1>Formulaire de Commande</h1>

<!-- Début du formulaire -->
<form action="/validerCommande" method="POST">
    @csrf <!-- Ajoute le token CSRF pour la sécurité -->

    <!-- Champ pour le nom -->
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
    @error('nom')
    <p style="color: red;">{{ $message }}</p>
    @enderror
    <br>

    <!-- Champ pour le prénom -->
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
    @error('prenom')
    <p style="color: red;">{{ $message }}</p>
    @enderror
    <br>

    <!-- Champ pour le téléphone -->
    <label for="telephone">Téléphone :</label>
    <input type="text" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
    @error('telephone')
    <p style="color: red;">{{ $message }}</p>
    @enderror
    <br>

    <!-- Champ pour l'adresse -->
    <label for="adresse">Adresse :</label>
    <input type="text" id="adresse" name="adresse" value="{{ old('adresse') }}" required>
    @error('adresse')
    <p style="color: red;">{{ $message }}</p>
    @enderror
    <br>

    <!-- Bouton de soumission -->
    <button type="submit">Envoyer</button>
</form>
