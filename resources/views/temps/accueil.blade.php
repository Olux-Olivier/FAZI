<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/home.css">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <img src="img/haerderImg.jpeg">
        <div class="div-title-links">
            <h3>FA<span>ZI</span></h3>
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <form action="" method="get">
                            <select name="commune">
                                <option value="">Choisir une commune</option>
                                <option value="annexe" {{ old('commune', $input) == 'annexe' ? 'selected' : '' }}>Annexe</option>
                                <option value="lubumbashi" {{ old('commune', $input) == 'lubumbashi' ? 'selected' : '' }}>Lubumbashi</option>
                                <option value="katuba" {{ old('commune', $input) == 'katuba' ? 'selected' : '' }}>Katuba</option>
                                <option value="kenya" {{ old('commune', $input) == 'kenya' ? 'selected' : '' }}>Kenya</option>
                                <option value="kamalondo" {{ old('commune', $input) == 'kamalondo' ? 'selected' : '' }}>Kamalondo</option>
                                <option value="rwashi" {{ old('commune', $input) == 'rwashi' ? 'selected' : '' }}>Rwashi</option>
                                <option value="kampemba" {{ old('commune', $input) == 'kampemba' ? 'selected' : '' }}>Kampemba</option>
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
    @php if(\Illuminate\Support\Facades\Auth::user()->categorie == 3){@endphp

<<<<<<< HEAD
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
        </div>
        <a href="{{ url('/commentaire/create') }}">Laisser un commentaire</a>
=======
    <form action="{{route('bien.destroy', $ImageBien['id'])}}" method="post">
        @csrf
        @method('delete')
        <button type="submit">Retirer le client</button>
    </form>

    @php }@endphp
@empty
    Aucune suggestion pour cette categorie
@endforelse
<form action="{{route('bien.location')}}" method="get">
    <input type="hidden" name="type_bien" value="vente">
    <input type="submit" value="Voir plus">
</form>
<hr>
<h1>Bien a Vendre</h1>
@forelse($ImagesBienVentes as $ImageBien)
    <div>
        <a href="{{route('bien.show', $ImageBien['id'])}}">
            <img src="{{asset('storage/'.$ImageBien['imagePrincipale'])}}" height="200px" width="200px" alt="" >
        </a>
>>>>>>> 54daadb419b08320b404c9104ca0e6e056b772b1
    </div>
    @auth
        @php if(\Illuminate\Support\Facades\Auth::user()->categorie == 3){@endphp

<<<<<<< HEAD
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
=======
            <form action="{{route('bien.destroy', $ImageBien['id'])}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Retirer le client</button>
            </form>

        @php }@endphp
    @endauth
@empty
    Aucune suggestion pour cette categorie
@endforelse
<form action="{{route('bien.vente')}}" method="get">
    <input type="hidden" name="type_bien" value="location">
    <input type="submit" value="Voir plus">
</form>


<a href="{{ url('/commentaire/create') }}">Laisser un commentaire</a>
>>>>>>> 54daadb419b08320b404c9104ca0e6e056b772b1
