<form class="form-section" action="index.php?uc=connexion&action=connexion" method="POST" onsubmit="return valideConnexionForm();">
    <h1>Connexion</h1>
    <label class="text" for="mail_connexion">Email</label>
    <input required type="email" name="mail_connexion">
    <label class="text" for="password_connexion">Mot de passe</label>
    <input required type="password" name="password_connexion">
    <button type="submit" value="Connexion" name="valider" class="primary-btn">Connexion</button>
</form>

<form class="form-section" action="index.php?uc=connexion&action=inscription" method="POST" onsubmit="return valideInscriptionForm();">
    <h1>Inscription</h1>
    <label class="text" for="nom">Nom</label>
    <input required type="text" name="nom">
    <label class="text" for="prenom">Prénom</label>
    <input required type="text" name="prenom">
    <label class="text" for="rue">Rue</label>
    <input required type="text" name="rue">
    <label class="text" for="ville">Ville</label>
    <input required type="text" name="ville">
    <label class="text" for="cp">Code postal</label>
    <input required type="text" name="cp">
    <label class="text" for="mail">Email</label>
    <input required type="email" name="mail">
    <label class="text" for="password">Mot de passe</label>
    <input required id="password" class="text password" type="password" name="password">
    <label class="text" for="password_verify">Confirmation mot de passe</label>
    <input required id="password_verify" class="text password" type="password" name="password_verify">
    <label class="text" for="phone">Téléphone</label>
    <input required type="text" name="phone">
    <button type="submit" value="S'inscrire" name="valider" class="primary-btn">S'inscrire</button>
    <p class="text self-center">Tout les champs sont obligatoires</p>
</form>