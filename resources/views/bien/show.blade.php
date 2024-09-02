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
<div class="header">
    <img src="../img/haerderImg.jpeg">
    <div class="div-title-links">
        <h3>FA<span>ZI</span></h3>
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <form action="" method="get">
                        <select name="commune">
                            <option value="">Choisir une commune</option>
                            <option >Annexe</option>
                            <option >Lubumbashi</option>
                            <option >Katuba</option>
                            <option >Kenya</option>
                            <option >Kamalondo</option>
                            <option >Rwashi</option>
                            <option >Kampemba</option>
                        </select>
                        <input type="number" name="prix" placeholder="prix">
                        <input type="submit" value="Rechercher">
                    </form>
                    <a
                        href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>

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
                <a href="{{route('abonnement')}}">S'abonner</a><a href="{{url('bien')}}">Bien</a>
                <a href="{{route('commentaire.index')}}">Consulter les commentaires</a>
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
    <div class="div-details">
        <div class="cards">
            <div class="card">
                <img src="{{asset('storage/'.$imagePrincipale)}}" height="200px" width="200px" alt="" >
            </div>
        </div>
        @auth
            <div class="action">
                <form action="/commande" method="post">
                    @csrf
                    <input type="hidden" name="bien_id" value="{{$bien->id}}">
                    <input type="hidden" name="type_bien" value="{{$bien->type_bien}}">
                    <button type="submit">
                        @if($bien->type_bien === 'location')
                            Activer la location
                        @else
                            Passer une commande
                        @endif
                    </button>
                </form>
                <!-- Bouton pour afficher les détails -->
                <button id="toggleDetailsBtn">Voir le détail</button>
                <!-- Informations supplémentaires masquées par défaut -->
                <div id="details" class="details" style="display: none;">
                    Description : {{$bien->description}}
                    <br>
                    Chambre : {{$bien->chambre}}
                    <br>
                    Commune : {{$bien->commune}}
                    <br>
                    Loyer : {{$bien->loyer}}
                    <br>
                    Prix de vente : {{$bien->prix_vente}}
                    <br>
                    Surface : {{$bien->surface}} m2
                    <br>
                    Autres images
                    <br>
                    @foreach($ToutesImages as $image)
                        <img src="{{asset('storage/'.$image)}}" height="70" width="70" alt="">
                    @endforeach
                </div>
            </div>
        @endauth
    </div>
    <div class="div-bien bienvente">
        <h1>Autres Maisons</h1>
        <div class="cards">

            @forelse($OthersWithImages as $other)
                <div class="card">
                    <a href="{{route('bien.show', $other['id'])}}">
                        <img src="{{asset('storage/'.$other['imagePrincipale'])}}" height="200px" width="200px" alt="" >
                    </a>
                </div>
            @empty
                Aucune suggestion pour cette categorie
            @endforelse
        </div>
        <form action="{{route('bien.vente')}}" method="get">
            <input type="hidden" name="type_bien" value="location">
            <input type="submit" value="Voir plus">
        </form>
    </div>
    <a href="{{ url('/commentaire/create') }}">Laisser un commentaire</a>
    @guest
        Veuillez vous <a href="{{route('login')}}">connecter</a> Pour passer une commande
    @endguest

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
</body>
</html>



<div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toggleDetailsBtn = document.getElementById('toggleDetailsBtn');
        var detailsDiv = document.getElementById('details');

        toggleDetailsBtn.onclick = function () {
            if (detailsDiv.style.display === "none") {
                detailsDiv.style.display = "block";
                toggleDetailsBtn.textContent = "Masquer les détails";
            } else {
                detailsDiv.style.display = "none";
                toggleDetailsBtn.textContent = "Voir le détail";
            }
        }
    });
</script>
