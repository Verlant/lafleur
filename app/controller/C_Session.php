<?php
// require 'App/modele/M_Client.php';
class C_Session
{
    /**
     * Fonction qui vérifie si le mdp est bon lors de la connexion en fonction du mail
     * Retourne l'id de l'utilisateur en cas de réussite
     * Retourne false en cas d'échec
     * @return int|bool
     */
    public function verifMotDePasse(String $mail, String $mdp): int
    {
        $data = M_Client::getInfoClientPourSession($mail);
        $mdp_bdd = $data['motDePasse'];
        if (password_verify($mdp, $mdp_bdd) and estEntier($data['id'])) {
            $_SESSION['id'] = $data['id'];
            $_SESSION['pseudo'] = $data['pseudoClient'];
        } else {
            $data['id'] = false;
        }
        return $data['id'];
    }

    /**
     * Fonction qui renvoie l'id de l'utilisateur connecté via la session
     * Retourne false en cas d'échec
     * @return int|bool
     */
    public static function getIdClient(): int | false
    {
        if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
            return $_SESSION['id'];
        } else {
            return false;
        }
    }

    /**
     * Initialise le panier
     *
     * Crée une variable de type session dans le cas
     * où elle n'existe pas
     * @return void
     */
    public function initPanier(): void
    {
        if (!isset($_SESSION['produits'])) {
            $_SESSION['produits'] = array();
        }
    }

    /**
     * Supprime le panier
     * Supprime la variable de type session
     * @return void
     */
    public function supprimerPanier(): void
    {
        unset($_SESSION['produits']);
    }

    /**
     * Ajoute un produit au panier
     *
     * Teste si l'identifiant du produit est déjà dans la variable session 
     * ajoute l'identifiant à la variable de type session dans le cas
     * où l'identifiant du produit n'a pas été trouvé
     * @param $idproduit : identifiant de produit
     * @return vrai si le produit n'était pas dans la variable, faux sinon 
     */
    public function ajouterProduitSession($idProduit)
    {
        $ok = false;
        if (!in_array($idProduit, $_SESSION['produits'])) {
            $_SESSION['produits'][] = $idProduit;
            $ok = true;
        }
        return $ok;
    }

    /**
     * Retourne les produits du panier
     *
     * Retourne le tableau des identifiants de produit
     * @return : le tableau
     */
    public function getLesIdProduitsDuPanier()
    {
        return $_SESSION['produits'];
    }

    /**
     * Retourne le nombre de produits du panier
     *
     * Teste si la variable de session existe
     * et retourne le nombre d'éléments de la variable session
     * @return : le nombre 
     */
    public function nbProduitsDuPanier()
    {
        $n = 0;
        if (isset($_SESSION['produits'])) {
            $n = count($_SESSION['produits']);
        }
        return $n;
    }

    /**
     * Retire un produits du panier
     *
     * Recherche l'index de l'idProduit dans la variable session
     * et détruit la valeur à ce rang
     * @param $idProduit : identifiant de produit
     * @return void
     */
    public function retirerDuPanier($idProduit): void
    {
        $index = array_search($idProduit, $_SESSION['produits']);
        unset($_SESSION['produits'][$index]);
    }
}
