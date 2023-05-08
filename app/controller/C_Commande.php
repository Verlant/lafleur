<?php

class C_Commande
{
    /**
     * Fonction qui affiche la vue v_commande lors de l'action passerCommande
     * ou affiche un message disant "panier vide" si celui-ci est vide
     * @param C_Session $session
     * @param String $uc
     * @return String
     */
    public function passerCommande(C_Session $session, String $uc): String
    {
        if (empty($session->nbProduitsDuPanier())) {
            afficheMessage("Panier Vide !!");
            $uc = '';
        }
        return $uc;
    }

    /**
     * Fonction servant a valider la commande effectué, vide le panier
     * et affiche un message validant la commande
     * @param C_Session $session
     * @param Array $quantites_ventes
     * @return String
     */
    public function confirmerCommande(C_Session $session, array $quantites_ventes): String
    {
        $client_id = $session->getIdClient();
        $lesIdProduit = $session->getLesIdProduitsDuPanier();
        $lesProduits = M_Produit::trouveLesProduitsDuTableau($lesIdProduit);
        $frais_livraison = false;
        $prix_total_commande = 0;
        $i = 0;
        foreach ($lesProduits as $produit) {
            $prix_total_commande += $produit[0]["prix_vente"] * $quantites_ventes[$i];
            $i++;
        }
        if ($prix_total_commande < 50) {
            $prix_total_commande += 2.99;
            $frais_livraison = true;
        }
        M_Commande::creerCommande($client_id, $lesIdProduit, $quantites_ventes, $frais_livraison);
        $session->supprimerPanier();
        return afficheMessage("Commande enregistrée.");
    }
}
