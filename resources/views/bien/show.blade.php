<div>
    <img src="{{asset('storage/'.$imagePrincipale)}}" height="200px" width="200px" alt="" >
    <br>
    @auth
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
    <div id="details" style="display: none;">
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
    @endauth
    @guest
        Veuillez vous <a href="{{route('login')}}">connecter</a> Pour passer une commande
    @endguest
    <div>
        <h3>Autres Maisons</h3>
        @forelse($OthersWithImages as $other)
            <div>
                <a href="{{route('bien.show', $other['id'])}}">
                    <img src="{{asset('storage/'.$other['imagePrincipale'])}}" height="200px" width="200px" alt="" >
                </a>
            </div>
        @empty
            Aucune suggestion pour cette categorie
        @endforelse
    </div>
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
