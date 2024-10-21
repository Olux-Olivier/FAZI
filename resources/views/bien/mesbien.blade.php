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
                    <a href="{{route('adim-dashboard.compteClient')}}" class="active" >Dashboad</a>

                    <a href="{{ route('bien.index') }}" >Poster un bien</a>
                    <a href="{{ route('index') }}" >Retour à l'accueil</a>
                </div>
            </div>
            <div class="d-contents"> 
                <div class="d-accueil">
                    <div class="d-container-card">
    
                        <h3>Information dashboard </h3>
                        <div clas="list-card">
                        </div class='list-card'>
                            <div class='d-card'>
                                <div class="d-card-body">
                                    <h3>{{ $nbBienVente}}</h3>
                                    <span>Bien à vendre</span>
                                </div>
                            </div>
                            <div class='d-card'>
                                <div class="d-card-body">
                                    <h3>{{ $nbBienLocation}}</h3>
                                    <span>Bien à louer</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-card-option">
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
                                    <td>
                                        @if($Bien['type_bien'] == 'vente')
                                            --------
                                        @else
                                            {{ $Bien['loyer'] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($Bien['type_bien'] == 'vente')
                                            ---------
                                        @else
                                            {{ $Bien['garantie'] }}
                                        @endif
                                    </td>
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
                        </div>
                        </div>

                        </div>
                    </div>

                
            </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
