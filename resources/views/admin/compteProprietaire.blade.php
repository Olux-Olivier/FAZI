<h3>Comptes proprietaires </h3>

@forelse($Users as $user)
    Preno : {{ $user->prenom }} <br>
    Nom : {{ $user->nom }}<br>
    Adresse : {{ $user->adresse }} <br>
    Date de creation du compte : {{ $user->created_at }}

    <form action="{{route('bien.destroy', $user->id)}}" method="post">
        @csrf
        @method('delete')
        <button type="submit">Supprimer le compte</button>
    </form>
@empty
    Aucun client
@endforelse
