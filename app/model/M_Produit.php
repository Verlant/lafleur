<?php

/**
 * Requetes sur les produits Lafleur
 *
 * @author Antoine VERLYCK
 */
class M_Produit
{
    /**
     * Retourne sous forme d'un tableau associatif tous les produits
     *
     * @return Array un tableau associatif
     */
    public static function trouveLesProduits()
    {
        $req = "SELECT
                    nom_produit, id AS produit_id, prix_vente
                FROM 
                    produits";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::execute($res);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }

    /**
     * Retourne le produit
     * @param int $id
     * @return Array un tableau associatif
     */
    public static function trouveLeProduit(int $id)
    {
        $req = "SELECT
                    nom_produit, produit_id, prix_vente, quantite_fleur, quantite_stock, nom_fleur, nom_couleur
                FROM 
                    produits 
                JOIN 
                    fleur_produit ON produits.id = produit_id
                JOIN 
                    fleurs ON fleur_id = fleurs.id
                JOIN
                    couleurs ON couleur_id = couleurs.id
                WHERE produit_id = $id";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::execute($res);
        $produit = $res->fetchAll(PDO::FETCH_ASSOC);
        return $produit;
    }

    /**
     * Retourne les produits concernés par le tableau des idProduits passée en argument
     *
     * @param $desIdProduits tableau d'idProduits
     * @return Array un tableau associatif
     */
    public static function trouveLesProduitsDuTableau($desIdProduits)
    {
        $nbProduits = count($desIdProduits);
        $lesProduits = array();
        if ($nbProduits != 0) {
            foreach ($desIdProduits as $unIdProduit) {
                // $req = "SELECT
                //             nom_produit, produits.id AS id, prix_vente, quantite_fleur, quantite_stock, nom_fleur, nom_couleur
                //         FROM 
                //             produits 
                //         JOIN 
                //             fleur_produit ON produits.id = produit_id
                //         JOIN 
                //             fleurs ON fleur_id = fleurs.id
                //         JOIN
                //             couleurs ON couleur_id = couleurs.id
                //         WHERE produit_id = $unIdProduit";
                // $res = M_AccesDonnees::prepare($req);
                // // $res->execute();
                // M_AccesDonnees::execute($res);
                // $unProduit = $res->fetch(PDO::FETCH_ASSOC);
                $lesProduits[] = M_Produit::trouveLeProduit($unIdProduit);
            }
        }
        return $lesProduits;
    }

    /**
     * Retourne les 5 derniers produits ajouté ou modifié à la bdd
     *
     * @return Array un tableau associatif
     */
    public static function trouveLesProduitsDepuis()
    {
        $req = "SELECT
                    nom_produit, produits.id as id, prix_vente
                FROM
                    produits
                ORDER BY greatest(date_creation, date_modif) DESC
                LIMIT 5";
        $res = M_AccesDonnees::prepare($req);
        // $res->execute();
        M_AccesDonnees::execute($res);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }


    /**
     * Retourne sous forme d'un tableau associatif tous les produits de la
     * catégorie passée en argument
     *
     * @param $idCategorie
     * @return Array un tableau associatif
     */
    public static function trouveLesProduitsDeCategorie($idCategorie)
    {
        $req = "SELECT
                    nom_produit, produits.id AS produit_id, prix_vente
                FROM
                    produits
                JOIN
                    categories ON categorie_id = categories.id
                WHERE
                    categorie_id = '$idCategorie'";
        $res = M_AccesDonnees::prepare($req);
        // $res->execute();
        M_AccesDonnees::execute($res);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }

    /**
     * Retourne sous forme d'un tableau associatif tous les produits de la
     * catégorie passée en argument
     *
     * @param $idCouleur
     * @return Array un tableau associatif
     */
    public static function trouveLesProduitsDeCouleur($idCouleur)
    {
        $req = "SELECT
                    nom_produit, produit_id, prix_vente
                FROM
                    produits
                JOIN 
                    fleur_produit ON produit_id = produits.id
                JOIN 
                    fleurs ON fleur_id = fleurs.id
                JOIN
                    couleurs ON couleur_id = couleurs.id
                WHERE
                    couleur_id = '$idCouleur'";
        $res = M_AccesDonnees::prepare($req);
        // $res->execute();
        M_AccesDonnees::execute($res);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }
}
