<h3>Tous les biens</h3>

<table class="table table-bordered">
    <thead>
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
                    <img src="{{ asset('storage/'.$Bien['imagePrincipale']) }}" height="50px" width="50px" alt="Image de bien">
                </a>
            </td>
            <td>
                {{ $Bien['chambre'] }}
            </td>
            <td>
                {{$Bien['commune']}}
            </td>
            <td>
                {{ $Bien['quartier'] }}
            </td>
            <td>
                {{$Bien['avenue']}}
            </td>
            <td>
                {{$Bien['type_bien']}}
            </td>
            <td>
                {{$Bien['loyer']}}
            </td>
            <td>
                {{$Bien['garantie']}}
            </td>
            <td>
                {{$Bien['prix']}}
            </td>
            <td>
                {{$Bien['surface']}}
            </td>
            <td>
                <form action="{{ route('bien.destroy', $Bien['id']) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Retirer bien</button>
                </form>

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="text-center">Vous n'avez aucun bien.</td>
        </tr>
    @endforelse
    </tbody>
</table>
