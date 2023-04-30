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
                    *, produits.id as produit_id
                FROM
                    produits";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::execute($res);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
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
                $req = "SELECT 
                            *
                        FROM
                            produits
                        -- JOIN 
                        --     fleur_produit ON produit_id = produits.id
                        -- JOIN 
                        --     fleurs ON fleur_id = fleurs.id
                        -- JOIN
                        --     couleurs ON couleur_id = couleurs.id
                        WHERE
                            produits.id = '$unIdProduit'";
                $res = M_AccesDonnees::prepare($req);
                // $res->execute();
                M_AccesDonnees::execute($res);
                $unProduit = $res->fetch(PDO::FETCH_ASSOC);
                $lesProduits[] = $unProduit;
            }
        }
        return $lesProduits;
    }

    /**
     * Retourne les derniers produits acquis ou modifié le mois dernier
     *
     * @return Array un tableau associatif
     */
    public static function trouveLesProduitsDepuis()
    {
        $dateCeMois = date('Y-d-m H:i:s');
        $today = new DateTime();
        $today->sub(new DateInterval("P1M"));
        $dateMoisAvant = $today->format("Y-d-m H:i:s");
        $req = "SELECT
                    *, produits.id as produit_id
                FROM
                    produits
                WHERE
                    date_creation > '$dateMoisAvant' OR date_modif > '$dateMoisAvant' AND
                date_creation < '$dateCeMois' OR date_modif < '$dateCeMois'
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
                    *, produits.id as produit_id
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
                    *, produits.id as produit_id
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
