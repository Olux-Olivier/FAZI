<h1>Liste de commandes </h1>
<div class="container">

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nom complet</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Type de commande</th>
            <th>Date</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($commandes as $commande)
            <tr>
                <td>{{ $commande['prenom'] }} {{ $commande['nom'] }}</td>
                <td>{{ $commande['adresse'] }}</td>
                <td>{{ $commande['telephone'] }}</td>
                <td>{{ $commande['typecommande'] }}</td>
                <td>{{ $commande['date'] }}</td>
                <td>
                    @if($commande['imagePrincipale'])
                        <a href="{{ route('bien.show', $commande['bien_id']) }}">
                            <img src="{{ asset('storage/' . $commande['imagePrincipale']) }}" height="100" width="auto" alt="Image principale">
                        </a>
                    @else
                        Aucune image disponible
                    @endif
                </td>
                <td>
                    <form action="{{ route('commande.destroy', $commande['id']) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Supprimer la commande</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


