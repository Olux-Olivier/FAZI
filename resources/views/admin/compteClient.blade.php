<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Dashboard Admin</title>
</head>
<body>
    <div class='d-container'>
        <div class="dd-content">
        
            <div class="d-side">
                <h3>FA<span>ZI</span></h3>
                <div class="d-option">
                    <a href="{{route('admin-dashboard')}}">Dashboad</a>
                    <a href="{{route('adim-dashboard.compteClient')}}" class="active"> Voir les comptes clients</a>

                    <a href="{{route('admin-dashboard.compteProprietaire')}}">Voir les comptes proprietaires</a>

                    <a href="{{route('admin-dashboard.commandes')}}">Voir toutes les commandes</a>

                    <a href="{{route('admin-dashboard.biens')}}">Voir tous les biens</a>

                    <a href="{{route('index')}}">Retourner a l'acceuil</a>
                </div>
            </div>
            <div class="d-contents"> 
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
            </div>
            </div>
        </div>
    </div>

</body>
</html>
