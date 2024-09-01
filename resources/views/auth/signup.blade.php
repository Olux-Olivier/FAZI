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

