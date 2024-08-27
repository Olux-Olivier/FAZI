<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <h3>Créer bien</h3>
    <input type="number" name="chambre" placeholder="Nombre chambre">
    <br>
    <br>
    <label for="">Type bien</label>
    <br>
    <select name="type_bien" id="">
        <option value="vente">Vente</option>
        <option value="location">Location</option>
    </select>
    <br>
    <br>
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
    <br>
    <textarea name="description" cols="30" rows="10"></textarea>
    <br>
    <input type="text" name="loyer" placeholder="Loyer">
    <br>
    <input type="text" name="garantie" placeholder="Garantie">
    <br>
    <br>
    <input type="text" name="avenue" placeholder="Avenue/rue">
    <br>
    <br>
    <input type="text" name="prix_vente" placeholder="Prix de vente">
    <br>
    <input type="text" name="quartier" placeholder="Quartier">
    <br>
    <input type="text" name="surface" placeholder="Surface en m2">
    <br>
    <label for="image_principale">Image principale</label>
    <br>
    <input type="file" name="image_principale" id="image_principale" onchange="previewImage()">
    <br>
    <img id="imagePreview" alt="Aperçu de l'image principale"/>
    <br>
    <label for="photo">D'autres images</label>
    <br>
    <input type="file" id="photo" name="image[]" accept="image/*" multiple onchange="previewImages()" required>

    <div class="file-upload-container">
        <p>Prévisualisation des Photos</p>
        <div id="imagePreviewContainer"></div>
    </div>
    <input type="submit" value="Enregistrer un bien">
</form>

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
</script>
</body>
</html>
