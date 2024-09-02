<h1>Liste de commandes </h1>
<div class="container">

    @foreach($commandes as $commande)
        <div>
            <h3>{{ $commande['prenom'] }} {{ $commande['nom'] }}</h3>
            <p>{{ $commande['adresse'] }}</p>
            <p>{{ $commande['telephone'] }}</p>
            <p>Type de commande: {{ $commande['typecommande'] }}</p>
            <p>Date : {{$commande['date']}}</p>
            @if($commande['imagePrincipale'])
                <a href="{{route('bien.show',$commande['bien_id'])}}">
                <img src="{{ asset('storage/' . $commande['imagePrincipale']) }}" height="200" width="auto" alt="Image principale">
                </a>
            @else
                <p>Aucune image disponible</p>
            @endif
        </div>
        <form action="{{route('commande.destroy', $commande['id'])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Supprimer la commande</button>
        </form>
@endforeach

