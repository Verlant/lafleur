<?php

/**
 * Controleur client gérant toutes les intérractions d'un utilisateur avec son compte client
 */
class C_Client
{
    /**
     * Appelle le modele pour inscrire un nouveau client dans la bdd
     * en fonction des données rentré dans le formulaire d'inscription
     * @param String $nom
     * @param String $prenom
     * @param String $rue
     * @param String $nomPrenom
     * @return bool
     */
    public function inscription(
        String $nom,
        String $prenom,
        String $rue,
        String $ville,
        String $cp,
        String $mail,
        String $password,
        String $password_verify,
        String $phone
    ): bool {
        if ($password != $password_verify || M_Client::getInfoClientParMail($mail) != false) {
            return false;
        } else {
            // Démarre une transaction
            M_AccesDonnees::beginTransaction();

            // Vérifie si la ville existe deja dans la bdd
            // Si oui ne l'ajoute pas et récupère son id
            // Si non l'ajoute dans la bdd
            if (M_Ville::trouveLaVille($ville) == false) {
                $livrable = 0;
                $ville_id = M_Ville::creerVille($ville, $livrable);
            } else {
                $ville_id = M_Ville::trouveLaVille($ville)['id'];
            }

            // Vérifie si le code postal existe deja dans la bdd
            // Si oui ne l'ajoute pas et récupère son id
            // Si non l'ajoute dans la bdd
            if (M_CodePostal::trouveLeCodePostal($cp) == false) {
                $cp_id = M_CodePostal::creerCodePostal($cp);
            } else {
                $cp_id = M_CodePostal::trouveLeCodePostal($cp)['id'];
            }

            // Vérifie si l'adresse existe deja dans la bdd
            // Si oui ne l'ajoute pas et récupère son id
            // Si non l'ajoute dans la bdd
            if (M_Adresse::trouveAdresse($rue, $ville_id, $cp_id) == false) {
                $adresse_id = M_Adresse::creerAdresse($rue, $ville_id, $cp_id);
            } else {
                $adresse_id = M_Adresse::trouveAdresse($rue, $ville_id, $cp_id)['id'];
            }
            $password = password_hash($password, PASSWORD_BCRYPT);
            M_Client::creerCompteClient(
                $nom,
                $prenom,
                $mail,
                $password,
                $phone,
                $adresse_id
            );

            // Commit la transaction
            M_AccesDonnees::commit();
            return true;
        }
    }

    /**
     * Appelle le modele pour modifier les infos client dans la bdd
     * en fonction des données rentré dans le formulaire d'inscription
     * @param String $nom
     * @param String $prenom
     * @param String $rue
     * @param String $ville
     * @return bool
     */
    public function modifInfos(
        String $nom,
        String $prenom,
        String $rue,
        String $ville,
        String $cp,
        String $mail,
        String $phone,
        int $id_client
    ): bool {
        // Démarre une transaction
        M_AccesDonnees::beginTransaction();

        // Vérifie si la ville existe deja dans la bdd
        // Si oui ne l'ajoute pas et récupère son id
        // Si non l'ajoute dans la bdd
        if (M_Ville::trouveLaVille($ville) == false) {
            $livrable = 0;
            $ville_id = M_Ville::creerVille($ville, $livrable);
        } else {
            $ville_id = M_Ville::trouveLaVille($ville)['id'];
        }

        // Vérifie si le code postal existe deja dans la bdd
        // Si oui ne l'ajoute pas et récupère son id
        // Si non l'ajoute dans la bdd
        if (M_CodePostal::trouveLeCodePostal($cp) == false) {
            $cp_id = M_CodePostal::creerCodePostal($cp);
        } else {
            $cp_id = M_CodePostal::trouveLeCodePostal($cp)['id'];
        }

        // Vérifie si l'adresse existe deja dans la bdd
        // Si oui ne l'ajoute pas et récupère son id
        // Si non l'ajoute dans la bdd
        if (M_Adresse::trouveAdresse($rue, $ville_id, $cp_id) == false) {
            $adresse_id = M_Adresse::creerAdresse($rue, $ville_id, $cp_id);
        } else {
            $adresse_id = M_Adresse::trouveAdresse($rue, $ville_id, $cp_id)['id'];
        }
        M_Client::modifInfos(
            $nom,
            $prenom,
            $mail,
            $phone,
            $adresse_id,
            $id_client
        );

        // Commit la transaction
        M_AccesDonnees::commit();
        return true;
    }


    /**
     * Appelle le modele pour retourner les informations d'un client
     * Retourne un tableau associatif contenant les données
     * Retourne false si la requete a échoué
     * @param C_Session $session
     * @return Array|false
     */
    public function infosClient(C_Session $session): array | false
    {
        return M_Client::getInfosClientParId($session::getIdClient());
    }

    /**
     * Renvoie la liste des commandes passé par le cient
     * Retourne false si une erreur est rencontré lors de la requete SQL par le modele
     * @param C_Session $session
     * @return Array|false
     */
    public function listeLesCommandes(C_Session $session): array | false
    {
        return M_Commande::listeDesCommandes($session->getIdClient());
    }

    /**
     * Récupère un tableau contenant la liste des commandes et le traite pour
     * renvoyer un tableau associatif contenant la liste des produits par commande.
     * Renvoie false si une erreur est rencontré
     * @param Array|false $commandes
     * @return Array|false
     */
    public function listeLesProduitsParCommandes(array | false $commandes): array | false
    {
        if ($commandes == false) {
            return false;
        }
        foreach ($commandes as $commande) {
            $produitsParCommande[$commande["id"]] = M_Commande::trouveLesProduitsParCommande($commande["id"]);
        }
        return $produitsParCommande;
    }
}
