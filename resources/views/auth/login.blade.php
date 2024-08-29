<div>
    <h1>
        <form action="/auth" method="post">
            @csrf
            @error('email')
            {{$message}}
            @enderror
            <input type="text" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">

            <button>Connecter</button>
            <a href="{{route('signup')}}" > Creez un compte</a>
        </form>
    </h1>
</div>
