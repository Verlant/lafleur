<?php

class M_Adresse
{
    /**
     * Effectue la requete d'insertion d'une adresse dans la bdd
     * @param String $rue
     * @param Int $ville_id
     * @param Int $cp_id
     * @return int|false
     */
    public static function creerAdresse(String $rue, int $ville_id, int $cp_id)
    {
        // Requete d'ecriture d'une adresse
        $req = "INSERT INTO adresses
                    (rue, ville_id, code_postal_id)
                VALUES
                    (:rue, :ville_id, :cp_id)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':rue', $rue, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':ville_id', $ville_id, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':cp_id', $cp_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        if (M_AccesDonnees::lastInsertId() == 0) {
            return false;
        }
        return M_AccesDonnees::lastInsertId();
    }

    /**
     * Effectue une requete de lecture renvoyant
     * la liste des adresse d'un client en fonction de son id
     * @param int $client_id
     * @return Array|false
     */
    public static function trouveAdresse(String $rue, int $ville_id, int $cp_id)
    {
        $req = "SELECT
                    adresses.id
                FROM
                    adresses
                JOIN
                    codes_postaux ON codes_postaux.id = code_postal_id
                JOIN 
                    villes ON villes.id = ville_id
                WHERE
                    rue = :rue
                    AND
                    ville_id = :ville_id
                    AND
                    code_postal_id = :cp_id";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':rue', $rue, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':ville_id', $ville_id, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':cp_id', $cp_id, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
