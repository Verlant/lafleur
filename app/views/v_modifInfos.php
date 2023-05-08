<form action="index.php?uc=espaceClient&action=modifierInfos" method="POST">
    <section class="form-section">
        <h1>Modifier vos informations</h1>
        <label class="text" for="nom">Nom</label>
        <input type="text" value="<?= ucfirst($infosClient["nom_client"]); ?>" name="nom">
        <label class="text" for="prenom">Prénom</label>
        <input type="text" value="<?= ucfirst($infosClient["prenom_client"]); ?>" name="prenom">
        <label class="text" for="rue">Rue</label>
        <input type="text" value="<?= $infosClient["rue"]; ?>" name="rue">
        <label class="text" for="ville">Ville</label>
        <input type="text" value="<?= ucfirst($infosClient["nom_ville"]); ?>" name="ville">
        <label class="text" for="cp">Code postal</label>
        <input type="text" value="<?= $infosClient["cp"]; ?>" name="cp">
        <label class="text" for="mail">Email</label>
        <input type="text" value="<?= $infosClient["email"]; ?>" name="mail">
        <label class="text" for="phone">Téléphone</label>
        <input type="text" value="<?= $infosClient["tel"]; ?>" name="phone">
        <button type="submit" value="modifierInfos" name="valider" class="primary-btn">Valider</button>
    </section>
</form>