<?php

class M_Adresse
{
    /**
     * Effectue la requete d'insertion d'une adresse dans la bdd
     * @param String $rue
     * @param Int $ville_id
     * @param Int $cp_id
     * @return bool
     */
    public static function modifAdresse(String $rue, int $ville_id, int $cp_id): bool
    {
        // Requete d'ecriture d'une adresse
        $req = "INSERT INTO adresses
                    (rue, date_creation, ville_id, code_postal_id)
                VALUES
                    (:rue, :date_creation, :ville_id, :cp_id)";
        $res = M_AccesDonnees::prepare($req);
        $date = new DateTime();
        M_AccesDonnees::bindParam($res, ':rue', $rue, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':date_creation', $date->getTimestamp(), PDO::PARAM_INT);
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
    public static function trouveAdresse(String $rue, int $ville_id, int $cp_id): array | false
    {
        $req = "SELECT DISTINCT
                    *
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
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}
