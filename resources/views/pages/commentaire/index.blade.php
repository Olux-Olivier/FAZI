<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/home.css">
    <title>FAZI | Accueil</title>
</head>
<body>
<div class="header">
    <img src="img/haerderImg.jpeg">
    <div class="div-title-links">
        <h3>FA<span>ZI</span></h3>
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">

            </nav>
        @endif
    </div>
    <div class="hero-bannere">
        <h3><span>Laissez nous</span>
            vous aider à trouvez
            la <span>maison de vos rêves</span>
        </h3>
        <button>Commencer</button>
    </div>
</div>

<div class="container">
    <div class="d-comment">
    <h2>Tous les commentaires</h2>

        @forelse($commentaires as $commentaire)
            <div class="d-com">
                <div class="d-info">
                    <h3>{{$commentaire['nom']}} {{$commentaire['prenom']}}  - <em>{{$commentaire['date']}}</em></h3>
                </div>
                <em><span>"</span>{{$commentaire['commentaire']}} <span>"</span></em>
            </div>
            @guest

            @endguest
            @auth

                @php  if(\Illuminate\Support\Facades\Auth::user()->id == $commentaire['user_id']){ @endphp
                <form action="{{route('commentaire.destroy', $commentaire['id_commentaire'])}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit">Supprimer</button>
                </form>

                <a href="{{route('commentaire.edit', $commentaire['id_commentaire'])}}">Modifier le commentaire</a>
                @php }@endphp
            @endauth
        @empty
            <p>Aucun commentaire disponible.</p>
        @endforelse
    </div>
</div>
<div class="footer">
    <div class="footerIcone">
        <h2>FA<span>ZI</span></h2>
    </div>
    <p>
        Fazi est une
        plateforme qui offre les services de
        location et la vente des maisons
    </p>
</div>

