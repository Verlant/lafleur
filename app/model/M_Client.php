<?php

class M_Client
{
    /** 
     * Effectue la requete d'insertion des données d'un client dans la bdd
     * @param String $mail
     * @param String $pseudo
     * @param String $mdp
     * @param String $nomPrenom
     * @return int
     */
    public static function creerCompteClient(
        String $nom,
        String $prenom,
        String $mail,
        String $password_client,
        String $phone,
        int $adresse_id
    ): int {
        $req = "INSERT INTO clients (nom_client, prenom_client, email, mdp, tel, adresse_id)
                VALUES (:nom, :prenom, :mail, :password_client, :phone, :adresse_id)";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':nom', $nom, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':prenom', $prenom, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':mail', $mail, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':password_client', $password_client, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':phone', $phone, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':adresse_id', $adresse_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        return M_AccesDonnees::lastInsertId();
    }

    /**
     * Modifie les infos du client dans la bdd
     */
    public static function modifInfos(
        String $nom,
        String $prenom,
        String $mail,
        String $phone,
        int $adresse_id,
        int $id_client
    ): void {
        $date = new DateTime();
        $now =  $date->format('Y-m-d H:i:s');
        $req = "UPDATE clients
                SET nom_client = :nom,
                    prenom_client = :prenom,
                    email = :mail,
                    tel = :phone,
                    date_modif = :date_modif,
                    adresse_id = :adresse_id
                WHERE id = $id_client";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':nom', $nom, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':prenom', $prenom, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':mail', $mail, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':phone', $phone, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':date_modif', $now, PDO::PARAM_STR);
        M_AccesDonnees::bindParam($res, ':adresse_id', $adresse_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
    }


    /**
     * Effectue une requete de lecture en fonction de l'adresse mail d'un client afin de récupérer son id pseudo et mdp
     * Utilisé uniquement par le controleur de session lors de la connexion d'un utilisateur au site
     * renvoie false en cas d'erreur
     * @param String $mail
     * @return Array|false
     */
    public static function getInfoClientParMail(String $mail): array | false
    {
        $req = "SELECT id, mdp FROM clients WHERE email = :mail";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':mail', $mail, PDO::PARAM_STR);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Effectue une requete de lecture a la bdd afin de renvoyer les infos d'un client en fonction de son id
     * Renvoie false en cas d'erreur
     * @param int $id
     * @return Array|false
     */
    public static function getInfosClientParId(int $id): array | false
    {
        $req = "SELECT
                    nom_client, prenom_client, email, tel, rue, nom_ville, cp, est_livrable
                FROM
                    clients
                JOIN
                    adresses
                ON
                    adresse_id = adresses.id
                JOIN
                    villes
                ON
                    ville_id = villes.id
                JOIN
                    codes_postaux
                ON
                    code_postal_id = codes_postaux.id
                WHERE clients.id = :id";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ':id', $id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
