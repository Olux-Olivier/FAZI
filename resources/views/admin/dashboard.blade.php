<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">
    <title>Dashboard Admin</title>
</head>
<body>
    <div class='d-container'>
        <div class="dd-content">
        
            <div class="d-side">
                <h3>FA<span>ZI</span></h3>
                <div class="d-option">
                    <a href="{{route('adim-dashboard.compteClient')}}" class="active" >Dashboad</a>
                    <a href="{{route('adim-dashboard.compteClient')}}">Voir les comptes clients</a>

                    <a href="{{route('admin-dashboard.compteProprietaire')}}">Voir les comptes proprietaires</a>

                    <a href="{{route('admin-dashboard.commandes')}}">Voir toutes les commandes</a>

                    <a href="{{route('admin-dashboard.biens')}}">Voir tous les biens</a>

                    <a href="{{route('index')}}">Retourner a l'acceuil</a>
                </div>
            </div>
            <div class="d-contents"> 
                <div class="d-accueil">
                    <div class="d-container-card">
    
                        <h3>Information dashboard </h3>
                        <div clas="list-card">
                        </div class='list-card'>
                            <div class='d-card'>
                                <div class="d-card-body">
                                    <h3>4099</h3>
                                    <span>Comptes client</span>
                                </div>
                            </div>
                            <div class='d-card'>
                                <div class="d-card-body">
                                    <h3>4099</h3>
                                    <span>Comptes proprietaire</span>
                                </div>
                            </div>
                            <div class='d-card'>
                                <div class="d-card-body">
                                    <h3>4099</h3>
                                    <span>Biens à vendre</span>
                                </div>
                            </div>
                            <div class='d-card'>
                                <div class="d-card-body">
                                    <h3>4099</h3>
                                    <span>Biens à vendre</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-card-options">
                        <a href="#">
                            <div class="card-opt">
                                <h3>Voir les comptes client</h3>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                </p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="card-opt">
                                <h3>Voir les comptes proprietaires</h3>
                                <p>

                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. e.
                                </p>
                            </div>
                        </a>

                        <a href="#">
                            <div class="card-opt">
                                <h3>Voir toutes les commandes</h3>
                                <p>

                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                </p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="card-opt">
                                <h3>Voir les biens à vendre</h3>
                                <p>

                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                </p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="card-opt">
                                <h3>Voir les biens à louer</h3>
                                <p>

                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                </p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="card-opt">
                                <h3>Voir tous les biens</h3>
                                <p>

                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                </p>
                            </div>
                        </a>
                        <a href="#">
                            <div class="card-opt">
                                <h3>Retourner à l'accuel</h3>
                                <p>

                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                </p>
                            </div>
                        </a>
                    </div>
                    </div>

                    </div>
                </div>

                
            </div>
            </div>
        </div>
    </div>

</body>
</html>
