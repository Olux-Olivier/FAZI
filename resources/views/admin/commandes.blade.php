<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAZI | Commandes clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

<h1 class="text-center my-4">Liste de commandes</h1>
<a href="{{route('admin-dashboard')}}">Retour</a>
<div class="container">

    <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
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
                <td>{{ ucfirst($commande['typecommande']) }}</td>
                <td>{{ \Carbon\Carbon::parse($commande['date'])->format('d/m/Y') }}</td>
                <td>
                    @if($commande['imagePrincipale'])
                        <a href="{{ route('bien.show', $commande['bien_id']) }}">
                            <img src="{{ asset('storage/' . $commande['imagePrincipale']) }}" height="100" width="auto" alt="Image principale" class="img-thumbnail">
                        </a>
                    @else
                        <span class="text-muted">Aucune image disponible</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('commande.destroy', $commande['id']) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>


