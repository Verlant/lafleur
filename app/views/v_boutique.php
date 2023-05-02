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
<!-- <aside class="aside-mobile">
    <div>
        <h2>Catégories</h2>
        <ul class="filtre-container">
            <?php
            foreach ($lesCategories as $uneCategorie) :
                $idCategorie = $uneCategorie['id'];
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
                $idCouleur = $uneCouleur['id'];
                $nomCouleur = $uneCouleur['nom_couleur'];
            ?>
                <li class="li-puce">
                    <a class="filtre-boutique" href="index.php?uc=boutique&couleur=<?= $idCouleur ?>">
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
</aside> -->
<section class="section-boutique">
    <?php
    foreach ($lesProduits as $unProduit) :
        $idProduit = $unProduit['produit_id'];
        $nomProduit = $unProduit['nom_produit'];
        $prixVente = $unProduit['prix_vente'];
    ?>
        <article class="card">
            <img src="public/img/produit1.jpg" alt="image de bouquet">
            <span class="info-produit-card">
                <p class="nom-produit"><?= $nomProduit; ?> </p>
                <p class="text-center"><?= $prixVente; ?> €</p>
                <img data-id="<?= $idProduit ?>" class="logo-panier" src="public/img/panier.svg" alt="logo de panier">
            </span>
        </article>
    <?php endforeach ?>
</section>