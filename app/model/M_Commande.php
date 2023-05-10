<?php

/**
 * Requetes sur les commandes
 *
 * @author Loic LOG
 */
class M_Commande
{

    /**
     * Crée une commande
     *
     * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
     * construit à partir du maximum existant ;
     * crée les lignes de commandes dans la table contenir à partir du
     * tableau d'idProduit passé en paramètre
     * @param int $client_id
     * @param Array $listeIdproduits
     * @param Array $quantites_ventes
     * @param bool $frais_livraison
     * @return void
     */
    public static function creerCommande(
        $client_id,
        $listeIdproduits,
        $quantites_ventes,
        $frais_livraison
    ): void {
        M_AccesDonnees::beginTransaction();
        $date = new DateTime();
        $req_commande = "INSERT INTO
                                commandes ( date_livraison,
                                            etat_paiement,
                                            etat_livraison,
                                            frais_livraison,
                                            client_id )
                            VALUES
                                (:date_livraison, 'W', 'W', :frais_livraison, :client_id)";
        $res = M_AccesDonnees::prepare($req_commande);
        M_AccesDonnees::bindParam(
            $res,
            ':date_livraison',
            $date->add(DateInterval::createFromDateString('1 day'))->format("Y-m-d"),
            PDO::PARAM_STR
        );
        M_AccesDonnees::bindParam($res, ':frais_livraison', $frais_livraison, PDO::PARAM_BOOL);
        M_AccesDonnees::bindParam($res, ':client_id', $client_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        $commande_id = M_AccesDonnees::lastInsertId();
        $i = 0;
        foreach ($listeIdproduits as $produit_id) {
            // Ajout d'une ligne de données dans la tbale commande_produit
            $req_commande_produit = "INSERT INTO
                                            commande_produit (commande_id, produit_id, quantite_vente)
                                        VALUES
                                            (:commande_id, :produit_id, :quantite_vente)";
            $res = M_AccesDonnees::prepare($req_commande_produit);
            M_AccesDonnees::bindParam($res, ':commande_id', $commande_id, PDO::PARAM_INT);
            M_AccesDonnees::bindParam($res, ':produit_id', $produit_id, PDO::PARAM_INT);
            M_AccesDonnees::bindParam($res, ':quantite_vente', $quantites_ventes[$i], PDO::PARAM_INT);
            M_AccesDonnees::execute($res);
            $i++;
        }
        M_AccesDonnees::commit();
    }

    /**
     * Effectue une requete de lecture afin de récupérer la liste des commandes
     * effectué par un client en fonciton de son id
     * Renvoie false en cas d'erreur
     * @param int id client
     * @return Array|false
     */
    public static function listeDesCommandes(int $client_id): array | false
    {
        $req = "SELECT id, date_commande, date_livraison, frais_livraison
                FROM commandes
                -- JOIN commande ON commande_id = commande.id  
                -- JOIN produits ON produit_id = produits.id
                WHERE commandes.client_id = :client_id
                GROUP BY commandes.id
                ORDER BY commandes.date_commande DESC";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ":client_id", $client_id, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Effectue une requete de lecture afin de récupérer la liste des produits commandé par un client
     * en fonction de leur id de commande
     * Renvoie false en cas d'erreur
     * @param int id commande
     * @return Array|false
     */
    public static function trouveLesProduitsParCommande(int $id_commande): array | false
    {
        $req = "SELECT produits.id AS produit_id, prix_vente, quantite_vente, nom_produit
                FROM commande_produit
                JOIN commandes ON commande_id = commandes.id  
                JOIN produits ON produit_id = produits.id
                WHERE commandes.id = :id_commande";
        $res = M_AccesDonnees::prepare($req);
        M_AccesDonnees::bindParam($res, ":id_commande", $id_commande, PDO::PARAM_INT);
        M_AccesDonnees::execute($res);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}
