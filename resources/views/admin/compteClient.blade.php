<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAZI | Comptes clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

<a href="{{route('admin-dashboard')}}">Retour</a>
<h3>Comptes proprietaires </h3>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Adresse</th>
        <th>Date de création du compte</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @forelse($Users as $user)
        <tr>
            <td>{{ $user->prenom }}</td>
            <td>{{ $user->nom }}</td>
            <td>{{ $user->adresse }}</td>
            <td>{{ $user->created_at->format('d/m/Y') }}</td>
            <td>
                <form action="{{ route('bien.destroy', $user->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Supprimer le compte</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">Aucun client.</td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
</html>