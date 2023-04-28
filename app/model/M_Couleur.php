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
                    *
                FROM
                    couleurs";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::execute($res);
        $lesLignes = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesLignes;
    }
}
