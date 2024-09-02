<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/home.css">
    <title>Document</title>
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
    <div class="formStandard">
        <form action="/register" method="post" class="">
            <h1>Créer compte</h1>
            @csrf
            <div class="div-1">
                <div class="div">
                    @error('nom')
                    <p>{{$message}}</p>
                    @enderror
                    <input type="text" name="nom" placeholder="nom">
                </div>
                <div class="div">
                    @error('nom')
                    <p>{{$message}}</p>
                    @enderror
                    <input type="text" name="prenom" placeholder="prenom">
                </div>
            </div>

            <div class="div-1">
                <div class="div">
                    @error('prenom')
                    <p>{{$message}}</p>
                    @enderror
                    <select name="categorie" id="">
                        <option value="">Choisir une categorie</option>
                        <option value="1">Client</option>
                        <option value="2">Proprietaire</option>
                    </select>
                </div>
                <div class="div">
                    @error('telephone')
                    <p>{{$message}}</p>
                    @enderror
                    <input type="text" name="telephone" placeholder="phone">
                </div>
            </div>

            <div class="div-1">
                <div class="div">
                    @error('adresse')
                    <p>{{$message}}</p>
                    @enderror
                    <input type="text" name="adresse" placeholder="adresse">
                </div>
                <div class="div">
                    @error('email')
                    <p>{{$message}}</p>
                    @enderror
                    <input type="email" name="email" placeholder="email">
                </div>
            </div>

            @error('password')
            <p>{{$message}}</p>
            @enderror
            <input type="password" name="password" placeholder="password">

            <input type="submit" value="S'enregistrer">
        </form>
    </div>
</body>
</html>



