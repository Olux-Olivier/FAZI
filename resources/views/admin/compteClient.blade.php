<h3>Comptes clients</h3>

@forelse($Users as $user)

    {{ $user->prenom }} - {{ $user->nom }}
    <form action="{{route('bien.destroy', $user->id)}}" method="post">
        @csrf
        @method('delete')
        <button type="submit">Retirer le client</button>
    </form>
@empty
    Aucun client
@endforelse
