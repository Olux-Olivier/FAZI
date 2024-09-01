<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAZI | Poster un commentaire</title>
</head>
<body>
    <h1>Poster un commentaire</h1>
    <form method="post" action="/commentaire">
        @csrf
        <textarea name="message" value="" id="" cols="30" rows="10"></textarea>
        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
        <input type="submit" value="Publier">

    </form>
</body>
</html>
