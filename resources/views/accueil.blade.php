



@if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        @auth
            <form action="" method="get">
                <select name="commune">
                    <option value="">Choisir une commune</option>
                    <option value="annexe">Annexe</option>
                    <option value="lubumbashi">Lubumbashi</option>
                    <option value="katuba">Katuba</option>
                    <option value="kenya">Kenya</option>
                    <option value="kamalondo">Kamalondo</option>
                    <option value="rwashi">Rwashi</option>
                    <option value="kampemba">Kampemba</option>
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
                    href="{{ route('register') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Register
                </a>
            @endif
        @endauth
    </nav>
@endif

<h1>Bien a vendre</h1>
@forelse($ImagesBienLocations as $ImageBien)
    <div>
        <a href="{{route('bien.show', $ImageBien['id'])}}">
            <img src="{{asset('storage/'.$ImageBien['imagePrincipale'])}}" height="200px" width="200px" alt="" >
        </a>
    </div>

@empty
    Aucune suggestion pour cette categorie
@endforelse
<form action="{{route('bien.vente')}}" method="get">
    <input type="hidden" name="type_bien" value="vente">
    <input type="submit" value="Voir plus">
</form>
<hr>
<h1>Bien a Louer</h1>
@forelse($ImagesBienVentes as $ImageBien)
    <div>
        <a href="{{route('bien.show', $ImageBien['id'])}}">
            <img src="{{asset('storage/'.$ImageBien['imagePrincipale'])}}" height="200px" width="200px" alt="" >
        </a>
    </div>

@empty
    Aucune suggestion pour cette categorie
@endforelse
<form action="{{route('bien.location')}}" method="get">
    <input type="hidden" name="type_bien" value="location">
    <input type="submit" value="Voir plus">
</form>


