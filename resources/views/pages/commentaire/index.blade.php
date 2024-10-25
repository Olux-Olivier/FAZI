<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/home.css">
    <title>FAZI | Accueil</title>
    <style>
            .btn-custom {
                margin-top:20px;
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff; /* Couleur de fond */
                color: white; /* Couleur du texte */
                font-size: 16px;
                font-weight: bold;
                text-decoration: none; /* Supprime la sous-ligne */
                border-radius: 5px; /* Coins arrondis */
                transition: background-color 0.3s, transform 0.3s; /* Transition pour effet */
            }

            .btn-custom:hover {
                background-color: #0056b3; /* Changement de couleur au survol */
                transform: scale(1.05); /* Légère agrandissement au survol */
            }
            .container {
    margin-top: 20px; /* Espace au-dessus de la section des commentaires */
}

.d-com {
    border-bottom: 1px solid #e9ecef; /* Ligne séparatrice entre les commentaires */
    padding: 15px 0; /* Espace au-dessus et au-dessous de chaque commentaire */
    display: flex; /* Utilise flexbox pour aligner le contenu */
    justify-content: space-between; /* Espace entre les éléments */
    align-items: center; /* Aligne les éléments verticalement */
}

.d-com em {
    font-size: 1.1rem; /* Taille de police pour le commentaire */
    color: #495057; /* Couleur légèrement plus claire pour le commentaire */
    display: block; /* Pour que les guillemets et le commentaire soient sur une nouvelle ligne */
    margin-top: 5px; /* Espace au-dessus du commentaire */
    flex-grow: 1; /* Permet au commentaire de prendre tout l'espace disponible */
}

button[type="submit"] {
    padding: 0.5em 1em; /* Espace interne pour les boutons */
    border: none; /* Supprime la bordure par défaut */
    border-radius: 5px; /* Coins arrondis */
    cursor: pointer; /* Change le curseur au survol */
    background-color: red; /* Couleur rouge pour le bouton de suppression */
    color: white;
    margin-bottom:13px; /* Couleur du texte */
    margin-left: 5px; /* Espace à gauche du bouton de suppression */
}
.btn-edit{
    padding: 0.5em 1em;
    margin-left: 10px;
    text-decoration:none;
    border-radius:5px;
}

button[type="submit"]:hover, .btn-edit:hover {
    opacity: 0.8; /* Légère transparence au survol */
}

.btn-edit {
    background-color: #007bff; /* Couleur bleue pour le bouton de modification */
    margin-left: 5px; /* Espacement */
    color: white; /* Couleur du texte */
}

.btn-edit:hover {
    background-color: #0056b3; /* Couleur au survol pour le bouton de modification */
}

    </style>
</head>
<body>
<div class="header">
    <img src="img/haerderImg.jpeg">
    <div class="div-title-links">
        <h3>FA<span>ZI</span></h3>
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                    <a href="/">Acceuil</a>
                @auth
                    
                    <a
                        href="{{ url('/mes-biens') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>
                    <a
                        href="{{ route('logout') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Deconnexion
                    </a>
                    @if(Auth::user()->categorie == 1)
                    <a href="{{route('abonnement')}}">S'abonner</a>
                    @endif
                @else
                    <a
                        href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a
                            href="{{ route('signup') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Register
                        </a>
                    @endif
                @endauth
                <a href="{{route('commentaire.index')}}" style="color: white;background-color: #007bff;font-weight: bold;border: 2px solid #0056b3;padding:5px">Consulter les commentaires</a>
            </nav>
            <div></div>
        @endif
    </div>
    <div class="hero-bannere">
        <h3><span>Laissez nous</span>
            vous aider à trouvez
            la <span>maison de vos rêves</span>
        </h3>
    </div>
</div>

<div class="container">
    <div class="d-comment">
        <h2>Tous les commentaires</h2>
        <a href="{{ url('/commentaire/create') }}" class="btn-custom">Laisser un commentaire</a>
        @forelse($commentaires as $commentaire)
            <div class="d-com">
                <div class="d-info">
                    <h3>{{$commentaire['nom']}} {{$commentaire['prenom']}} - {{$commentaire['date']}}</h3>
                    <em><span>"</span>{{$commentaire['commentaire']}} <span>"</span></em>
                </div>
                @auth
                    @if(\Illuminate\Support\Facades\Auth::user()->id == $commentaire['user_id'])
                        <div class="d-actions">
                            <form action="{{route('commentaire.destroy', $commentaire['id_commentaire'])}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit">Supprimer</button>
                            </form>
                            <a href="{{route('commentaire.edit', $commentaire['id_commentaire'])}}" class="btn-edit">Modifier</a>
                        </div>
                    @endif
                @endauth
            </div>
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

