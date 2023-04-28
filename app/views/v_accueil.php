<section>
    <div class="basic-section">
        <div class="content-section">
            <h1>Fête des mères</h1>
            <img src="public/img/event.svg" alt="image d'un évènement">
        </div>
        <div class="content-section">
            <p class="text">Pour l’événement de la fête des mères, dimanche 4 juin 2023, une loteria sera mise en place. Pendant deux semaines, toute personne qui passera une commande sur le site pourra tenter sa chance et gagner des cadeaux.</p>
            <p class="text">Lots à gagner pour la loterie de la fête des mères :</p>
            <ol class="text">
                <li>1. 1000 stylos “Lafleur”</li>
                <li>2. 700 sacs réutilisables en tissus “Lafleur”</li>
                <li>3. 200 portes-clés “Lafleur”</li>
                <li>4. 50 roses rouges à offrir</li>
                <li>5. 10 bouquets de roses</li>
            </ol>
        </div>
    </div>
</section>
<section>
    <h1>Sélection de bouquets</h1>
    <div class="produits-accueil">
        <?php foreach ($lesProduits as $unProduit) :
            $idProduit = $unProduit['id'];
            $nomProduit = $unProduit['nom_produit'];
            $prixVente = $unProduit['prix_vente'];
        ?>
            <article class="card">
                <img src="public/img/produit1.jpg" alt="image de bouquet">
                <span class="info-produit-card">
                    <p><?= $nomProduit; ?> <?= $prixVente; ?> €</p>
                    <img data-id="<?= $idProduit ?>" class="logo-panier" src="public/img/panier.svg" alt="logo de panier">
                </span>
            </article>
        <?php endforeach ?>
    </div>
</section>
<section>
    <div class="basic-section">
        <div class="content-section">
            <h1>Boutique en ligne</h1>
            <img src="public/img/event.svg" alt="">
        </div>
        <div class="content-section">
            <p class="text">
                Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Exercitation veniam consequat sunt nostrud amet.
            </p>
            <p class="text">
                Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. Exercitation veniam consequat sunt nostrud amet.
            </p>
            <a class="primary-btn" href="#">Notre boutique</a>
        </div>
    </div>
</section>
<section>
    <div class="basic-section">
        <div class="content-section">
            <h1>Blog de Guillaume Cholet</h1>
            <img src="public/img/event.svg" alt="">
        </div>
        <div class="content-section">
            <p class="text">
                Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
            </p>
            <p class="text">
                Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
            </p>
            <a class="primary-btn" href="#">Visiter notre blog !</a>
        </div>
    </div>
</section>