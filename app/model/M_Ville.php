<?php

class M_Ville
{

    /**
     * Effectue une requete d'insertion pour ajouter une ville dans la bdd
     * Renvoie l'id de la ville ajouté en cas de succès
     * Renvoie false en cas d'echec
     * @param String $ville
     * @param bool $livrable
     * @return int|false
     */
    public static function creerVille(String $ville, int $livrable): int | false
    {
        $req = "INSERT INTO villes (nom_ville, est_livrable) VALUES (:ville, :est_livrable)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':ville', $ville, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':est_livrable', $livrable, PDO::PARAM_BOOL);
        M_AccesDonnees::execute($res);
        if (M_AccesDonnees::lastInsertId() == 0) {
            return false;
        }
        return M_AccesDonnees::lastInsertId();
    }

    /**
     * Effectue une requete de lecture afin de renvoyer l'id d'une ville en fonction de son nom
     * Renvoie false en cas d'echec
     * @param String nom ville
     * @return Array|false
     */
    public static function trouveLaVille(String $ville): array | false
    {
        $req = "SELECT id FROM villes WHERE nom_ville = :ville";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':ville', $ville, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
