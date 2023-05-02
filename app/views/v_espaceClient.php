<section>
    <?php
    if (!$infosClient["est_livrable"]) : ?>
        <p class="message">Votre ville n'est pas encore desservie.</p>
    <?php endif; ?>
    <div class="basic-section">
        <div class="client-section">
            <h1>Vos informations</h1>
            <div class="infos-client">
                <div class="text">
                    <span class="bold">Nom</span> : <?= ucfirst($infosClient['nom_client']) ?>
                </div>
                <div class="text">
                    <span class="bold">Prénom</span> : <?= ucfirst($infosClient['prenom_client']) ?>
                </div>
                <div class="text">
                    <span class="bold">Mail</span> : <?= $infosClient['email'] ?>
                </div>
                <div class="text">
                    <span class="bold">Téléphone</span> : <?= $infosClient['tel'] ?>
                </div>
                <div class="text">
                    <span class="bold">Adresse</span> : <?= $infosClient['rue'] ?>, <?= ucfirst($infosClient['nom_ville']) ?>, <?= $infosClient['cp'] ?>
                </div>
            </div>
            <div class="boutons-espace-client">
                <a class="primary-btn" href="index.php?uc=modifierInfos">Modifier</a>
                <a class="primary-btn" href="index.php?uc=espaceClient&action=deconnexion">Déconnexion</a>
            </div>
        </div>
        <div class="commandes-client">
        </div>
    </div>
</section>
<section class="basic-section section-commandes">
    <h1>Vos achats</h1>
    <?php if (empty($commandes)) : ?>
        <p class="message">Aucune commande n'a été effectuée.</p>
    <?php else : ?>
        <?php foreach ($commandes as $commande) :
            $prixTotal = 0 ?>
            <article class="article-panier">
                <div>
                    <p class="text">Date de commande : <?= DateTime::createFromFormat('Y-m-d H:i:s', $commande["date_commande"])->format("d/m/Y H:i:s"); ?></p>
                    <p class="text">Date de livraison : <?= DateTime::createFromFormat('Y-m-d', $commande["date_livraison"])->format("d/m/Y"); ?></p>
                </div>
                <div>
                    <span class="text">Vos produits :</span>
                    <ul class="text">
                        <?php
                        foreach ($produitsParCommandes[$commande["id"]] as $produit) :
                            $prixTotal += $produit["prix_vente"] * $produit["quantite_vente"];
                            $prixProduits = $produit["prix_vente"] * $produit["quantite_vente"]
                        ?>
                            <li class="produit-li">
                                <?= $produit["quantite_vente"]; ?> <?= ucfirst($produit["nom_produit"]); ?> à <?= $produit["prix_vente"]; ?> € - Total : <?= $prixProduits; ?> €
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div>
                    <p class="text bold">Commande n°<?= $commande['id']; ?></p>
                    <?php if ($commande['frais_livraison']) : $prixTotal += 2.99 ?>
                        <p class="text bold">Total : <?= $prixTotal; ?> €</p>
                        <p class="text">Frais de livraison : 2.99 €</p>
                    <?php else : ?>
                        <p class="text bold">Total : <?= $prixTotal; ?> €</p>
                        <p class="text">Pas de frais de livraison</p>
                    <?php endif ?>
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>