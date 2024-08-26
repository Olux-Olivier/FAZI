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
        <input type="text" name="message">
        <input type="number" name="user_id">
        <input type="submit" value="Publier">

    </form>
</body>
</html>