<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Modification du bien</title>
    <style>
        #imagePreviewContainer img {
            max-width: 200px;
            margin: 5px;
            display: block;
        }
        #AutreImages img {
            max-width: 200px;
            margin: 5px;
            display: inline-block;
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
    <form action="{{ route('bien.update', $bien->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h3>Modifier le bien</h3>
        
        <!-- Type de bien -->
        <label>Type de bien</label>
        <select name="type_bien" id="type_bien" onchange="toggleFields()">
            <option value="vente" {{ $bien->type_bien === 'vente' ? 'selected' : '' }}>Vente</option>
            <option value="location" {{ $bien->type_bien === 'location' ? 'selected' : '' }}>Location</option>
        </select>

        <!-- Commune -->
        <label>Commune</label>
        <select name="commune">
            <option value="">Choisir une commune</option>
            <option value="annexe" {{ $bien->commune === 'annexe' ? 'selected' : '' }}>Annexe</option>
            <option value="lubumbashi" {{ $bien->commune === 'lubumbashi' ? 'selected' : '' }}>Lubumbashi</option>
            <!-- Ajouter les autres options -->
        </select>

        <!-- Informations spécifiques -->
        <input type="number" name="chambre" placeholder="Nombre chambre" value="{{ $bien->chambre }}">
        <textarea name="description" cols="30" rows="10" placeholder="Description">{{ $bien->description }}</textarea>

        <div id="location_fields">
            <input type="text" name="loyer" value="{{ $bien->loyer }}" placeholder="Loyer">
            <input type="text" name="garantie" value="{{ $bien->garantie }}" placeholder="Garantie">
        </div>

        <div id="vente_fields">
            <input type="text" name="prix_vente" value="{{ $bien->prix_vente }}" placeholder="Prix de vente">
        </div>

        <!-- Informations générales -->
        <input type="text" name="quartier" value="{{ $bien->quartier }}" placeholder="Quartier">
        <input type="text" name="avenue" value="{{ $bien->avenue }}" placeholder="Avenue/rue">
        <input type="text" name="surface" value="{{ $bien->surface }}" placeholder="Surface en m2">

        <!-- Images -->
        <label>Images du bien</label>
        <div>
            @if(isset($imagePrincipale))
                <img src="{{ asset('storage/' . $imagePrincipale) }}" alt="Image principale" style="max-width: 200px;">
            @endif
            <div id="AutreImages">
                @foreach($ToutesImages as $image)
                    <img src="{{ asset('storage/' . $image) }}" alt="Autres images" style="max-width: 200px;">
                @endforeach
            </div>
        </div>

        <!-- Champ de prévisualisation -->
        <div>
            <label for="image_principale">Image principale</label>
            <input type="file" name="image_principale" id="image_principale" onchange="previewImage()">
        </div>
        
        <div>
            <label for="photo">D'autres images</label>
            <input type="file" id="photo" name="image[]" accept="image/*" multiple onchange="previewImages()">
        </div>
        
        <input type="submit" value="Enregistrer les modifications">
    </form>
</div>

<script>
    function toggleFields() {
        const typeBien = document.getElementById('type_bien').value;
        const locationFields = document.getElementById('location_fields');
        const venteFields = document.getElementById('vente_fields');

        locationFields.style.display = typeBien === 'location' ? 'flex' : 'none';
        venteFields.style.display = typeBien === 'vente' ? 'flex' : 'none';
    }

    function previewImage() {
        const fileInput = document.getElementById('image_principale');
        const preview = document.getElementById('imagePreview');
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    function previewImages() {
        const fileInput = document.getElementById('photo');
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = ''; // Clear previous previews

        Array.from(fileInput.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }

    window.onload = toggleFields;
</script>
</body>
</html>
