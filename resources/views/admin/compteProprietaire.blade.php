<h3>Comptes proprietaires </h3>

@forelse($Users as $user)
    {{ $user->prenom }} - {{ $user->nom }}
@empty
    Aucun client
@endforelse
