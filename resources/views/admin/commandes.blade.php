<h1>Liste de commandes </h1>
<div class="container">
    <h1>Comptes des Propriétaires</h1>

    @foreach($commandes as $commande)
        <div>
            <h3>{{ $commande['prenom'] }} {{ $commande['nom'] }}</h3>
            <p>{{ $commande['adresse'] }}</p>
            <p>{{ $commande['telephone'] }}</p>
            <p>Type de commande: {{ $commande['typecommande'] }}</p>
            @if($commande['imagePrincipale'])
                <img src="{{ asset('storage/' . $commande['imagePrincipale']) }}" height="200" width="auto" alt="Image principale">
            @else
                <p>Aucune image disponible</p>
            @endif
        </div>
        <form action="{{route('commande.destroy', $commande['id'])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Retirer la commande</button>
        </form>
@endforeach

