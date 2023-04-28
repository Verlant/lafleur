<?php
class C_Consultation
{

    /**
     *  Renvoie les produits ajouté ou modifié depuis 1 mois
     * @return Array
     */
    public function derniersProduitsSortis()
    {
        return M_Produit::trouveLesProduitsDepuis();
    }

    /**
     *  Renvoie de la catégorie demandé
     * @return Array
     */
    public function trouveLesProduitsDeCategorie(int $categorie)
    {
        return M_Produit::trouveLesProduitsDeCategorie($categorie);
    }

    /**
     *  Renvoie de la couleur demandé
     * @return Array
     */
    public function trouveLesProduitsDeCouleur(int $couleur)
    {
        return M_Produit::trouveLesProduitsDeCouleur($couleur);
    }

    /**
     *  Ajoute le jeu demandé au panier en gardant l'affichage des produits de la page actuelle
     * @return Array
     */
    public function ajouterAuPanier(C_Session $session, int $idProduit)
    {
        // Ajoute le jeu au panier s'il n'y est pas
        if (!$session->ajouterProduitSession($idProduit) and $idProduit > 0) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }

        // Condition nécessaire afin de garder les bons produits affiché après ajout au panier
        // if ($categorie > 0) {
        //     return M_Produit::trouveLesProduitsDeCategorie($categorie);
        // } else {
        //     return M_Produit::trouveLesProduitsDepuis();
        // }
    }

    /**
     * Renvoie tous les produits
     * @return Array
     */
    public function tousLesProduits()
    {
        return M_Produit::trouveLesProduits();
    }

    /**
     * Renvoie les catégories
     * @return Array
     */
    public function toutesLesCategories()
    {
        return M_Categorie::trouveLesCategories();
    }

    /**
     * Renvoie les couleurs
     * @return Array
     */
    public function toutesLesCouleurs()
    {
        return M_Couleur::trouveLesCouleurs();
    }
}
