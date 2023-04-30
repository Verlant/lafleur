<?php

class C_GestionPanier
{

    /**
     * Supprime un produit du panier
     * @return void
     */
    public function supprimerUnProduit(C_Session $session, int $idProduit)
    {
        $session->retirerDuPanier($idProduit);
    }

    /**
     * Affiche les produits contenus dans le panier
     * @return Array
     */
    public function voirPanier(C_Session $session, array $desIdProduit)
    {
        $lesProduitsDuPanier = [];
        $n = $session->nbProduitsDuPanier();
        if ($n > 0) {
            $lesProduitsDuPanier = M_Produit::trouveLesProduitsDuTableau($desIdProduit);
        }
        return $lesProduitsDuPanier;
    }
}
