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
            $idProduit = $produit[0]["produit_id"];
            $nomProduit = $produit[0]["nom_produit"];
            $prixProduit = $produit[0]["prix_vente"];
        ?>
            <article class="article-panier ">
                <img src="public/img/produit1.jpg" alt="photo du produit">
                <div class="description-container">
                    <h2 class="text-center"><?= $nomProduit; ?></h2>
                    <span class="text description">Composition du produit</span>
                    <ul>
                        <?php foreach ($produit as $ligneProduit) : ?>
                            <li class="text"><?= $ligneProduit["quantite_fleur"]; ?> <?= ucfirst($ligneProduit["nom_fleur"]); ?> <?= $ligneProduit["nom_couleur"]; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="div-prix">
                    <span class="text bold">Prix : <?= $prixProduit; ?> €</span>
                    <div>
                        <label class="text" for="quante_vente-<?= $idProduit; ?>">Quantité : </label>
                        <input type="number" name="quantite_vente-<?= $idProduit; ?>" value="1">
                    </div>
                    <a class="primary-btn" href="index.php?uc=panier&action=supprimerUnProduit&produit=<?= $idProduit; ?>">Supprimer</a>
                </div>
            </article>
        <?php endforeach ?>
        <div>
            <label class="text" for="date-livraison">Date de livraison : </label>
            <input type="date" name="date-livraison" value="<?= $tomorrow ?>" min="<?= $tomorrow ?>">
        </div>
        <button type="submit" value="confirmerCommande" name="valider" class="primary-btn">Valider la commande</button>
    </section>
</form>