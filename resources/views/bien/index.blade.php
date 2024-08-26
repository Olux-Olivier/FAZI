<form action="" method="post">
    @csrf
    <h3>Creer bien</h3>
    <input type="number" name="chambre" id="" placeholder="Nombre chambre">
    <br>
    <select name="commune" id="">
        <option value="">Choisir une commune </option>
        <option value="annexe">Annexe</option>
        <option value="lubumbashi">Lubumbashi</option>
        <option value="katuba">Katuba</option>
        <option value="kenya">Kenya</option>
        <option value="kamalondo">Kamalondo</option>
        <option value="rwashi">Rwashi</option>
        <option value="kampemba">Kampemba</option>
    </select>
    <br>
    <textarea name="description" id="" cols="30" rows="10"></textarea>
    <br>
    <input type="text" name="loyer" id="" placeholder="Loyer">
    <br>
    <input type="text" name="garantie" id="" placeholder="Garantie">
    <br>
    <input type="text" name="prix_vente" id="" placeholder="Prix de vente">
    <br>
    <input type="text" name="surface" id="" placeholder="Surface en m2">
    <br>
    <input type="file" id="photo" name="image" accept="image/*" onchange="previewImage()" required>

    <div class="file-upload-container">
        <p>Prévisualisation de la Photo </p>
        <img id="imagePreview" alt="Aperçu de la Photo" style="display: none;">
    </div>
    <input type="submit" value="Enregistrer un bien">
</form>
<script>
    function previewImage() {
        const fileInput = document.getElementById('photo');
        const imagePreview = document.getElementById('imagePreview');

        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
