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
     *  Renvoie les produits de la catégorie demandé
     * @return Array
     */
    public function trouveLesProduitsDeCategorie(int $categorie)
    {
        return M_Produit::trouveLesProduitsDeCategorie($categorie);
    }

    /**
     *  Renvoie les produits de la couleur demandé
     * @return Array
     */
    public function trouveLesProduitsDeCouleur(int $couleur)
    {
        return M_Produit::trouveLesProduitsDeCouleur($couleur);
    }

    /**
     *  Ajoute le produit demandé au panier
     * @return Array
     */
    public function ajouterAuPanier(C_Session $session, int $idProduit)
    {
        // Ajoute le produit au panier s'il n'y est pas
        if (!$session->ajouterProduitSession($idProduit) and $idProduit > 0) {
            return "Ce produit est déjà dans le panier.";
        } else {
            return "Ce produit a été ajouté au panier.";
        }
    }

    /**
     * Vérifie la disponibilité d'un produit
     * @param int
     * @return bool
     */
    public function produitEstDisponible(int $idProduit): bool
    {
        $produit = M_Produit::trouveLeProduit($idProduit);
        foreach ($produit as $ligneProduit) {
            if ($ligneProduit["quantite_stock"] < $ligneProduit["quantite_fleur"]) {
                return false;
            }
        }
        return true;
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
     * Renvoie le produit
     * @param int $id
     * @return Array
     */
    public function trouveLeProduit(int $id)
    {
        return M_Produit::trouveLeProduit($id);
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

    /**
     * Renvoie le nombre de produit contenant cette fleur
     * @param int $idFleur
     * @return Array
     */
    public function nombreProduitsContenantFleur(int $idFleur)
    {
        return M_Produit::nombreProduitsContenantCetteFleur($idFleur);
    }
}
