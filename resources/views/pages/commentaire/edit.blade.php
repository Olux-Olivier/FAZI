<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css')}}">
    <title>FAZI | Poster un commentaire</title>
</head>
<body>
    <div class="formStandard">
        <form method="post" action="{{route('commentaire.update', $commentaire->id)}}">
            <h1>Modifier le commentaire</h1> 
            @csrf
            @method('put')
            <textarea name="message"  id="" cols="30" rows="10">{{old('content',$commentaire->message)}}</textarea>
            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
            <input type="submit" value="Modifier">
        </form>
    </div>
</body>
</html>
