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
                    <a href="{{route('adim-dashboard.compteClient')}}" > Voir les comptes clients</a>

                    <a href="{{route('admin-dashboard.compteProprietaire')}}" >Voir les comptes proprietaires</a>

                    <a href="{{route('admin-dashboard.commandes')}}" class="active">Voir toutes les commandes</a>

                    <a href="{{route('admin-dashboard.biens')}}">Voir tous les biens</a>

                    <a href="{{route('index')}}">Retourner a l'acceuil</a>
                </div>
            </div>
            <div class="d-contents"> 
                <h3 class="text-center my-4">Liste de commandes</h3>

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
                                        <img src="{{ asset('storage/' . $commande['imagePrincipale']) }}" height="100" width="auto" style="height:4em;widt:4em;" alt="Image principale" class="img-thumbnail">
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
                <a href="{{route('admin-dashboard')}}" class="btn btn-primary">Retour</a>
            </div>
            </div>
        </div>
    </div>

</body>
</html>
