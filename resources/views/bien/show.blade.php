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
                    @if(Auth::user()->id == 2)
                        <a
                            href="{{ url('/mes-biens') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </a>
                    @else
                    <a
                        href="{{ route('admin-dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Dashboard
                    </a>
                    @endif

                    <a
                        href="{{ route('logout') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Deconnexion
                    </a>
                    @if(Auth::user()->categorie == 2)
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
                <a style="color: white;background-color: #007bff;font-weight: bold;border: 2px solid #0056b3;padding:5px">Details</a>
                <a href="{{route('commentaire.index')}}">Consulter les commentaires</a>
            </nav>
            <div></div>
        @endif
    </div>
    <div class="hero-bannere">
        <h3><span>Laissez nous</span>
            vous aider à trouvez
            la <span>maison de vos rêves</span>
        </h3>
        <a href="{{ route('index') }}">Commencer</a>
    </div>
</div>

<div class="container">
    <div class="div-details">
        <div class="cards">
            <div class="card">
                <img src="{{asset('storage/'.$imagePrincipale)}}" height="200px" width="200px" alt="" >
            </div>
        </div>
        @guest
            <div style="padding-left:10%;font-size:20px">Pour voir les details du bien, <br> vous devez vous conneter ou creer un compte.</div>
        @endguest
        @auth

            <div class="action">
                @if (\Illuminate\Support\Facades\Auth::user()->categorie != 3)
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
                @else
                    <form action="{{route('admin-delete',$bien->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">Retire </button>
                    </form>

                @endif
                <!-- Bouton pour afficher les détails -->
                <button id="toggleDetailsBtn">Voir le détail</button>
                <!-- Informations supplémentaires masquées par défaut -->
                <div id="details" class="div-details" style="display: none; margin-left: 1em">
                    <span>Description : {{$bien->description}}</span>
                    <br>
                    <span>Chambre : {{$bien->chambre}}</span>
                    <br>
                    <span>Commune : {{$bien->commune}}</span>
                    <br>
                    <span>Loyer : {{$bien->loyer}}</span>
                    <br>
                    <span>Prix de vente : {{$bien->prix_vente}}</span>
                    <br>
                    <span>Surface : {{$bien->surface}} m2</span>
                    <br>
                    <h4>Autres images</h4>
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
