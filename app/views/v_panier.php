<form action="index.php?uc=commander&action=confirmerCommande" method="POST">
    <section class="basic-section section-panier">
        <?php
        if (!$infosClient["est_livrable"]) : ?>
            <p class="message">Votre ville n'est pas encore desservie.</p>
        <?php endif; ?>
        <?php
        $date = new DateTime();
        $tomorrow = $date->add(DateInterval::createFromDateString('1 day'))->format("Y-m-d");
        foreach ($lesProduitsDuPanier as $produit) :
            $idProduit = $produit["id"];
            $nomProduit = $produit["nom_produit"];
            $prixProduit = $produit["prix_vente"];
        ?>
            <article class="article-panier ">
                <img src="public/img/produit1.jpg" alt="photo du produit">
                <div class="description-container">
                    <h2 class="text-center"><?= $nomProduit; ?></h2>
                    <span class="text description">Description :</span>
                    <p class="text description">Aliqua id fugiat nostrud irure ex duis ea quis id quis ad et. Sunt qui esse pariatur duis deserunt mollit dolore cillum minim tempor enim. Elit aute irure tempor cupidatat incididunt sint deserunt ut voluptate aute id deserunt nisi.
                        Aliqua id fugiat nostrud irure ex duis ea quis id quis ad et. Sunt qui esse pariatur duis deserunt mollit dolore cillum minim tempor enim. Elit aute irure tempor cupidatat incididunt sint deserunt ut voluptate aute id deserunt nisi.
                    </p>
                </div>
                <div class="div-prix">
                    <span class="text bold">Prix : <?= $prixProduit; ?> €</span>
                    <div>
                        <label class="text" for="quante_vente-<?= $idProduit; ?>">Quantité : </label>
                        <input class="text" type="number" name="quantite_vente-<?= $idProduit; ?>">
                    </div>
                    <a class="primary-btn" href="index.php?uc=panier&action=supprimerUnProduit&produit=<?= $idProduit; ?>">Supprimer</a>
                </div>
            </article>
        <?php endforeach ?>
        <div>
            <label class="text" for="date-livraison">Date de livraison : </label>
            <input class="text" type="date" name="date-livraison" value="<?= $tomorrow ?>" min="<?= $tomorrow ?>">
        </div>
        <button type="submit" value="confirmerCommande" name="valider" class="primary-btn">Valider la commande</button>
    </section>
</form>