<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <title>Formulaire de création de bien</title>
    <style>
        #imagePreviewContainer img {
            max-width: 200px;
            margin: 5px;
            display: block;
        }
        #AutreImages img{
            max-width: 200px;
            margin: 5px;
            display: block;
        }
        #imagePreview {
            max-width: 200px;
            display: none;
        }
        
        #location_fields, #vente_fields {
            display: flex;
        }
    </style>
</head>
<body>
<div class="form-div">
    <form action="{{ isset($bien) ? route('bien.update', $bien->id) : route('bien.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($bien))
            @method('put')
        @endif

        <h3>{{ isset($bien) ? 'Modifier le bien' : 'Créer un bien' }}</h3>
        <label>Type des biens</label>
        <div class="div-in">
            <select name="type_bien" id="type_bien" onchange="toggleFields()">
                <option value="vente" {{ (isset($bien) && $bien->type_bien == 'vente') ? 'selected' : '' }}>Vente</option>
                <option value="location" {{ (isset($bien) && $bien->type_bien == 'location') ? 'selected' : '' }}>Location</option>
            </select>
            <select name="commune">
                <option value="">Choisir une commune</option>
                <option value="annexe" {{ (isset($bien) && $bien->commune == 'annexe') ? 'selected' : '' }}>Annexe</option>
                <option value="lubumbashi" {{ (isset($bien) && $bien->commune == 'lubumbashi') ? 'selected' : '' }}>Lubumbashi</option>
                <option value="katuba" {{ (isset($bien) && $bien->commune == 'katuba') ? 'selected' : '' }}>Katuba</option>
                <option value="kenya" {{ (isset($bien) && $bien->commune == 'kenya') ? 'selected' : '' }}>Kenya</option>
                <option value="kamalondo" {{ (isset($bien) && $bien->commune == 'kamalondo') ? 'selected' : '' }}>Kamalondo</option>
                <option value="rwashi" {{ (isset($bien) && $bien->commune == 'rwashi') ? 'selected' : '' }}>Rwashi</option>
                <option value="kampemba" {{ (isset($bien) && $bien->commune == 'kampemba') ? 'selected' : '' }}>Kampemba</option>
            </select>
            <input type="number" name="chambre" placeholder="Nombre chambre" value="{{ $bien->chambre ?? '' }}">
        </div>
        <div class="div-app"></div>

        <textarea name="description" cols="30"  rows="10" placeholder="Description">{{$bien->description ?? ''}}</textarea>

        <div id="location_fields">
            <input type="text" name="loyer" value="{{ $bien->loyer ?? '' }}" placeholder="Loyer">
            <input type="text" name="garantie" value="{{$bien->garantie ?? ''}}" placeholder="Garantie">
        </div>
        <div class="div-inputs">
            <div id="vente_fields">
                <input type="text" name="prix_vente" value="{{$bien->prix_vente ?? ''}}" placeholder="Prix de vente">
            </div>
            <input type="text" name="quartier" value="{{$bien->quartier ?? ''}}" placeholder="Quartier">

            <input type="text" name="avenue" value="{{$bien->avenue ?? ''}}"  placeholder="Avenue/rue">
            <input type="text" name="surface" value="{{$bien->surface ?? ''}}" placeholder="Surface en m2">
        </div>
        <div class="div-image">
            <div class="div-img">
                <label for="image_principale">Image principale</label>
                <input type="file" name="image_principale" id="image_principale" onchange="previewImage()">

            </div>
            <div class="div-img">
                <label for="photo">D'autres images</label>
                <input type="file" id="photo" name="image[]" accept="image/*" multiple onchange="previewImages()" >
            </div>
        </div>
        <label>Prévisualisation des Photos</label>
        <div class="file-upload-container">
            @if(isset($imagePrincipale))
                <img id="imagePrincipale" src="{{ asset('storage/'.$imagePrincipale) }}"  alt="Aperçu de l'image principale" style="max-width: 50px;">
            @endif
                @if(isset($ToutesImages) && count($ToutesImages) > 0)
                    <div id="AutreImages">
                        @foreach($ToutesImages as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Image du bien" style="display: inline-block">
                        @endforeach
                    </div>
                @endif
                <img id="imagePreview"/>
            <div id="imagePreviewContainer"></div>
        </div>
        <br>
        <input type="submit" value="Enregistrer un bien">
    </form>
</div>

<script>
    function previewImage() {
        const fileInput = document.getElementById('image_principale');
        const imagePreview = document.getElementById('imagePreview');
        const imagePrincipale = document.getElementById('imagePrincipale')

        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                imagePrincipale.style.display = 'none'
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    }

    function previewImages() {
        const fileInput = document.getElementById('photo');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const AutreImages = document.getElementById('AutreImages')

        imagePreviewContainer.innerHTML = ''; // Clear previous previews

        for (const file of fileInput.files) {
            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    imagePreviewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }
        AutreImages.style.display = 'none'
    }

    function toggleFields() {
    var typeBien = document.getElementById('type_bien').value;
    var locationFields = document.getElementById('location_fields');
    var venteFields = document.getElementById('vente_fields');

    if (typeBien === 'location') {
        locationFields.style.display = 'grid';
        locationFields.style.gap = '0.8em';
        locationFields.style.gridTemplateColumns = 'repeat(2, 1fr)';
        locationFields.style.marginBottom = '0.8em';
        locationFields.style.marginTop = '0.8em';
        venteFields.style.display = 'none';
    } else if (typeBien === 'vente') {
        venteFields.style.display = 'block';
        locationFields.style.display = 'none';
    } else {
        // Si aucun type n'est sélectionné, on cache les deux
        locationFields.style.display = 'none';
        venteFields.style.display = 'none';
    }
}

    // Appeler la fonction lors du chargement de la page pour définir l'état initial
    window.onload = toggleFields;
</script>
</body>
</html>
