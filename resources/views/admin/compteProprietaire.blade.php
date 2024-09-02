<h3>Comptes proprietaires </h3>

@forelse($Users as $user)
    {{ $user->prenom }} - {{ $user->nom }}
    <form action="{{route('bien.destroy', $user->id)}}" method="post">
        @csrf
        @method('delete')
        <button type="submit">Retirer le proprietaire</button>
    </form>
@empty
    Aucun client
@endforelse
