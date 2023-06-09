<?php

/**
 * Classe d'accès aux données.

 * Utilise les services de la classe PDO
 * pour l'application LaFleur
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO
 * $monPdoGsb qui contiendra l'unique instance de la classe
 *
 * @package default
 * @author Antoine VERLYCK
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */
class M_AccesDonnees
{

    private static String $serveur = 'mysql:host=localhost';
    private static String $bdd = 'dbname=c86verlyck';
    private static String $user = 'c86verlyck';
    private static String $mdp = 'cnt_uHSU3';

    /**
     *
     * @var PDO
     */
    private static $monPdo;

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * retourne l'unique objet de la classe
     * @return PDO
     */
    public static function getPdo()
    {
        if (M_AccesDonnees::$monPdo == null) {
            M_AccesDonnees::$monPdo = new PDO(
                M_AccesDonnees::$serveur . ';' . M_AccesDonnees::$bdd,
                M_AccesDonnees::$user,
                M_AccesDonnees::$mdp
            );
            M_AccesDonnees::$monPdo->query("SET CHARACTER SET utf8");
        }
        return M_AccesDonnees::$monPdo;
    }

    /**
     * Préparation d'une requete de lecture
     * @param string $requete_sql
     * @return PDOStatement
     */
    public static function prepare(String $requete_sql)
    {
        return M_AccesDonnees::getPdo()->prepare($requete_sql);
    }

    /**
     * @param PDOStatement $statement
     * @param String $marque
     * @param mixed $valeur
     * @param int $pdo_param
     * @return void
     */
    public static function bindParam(
        PDOStatement $statement,
        String $marque,
        $valeur,
        int $pdo_param
    ) {
        $statement->bindParam($marque, $valeur, $pdo_param);
    }

    /**
     * Execute une requete préparé
     * @return void
     */
    public static function execute(PDOStatement $statement)
    {
        $statement->execute();
    }

    /**
     * Récupère l'id du dernier insert
     * @return int|false
     */
    public static function lastInsertId()
    {
        return M_AccesDonnees::getPdo()->lastInsertId();
    }

    /**
     * Lance une transaction PDO
     * @return void
     */
    public static function beginTransaction()
    {
        M_AccesDonnees::getPdo()->beginTransaction();
    }

    /**
     * Execute un commit
     * @return void
     */
    public static function commit()
    {
        M_AccesDonnees::getPdo()->commit();
    }
}
