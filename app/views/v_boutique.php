<aside class="aside-boutique">
    <div>
        <h2>Catégories</h2>
        <ul class="filtre-container">
            <?php
            foreach ($lesCategories as $uneCategorie) :
                $idCategorie = $uneCategorie['categorie_id'];
                $nomCategorie = $uneCategorie['nom_categorie'];
            ?>
                <li class="li-puce">
                    <a class="filtre-boutique" href="index.php?uc=boutique&action=voirCategorie&categorie=<?= $idCategorie ?>">
                        <?= ucfirst($nomCategorie); ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
    <div>
        <h2>Couleurs</h2>
        <ul class="filtre-container">
            <?php
            foreach ($lesCouleurs as $uneCouleur) :
                $idCouleur = $uneCouleur['couleur_id'];
                $nomCouleur = $uneCouleur['nom_couleur'];
            ?>
                <li class="li-puce">
                    <a class="filtre-boutique" href="index.php?uc=boutique&action=voirCouleur&couleur=<?= $idCouleur ?>">
                        <?= ucfirst($nomCouleur); ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
    <div>
        <h2>
            <a class="filtre-boutique" href="index.php?uc=boutique">
                Tous nos produits
            </a>
        </h2>
    </div>
</aside>
<section class="section-boutique">
    <?php
    foreach ($lesProduits as $unProduit) :
        $idProduit = $unProduit['produit_id'];
        $nomProduit = $unProduit['nom_produit'];
        $prixVente = $unProduit['prix_vente'];
        $produitDispo = $controleur->produitEstDisponible($idProduit);
    ?>
        <article class="card">
            <a href="index.php?uc=produit&produit=<?= $idProduit ?>"><img class="img-produit" src="public/img/produit1.jpg" alt="image de bouquet"></a>
            <span class="info-produit-card">
                <p class="nom-produit-card"><?= $nomProduit; ?> </p>
                <p class="text-center"><?= $prixVente; ?> €</p>
                <?php if ($produitDispo) : ?>
                    <img data-id="<?= $idProduit ?>" class="logo-panier add-panier" src="public/img/panier.svg" alt="logo de panier">
                <?php else : ?>
                    <img data-id="<?= $idProduit ?>" class="logo-panier add-panier produit-indisponible" src="public/img/panier.svg" alt="logo de panier">
                <?php endif; ?>
            </span>
        </article>
    <?php endforeach ?>
</section>