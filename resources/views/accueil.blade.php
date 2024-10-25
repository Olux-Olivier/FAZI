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
    </style>
</head>
<body>
<div class="header">
    <img src="img/haerderImg.jpeg">
    <div class="div-title-links">
        <h3>FA<span>ZI</span></h3>
        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                
                @auth
                    <div>
                        <a href="/" style="color: white;background-color: #007bff;font-weight: bold;border: 2px solid #0056b3;padding:5px">Acceuil</a>
                        @if(\Illuminate\Support\Facades\Auth::user()->categorie == 2)
                        <a
                            href="{{ route('mes-biens') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </a>
                        @else
                            <a
                                href="{{ route('index') }}"
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
                    <div>
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
                <a href="{{route('commentaire.index')}}">Consulter les commentaires</a>
                
                </div>
                
            </nav>
            
        @endif
        <div>
                <form action="" method="get" class="form-inline">
                    <select name="commune" class="select-inline">
                        <option value="">Choisir une commune</option>
                        <option value="annexe" {{ old('commune', $input) == 'annexe' ? 'selected' : '' }}>Annexe</option>
                        <option value="lubumbashi" {{ old('commune', $input) == 'lubumbashi' ? 'selected' : '' }}>Lubumbashi</option>
                        <option value="katuba" {{ old('commune', $input) == 'katuba' ? 'selected' : '' }}>Katuba</option>
                        <option value="kenya" {{ old('commune', $input) == 'kenya' ? 'selected' : '' }}>Kenya</option>
                        <option value="kamalondo" {{ old('commune', $input) == 'kamalondo' ? 'selected' : '' }}>Kamalondo</option>
                        <option value="rwashi" {{ old('commune', $input) == 'rwashi' ? 'selected' : '' }}>Rwashi</option>
                        <option value="kampemba" {{ old('commune', $input) == 'kampemba' ? 'selected' : '' }}>Kampemba</option>
                    </select>
                    <input type="submit" value="Rechercher" class="button-inline">
                </form>
            </div>
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
    <div class="div-bien bienlouer">
        <h1>Bien à Louer</h1>
        <div class="cards">
            @forelse($ImagesBienLocations as $ImageBien)
                <div class="card">
                    <a href="{{route('bien.show', $ImageBien['id'])}}">
                        <img src="{{asset('storage/'.$ImageBien['imagePrincipale'])}}" height="200px" width="200px" alt="" >
                    </a>
                </div>

            @empty
                Aucune suggestion pour cette categorie
            @endforelse
        </div>
        <form action="{{route('bien.location')}}" method="get">
            <input type="hidden" name="type_bien" value="vente">
            <input type="submit" value="Voir plus">
        </form>
    </div>
    <div class="div-bien bienvente">
        <h1>Bien a Vendre</h1>
        <div class="cards">
            @forelse($ImagesBienVentes as $ImageBien)
                <div class="card">
                    <a href="{{route('bien.show', $ImageBien['id'])}}">
                        <img src="{{asset('storage/'.$ImageBien['imagePrincipale'])}}" height="200px" width="200px" alt="" >
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
        <a href="{{ url('/commentaire/create') }}" class="btn-custom">Laisser un commentaire</a>
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

