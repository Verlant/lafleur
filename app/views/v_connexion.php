<form class="form-section" action="index.php?uc=connexion&action=connexion" method="POST">
    <h1>Connexion</h1>
    <label class="text" for="mail_connexion">Email</label>
    <input class="text" type="email" name="mail_connexion">
    <label class="text" for="password_connexion">Mot de passe</label>
    <input class="text" type="password" name="password_connexion">
    <button type="submit" value="Connexion" name="valider" class="primary-btn">Connexion</button>
</form>

<form class="form-section" action="index.php?uc=connexion&action=inscription" method="POST">
    <h1>Inscription</h1>
    <label class="text" for="nom">Nom*</label>
    <input class="text" type="text" name="nom">
    <label class="text" for="prenom">Prénom*</label>
    <input class="text" type="text" name="prenom">
    <label class="text" for="rue">Rue*</label>
    <input class="text" type="text" name="rue">
    <label class="text" for="ville">Ville*</label>
    <input class="text" type="text" name="ville">
    <label class="text" for="cp">Code postal*</label>
    <input class="text" type="text" name="cp">
    <label class="text" for="mail">Email*</label>
    <input class="text" type="email" name="mail">
    <label class="text" for="password">Mot de passe*</label>
    <input id="password" class="text password" type="password" name="password">
    <label class="text" for="password_verify">Confirmation mot de passe*</label>
    <input id="password_verify" class="text password" type="password" name="password_verify">
    <label class="text" for="phone">Téléphone</label>
    <input class="text" type="text" name="phone">
    <button type="submit" value="S'inscrire" name="valider" class="primary-btn">S'inscrire</button>
    <p class="text self-center">Les champs marqués d'un * sont obligatoires</p>

</form>