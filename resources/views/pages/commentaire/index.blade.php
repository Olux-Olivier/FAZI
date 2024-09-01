<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAZI | Liste Commentaires</title>
</head>
<body>

    <h1>Tous les commentaires</h1>

    @forelse($commentaires as $commentaire)
        <strong>{{$commentaire['nom']}} {{$commentaire['prenom']}}</strong>   - <em>{{$commentaire['date']}}</em>
        <br>
        {{$commentaire['commentaire']}}
        <br><br>
        @guest

        @endguest
        @auth

            @php  if(\Illuminate\Support\Facades\Auth::user()->id == $commentaire['user_id']){ @endphp
            <form action="{{route('commentaire.destroy', $commentaire['id_commentaire'])}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Supprimer</button>
            </form>

            <a href="{{route('commentaire.edit', $commentaire['id_commentaire'])}}">Modifier le commentaire</a>
            @php }@endphp
        @endauth
    @empty
        <p>Aucun commentaire disponible.</p>
    @endforelse

</body>
</html>
