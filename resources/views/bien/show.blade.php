<div>
    Description : {{$bien->description}}
    <br>
    Chambre : {{$bien->chambre}}
    <br>
    Commune : {{$bien->commune}}
    <br>
    Loyer : {{$bien->loyer}}
    <br>
    Prix de vente : {{$bien->prix_vente}}
    <br>
    Surface : {{$bien->surface}} m2
    <br>
        <img src="{{asset('storage/'.$imagePrincipale)}}" height="200px" width="200px" alt="" >
        <br>
        Autres images
        <br>
        @foreach($ToutesImages as $image)
            <img src="{{asset('storage/'.$image)}}" height="70" width="70" alt="">
        @endforeach


    <div>
        <h3>Autres Maisons</h3>
        @forelse($OthersWithImages as $other)
            <div>
                <a href="{{route('bien.show', $other['id'])}}">
                    <img src="{{asset('storage/'.$other['imagePrincipale'])}}" height="200px" width="200px" alt="" >
                </a>
                 </div>
        @empty
            Aucune suggestion pour cette categorie
        @endforelse
    </div>
</div>
