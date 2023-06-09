<?php

class M_CodePostal
{
    /**
     * Effectue une requete d'insertion pour ajotuer un nouveau code postal dans la bdd
     * Renvoie l'id du code postal ajoutéen cas de succès
     * Renvoie false en cas d'erreur
     * @param String code postal
     * @return int|false
     */
    public static function creerCodePostal(String $cp)
    {
        $req = "INSERT INTO codes_postaux (cp) VALUES (:cp)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':cp', $cp, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        if (M_AccesDonnees::lastInsertId() == 0) {
            return false;
        }
        return M_AccesDonnees::lastInsertId();
    }

    /**
     * Effecture une requete de lecture pour récupérer l'id d'un code postal en fonction de celui-ci
     * Renvoie false en cas d'erreur
     * @param String code postal
     * @return array|false
     */
    public static function trouveLeCodePostal(String $cp)
    {
        $req = "SELECT id FROM codes_postaux WHERE cp = :cp";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':cp', $cp, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
