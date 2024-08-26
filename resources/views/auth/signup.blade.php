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
