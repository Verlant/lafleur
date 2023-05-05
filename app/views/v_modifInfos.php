<form action="index.php?uc=espaceClient&action=modifierInfos" method="POST">
    <section class="form-section">
        <h1>Modifier vos informations</h1>
        <label class="text" for="nom">Nom</label>
        <input type="text" name="nom">
        <label class="text" for="prenom">Prénom</label>
        <input type="text" name="prenom">
        <label class="text" for="rue">Rue</label>
        <input type="text" name="rue">
        <label class="text" for="ville">Ville</label>
        <input type="text" name="ville">
        <label class="text" for="cp">Code postal</label>
        <input type="text" name="cp">
        <label class="text" for="mail">Email</label>
        <input type="text" name="mail">
        <label class="text" for="password">Mot de passe</label>
        <input id="password" class="text password" type="password" name="password">
        <label class="text" for="password_verify">Confirmation mot de passe</label>
        <input id="password_verify" class="text password" type="password" name="password_verify">
        <label class="text" for="phone">Téléphone</label>
        <input type="text" name="phone">
        <button type="submit" value="modifierInfos" name="valider" class="primary-btn">Valider</button>
    </section>
</form>