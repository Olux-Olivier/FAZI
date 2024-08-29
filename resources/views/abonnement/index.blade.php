<div>
    <h2>Abonnement !</h2>
    Choisissez votre abonnement
    <div>
        <p>Abonner avec 5 000 Fc</p> <br>
        <form action="" method="post">
            @csrf
            <label for="">Abonner vous avec 5 000 FC</label>
            <input type="text" name="numero" id=""placeholder="Numero de telephone" required>
            <input type="hidden" name="montant" value="5000">
            <input type="submit" value="S'abonner">
        </form>
    </div>
</div>
