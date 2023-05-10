<article class="produit">
    <div class="img-container">
        <img class="img-produit" src="public/img/produit-<?= $produit[0]["produit_id"]; ?>.jpg" alt="photo de fleurs">
    </div>
    <div class="infos-produit">
        <h1 class="nom-produit"><?= $produit[0]["nom_produit"]; ?></h1>
        <p class="text">Composition du produit</p>
        <ul>
            <?php foreach ($produit as $ligneProduit) :
                if ($ligneProduit["quantite_stock"] < $ligneProduit["quantite_fleur"]) {
                }
            ?>
                <?php if ($ligneProduit["quantite_fleur"] == 1 or $ligneProduit["nom_unite"] == "gr") : ?>
                    <li class="text"><?= $ligneProduit["quantite_fleur"]; ?> <?= $ligneProduit["nom_unite"]; ?> - <?= ucfirst($ligneProduit["nom_fleur"]); ?> <?= $ligneProduit["nom_couleur"]; ?></li>
                <?php else : ?>
                    <li class="text"><?= $ligneProduit["quantite_fleur"]; ?> <?= $ligneProduit["nom_unite"]; ?>s - <?= ucfirst($ligneProduit["nom_fleur"]); ?> <?= $ligneProduit["nom_couleur"]; ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <div class="flex-center">
            <p class="text"><?= $produit[0]["prix_vente"]; ?> €</p>
            <?php if ($produitDispo) : ?>
                <span class="primary-btn add-panier" data-id="<?= $produit[0]["produit_id"]; ?>">Ajouter au panier</span>
            <?php else : ?>
                <span class="primary-btn add-panier produit-indisponible" data-id="<?= $produit[0]["produit_id"]; ?>">Ajouter au panier</span>
            <?php endif; ?>
        </div>
    </div>
</article>