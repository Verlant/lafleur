<?php

/**
 * Requetes sur les couleur Lafleur
 *
 * @author Antoine VERLYCK
 */
class M_Categorie
{

    /**
     * Retourne sous forme d'un tableau associatif toutes les catégories
     *
     * @return Array un tableau associatif
     */
    public static function trouveLesCategories()
    {
        $req = "SELECT
                    *
                FROM
                    categories
                JOIN
                    produits ON categories.id = categorie_id
                GROUP BY categories.id";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::execute($res);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }
}
