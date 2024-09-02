<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/home.css">
    <title>Document</title>
</head>
<body>
<div class="formStandard">

        <form action="/auth" method="post">
            <h1>Login</h1>
            @csrf
            @error('email')
            <p>{{$message}}</p>
            @enderror
            <input type="text" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">

            <button>Connecter</button>
            <a href="{{route('signup')}}" > Creez un compte</a>
        </form>

</div>
</body>
</html>

