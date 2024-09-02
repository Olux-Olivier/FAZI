@forelse($ImagesBiens as $Bien)
    <div>
        <a href="{{route('bien.show', $Bien['id'])}}">
            <img src="{{asset('storage/'.$Bien['imagePrincipale'])}}" height="200px" width="200px" alt="" >
        </a>
        <div>
            Chambre : {{$Bien['chambre']}}
        </div>
    </div>
@empty
    Vous n'avez aucun bien
@endforelse


