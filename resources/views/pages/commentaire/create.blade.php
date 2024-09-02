<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <title>FAZI | Poster un commentaire</title>
</head>
<body>
    <div class="formStandard">

        <form method="post" action="/commentaire">
            <h3>Poster un commentaire</h3>
            @csrf
            <textarea name="message" value="" id="" cols="30" rows="10"></textarea>
            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
            <input type="submit" value="Publier">
        </form>
    </div>
</body>
</html>
