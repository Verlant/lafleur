<article class="produit">
    <div class="img-container">
        <img class="img-produit" src="public/img/produit1.jpg" alt="photo d'un bouquet">
    </div>
    <div class="infos-produit">
        <h1 class="nom-produit"><?= $produit[0]["nom_produit"]; ?></h1>
        <p class="text">Composition du produit</p>
        <ul>
            <?php foreach ($produit as $ligneProduit) :
                if ($ligneProduit["quantite_stock"] < $ligneProduit["quantite_fleur"]) {
                }
            ?>
                <li class="text"><?= $ligneProduit["quantite_fleur"]; ?> <?= ucfirst($ligneProduit["nom_fleur"]); ?> <?= $ligneProduit["nom_couleur"]; ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="flex-center">
            <p class="text"><?= $produit[0]["prix_vente"]; ?> €</p>
            <span class="primary-btn add-panier" data-id="<?= $produit[0]["produit_id"]; ?>">Ajouter au panier</span>
        </div>
    </div>
</article>