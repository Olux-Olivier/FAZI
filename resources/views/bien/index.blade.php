<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Formulaire de création de bien</title>
    <style>
        #imagePreviewContainer img {
            max-width: 200px;
            margin: 5px;
            display: block;
        }
        #imagePreview {
            max-width: 200px;
            display: none;
        }
    </style>
</head>
<body>
<div class="form-div">
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <h3>Créer un bien</h3>
        <label>Type des biens</label>
        <div class="div-in">
            <select name="type_bien" id="type_bien" onchange="toggleFields()">
                <option value="vente">Vente</option>
                <option value="location">Location</option>
            </select>
            <select name="commune">
                <option value="">Choisir une commune</option>
                <option value="annexe">Annexe</option>
                <option value="lubumbashi">Lubumbashi</option>
                <option value="katuba">Katuba</option>
                <option value="kenya">Kenya</option>
                <option value="kamalondo">Kamalondo</option>
                <option value="rwashi">Rwashi</option>
                <option value="kampemba">Kampemba</option>
            </select>
            <input type="number" name="chambre" placeholder="Nombre chambre">
        </div>
        <div class="div-app"></div>

        <textarea name="description" cols="30" rows="10"></textarea>

        <div id="location_fields">
            <input type="text" name="loyer" placeholder="Loyer">
            <input type="text" name="garantie" placeholder="Garantie">
        </div>
        <div class="div-inputs">
            <div id="vente_fields">
                <input type="text" name="prix_vente" placeholder="Prix de vente">
            </div>
            <input type="text" name="quartier" placeholder="Quartier">

            <input type="text" name="avenue" placeholder="Avenue/rue">
            <input type="text" name="surface" placeholder="Surface en m2">
        </div>
        <div class="div-image">
            <div class="div-img">
                <label for="image_principale">Image principale</label>
                <input type="file" name="image_principale" id="image_principale" onchange="previewImage()">
            </div>
            <div class="div-img">
                <label for="photo">D'autres images</label>
                <input type="file" id="photo" name="image[]" accept="image/*" multiple onchange="previewImages()" required>
            </div>
        </div>
        <label>Prévisualisation des Photos</label>
        <div class="file-upload-container">
            <img id="imagePreview" alt="Aperçu de l'image principale"/>
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

        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    }

    function previewImages() {
        const fileInput = document.getElementById('photo');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');

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
    }
    function toggleFields() {
        var typeBien = document.getElementById('type_bien').value;
        var locationFields = document.getElementById('location_fields');
        var venteFields = document.getElementById('vente_fields');

        if (typeBien === 'location') {
            locationFields.style.display = 'block';
            venteFields.style.display = 'none';
        } else if (typeBien === 'vente') {
            locationFields.style.display = 'none';
            venteFields.style.display = 'block';
        }
    }

    // Appeler la fonction lors du chargement de la page pour définir l'état initial
    window.onload = toggleFields;
</script>
</body>
</html>
