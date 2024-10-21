<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAZI | Biens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

<h3 class="text-center my-4">Tous les biens</h3>

<table class="table table-bordered table-hover table-striped">
    <thead class="thead-dark">
    <tr>
        <th>Image</th>
        <th>Chambres</th>
        <th>Commune</th>
        <th>Quartier</th>
        <th>Avenue</th>
        <th>Type</th>
        <th>Loyer</th>
        <th>Garantie</th>
        <th>Prix vente</th>
        <th>Surface</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($ImagesBiens as $Bien)
        <tr>
            <td>
                <a href="{{ route('bien.show', $Bien['id']) }}">
                    <img src="{{ asset('storage/'.$Bien['imagePrincipale']) }}" class="img-thumbnail" height="50" width="50" alt="Image de bien">
                </a>
            </td>
            <td>{{ $Bien['chambre'] }}</td>
            <td>{{ $Bien['commune'] }}</td>
            <td>{{ $Bien['quartier'] }}</td>
            <td>{{ $Bien['avenue'] }}</td>
            <td>{{ ucfirst($Bien['type_bien']) }}</td>
            <td>{{ number_format($Bien['loyer'], 0, ',', ' ') }} FC</td>
            <td>{{ number_format($Bien['garantie'], 0, ',', ' ') }} FC</td>
            <td>{{ number_format($Bien['prix'], 0, ',', ' ') }} FC</td>
            <td>{{ $Bien['surface'] }} m²</td>
            <td>
                <form action="{{ route('admin-delete-bien', $Bien['id']) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir retirer ce bien ?');">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">Retirer bien</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="11" class="text-center">Vous n'avez aucun bien.</td>
        </tr>
    @endforelse
    </tbody>
</table>
</body>
</html>
