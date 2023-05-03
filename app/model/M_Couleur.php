<?php

/**
 * Requetes sur les couleur Lafleur
 *
 * @author Antoine VERLYCK
 */
class M_Couleur
{

    /**
     * Retourne sous forme d'un tableau associatif toutes les couleurs
     *
     * @return Array un tableau associatif
     */
    public static function trouveLesCouleurs()
    {
        $req = "SELECT
                    nom_couleur, couleur_id
                FROM
                    produits
                JOIN 
                    fleur_produit ON produit_id = produits.id
                JOIN 
                    fleurs ON fleur_id = fleurs.id
                JOIN
                    couleurs ON couleur_id = couleurs.id
                    GROUP BY couleurs.id";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::execute($res);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }
}
