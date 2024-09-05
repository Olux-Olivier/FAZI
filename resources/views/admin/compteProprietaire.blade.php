<h3>Comptes proprietaires </h3>

<a href="{{route('admin-dashboard')}}">Retour</a>

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

