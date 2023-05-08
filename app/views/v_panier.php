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
                <img class="img-produit" src="public/img/produit-<?= $idProduit; ?>.jpg" alt="photo de fleurs">
                <div class="description-container">
                    <h2 class="text-center"><?= $nomProduit; ?></h2>
                    <span class="text description">Composition du produit</span>
                    <ul>
                        <?php
                        foreach ($produit as $ligneProduit) :
                            $max = $controleur_consultation->nombreProduitsContenantFleur($ligneProduit["fleur_id"])["produits_contenant_fleur"];
                            $quantiteMax = floor(($ligneProduit["quantite_stock"] / $ligneProduit["quantite_fleur"]) / $max);
                        ?>
                            <?php if ($ligneProduit["quantite_fleur"] == 1 or $ligneProduit["nom_unite"] == "gr") : ?>
                                <li class="text"><?= $ligneProduit["quantite_fleur"]; ?> <?= $ligneProduit["nom_unite"]; ?> - <?= ucfirst($ligneProduit["nom_fleur"]); ?> <?= $ligneProduit["nom_couleur"]; ?></li>
                            <?php else : ?>
                                <li class="text"><?= $ligneProduit["quantite_fleur"]; ?> <?= $ligneProduit["nom_unite"]; ?>s - <?= ucfirst($ligneProduit["nom_fleur"]); ?> <?= $ligneProduit["nom_couleur"]; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="div-prix">
                    <span class="text bold">Prix : <?= $prixProduit; ?> €</span>
                    <div>
                        <label class="text" for="quante_vente-<?= $idProduit; ?>">Quantité : </label>
                        <input class="quantite_vente" type="number" name="quantite_vente-<?= $idProduit; ?>" value="1" min="1" max="<?= $quantiteMax; ?>" required>
                    </div>
                    <p class="text">Maximum : <?= $quantiteMax; ?></p>
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