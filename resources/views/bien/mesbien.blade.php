<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes biens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    
<a href="{{ route('bien.index') }}" class="btn btn-primary mb-3">Poster un bien</a>
<a href="{{ route('index') }}" class="btn btn-secondary mb-3">Retour à l'accueil</a>

<h4>Mes biens publiés</h4>
<table class="table table-bordered table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Image</th>
        <th scope="col">Chambres</th>
        <th scope="col">Commune</th>
        <th scope="col">Quartier</th>
        <th scope="col">Avenue</th>
        <th scope="col">Type</th>
        <th scope="col">Loyer</th>
        <th scope="col">Garantie</th>
        <th scope="col">Prix vente</th>
        <th scope="col">Surface</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($ImagesBiens as $Bien)
        <tr>
            <td>
                <a href="{{ route('bien.show', $Bien['id']) }}">
                    <img src="{{ asset('storage/'.$Bien['imagePrincipale']) }}" class="img-thumbnail" height="50px" width="50px" alt="Image de bien">
                </a>
            </td>
            <td>{{ $Bien['chambre'] }}</td>
            <td>{{ $Bien['commune'] }}</td>
            <td>{{ $Bien['quartier'] }}</td>
            <td>{{ $Bien['avenue'] }}</td>
            <td>{{ $Bien['type_bien'] }}</td>
            <td>{{ $Bien['loyer'] }}</td>
            <td>{{ $Bien['garantie'] }}</td>
            <td>{{ $Bien['prix'] }}</td>
            <td>{{ $Bien['surface'] }}</td>
            <td>
                @if(\Illuminate\Support\Facades\Auth::user()->id == $Bien['id_user'])
                    <form action="{{ route('bien.destroy', $Bien['id']) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">Retirer bien</button>
                    </form>
                    <a href="{{ route('bien.edit', $Bien['id']) }}" class="btn btn-warning btn-sm">Modifier bien</a>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="11" class="text-center">Vous n'avez aucun bien.</td>
        </tr>
    @endforelse
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>



