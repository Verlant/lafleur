<?php

session_start();
// var_dump($_SESSION);

// Pour afficher les erreurs PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Attention : A supprimer en production !!!

require 'util/autoLoad.php';
require 'util/fonctions.inc.php';
require 'util/validateurs.inc.php';
autoLoad();

$session = new C_Session;

$uc = filter_input(INPUT_GET, 'uc'); // Use Case
$action = filter_input(INPUT_GET, 'action'); // Action
$categorie = filter_input(INPUT_GET, 'categorie'); // ID de categorie
$couleur = filter_input(INPUT_GET, 'couleur'); // ID de couleur
$idProduit = filter_input(INPUT_GET, 'produit'); // ID de produit

$session->initPanier();

$formulaireRecu = filter_input(INPUT_POST, "valider");
if (isset($formulaireRecu)) {
    switch ($formulaireRecu) {
        case "Connexion":
            $mail = filter_input(INPUT_POST, 'mail_connexion');
            $password = filter_input(INPUT_POST, 'password_connexion');
            break;
        case "S'inscrire":
            $nom = filter_input(INPUT_POST, 'nom');
            $prenom = filter_input(INPUT_POST, 'prenom');
            $rue = filter_input(INPUT_POST, 'rue');
            $ville = filter_input(INPUT_POST, 'ville');
            $cp = filter_input(INPUT_POST, 'cp');
            $mail = filter_input(INPUT_POST, 'mail');
            $password = filter_input(INPUT_POST, 'password');
            $password_verify = filter_input(INPUT_POST, 'password_verify');
            $phone = filter_input(INPUT_POST, 'phone');
            break;
        case "Valider l'adresse":
            $nom = filter_input(INPUT_POST, 'nom');
            $adresse = filter_input(INPUT_POST, 'adresse');
            $ville = filter_input(INPUT_POST, 'ville');
            $codePostal = filter_input(INPUT_POST, 'codePostal');
            break;
        case "Valider l'adresse de livraison":
            $adresse_id = filter_input(INPUT_POST, 'adresse_id');
            break;
        default:
            break;
    }
}

if (!isset($uc) or empty($uc)) {
    $uc = 'accueil';
}
if (!isset($categorie) or empty($categorie)) {
    $categorie = 0;
}
if (!isset($couleur) or empty($couleur)) {
    $couleur = 0;
}
if (!isset($idProduit) or empty($idProduit)) {
    $idProduit = 0;
}
if (!isset($produitPanier) or empty($produitPanier)) {
    $produitPanier = 0;
}

// Controleur principal
switch ($uc) {
    case 'accueil':
        $controleur = new C_Consultation();
        $lesProduits = $controleur->derniersProduitsSortis();
        break;
    case 'boutique':
        $controleur = new C_Consultation();
        if ($action == 'voirCategorie') {
            $lesProduits = $controleur->trouveLesProduitsDeCategorie($categorie);
        } elseif ($action == 'voirCouleur') {
            $lesProduits = $controleur->trouveLesProduitsDeCouleur($couleur);
        } else {
            $lesProduits = $controleur->tousLesProduits();
        }
        $lesCategories = $controleur->toutesLesCategories();
        $lesCouleurs = $controleur->toutesLesCouleurs();
        break;
    case 'panier':
        $controleur = new C_GestionPanier();
        if ($action == 'supprimerUnProduit') {
            $controleur->supprimerUnProduit($session, $idProduit);
        }
        $desIdProduit = $session->getLesIdProduitsDuPanier();
        $lesProduitsDuPanier = $controleur->voirPanier($session, $desIdProduit);
        $uc = count($lesProduitsDuPanier) > 0 ? $uc : "";
        break;
    case 'commander':
        // $controleur_client = new C_Client;
        // $controleur_commande = new C_Commande;
        // if ($action == 'confirmerCommande') {
        //     $uc = $controleur_commande->confirmerCommande($session, $adresse_id);
        // } else {
        //     $uc = $controleur_commande->passerCommande($session, $uc);
        //     $adressesClient = $controleur_client->adressesClient($session);
        // }
        // $infosClient = $controleur_client->infosClient($session);
        // $adressesClient = $controleur_client->adressesClient($session);
        // break;
    case 'aPropos':
        //TODO
        break;
    case 'espaceClient':
        $controleur = new C_Client;
        if ($action == 'deconnexion') {
            session_destroy();
            header('Location: index.php?uc=accueil&action=derniersProduitxSortis');
            exit();
        } else if ($action == 'modifierAdresse') {
            $erreursSaisieAdresse = $controleur->adresseEstValide($nom, $adresse, $ville, $codePostal);
            if (empty($erreursSaisieAdresse) and $codePostal != "00000") {
                $controleur->modifAdresse($adresse,  $nom,  $ville,  $codePostal, $session);
            } else if ($codePostal == "00000") {
                afficheErreurs(["Le code postal 00000 n'existe pas."]);
            } else {
                afficheErreurs($erreursSaisieAdresse);
            }
        }
        $infosClient = $controleur->infosClient($session);
        // $commandes = $controleur->listeLesCommandes($session);
        // $produitxParCommandes = $controleur->listeLesProduitsParCommandes($commandes);
        break;
    case 'connexion':
        $controleur = new C_Client();
        if (isset($mail) and isset($password)) {
            if ($action == 'inscription' and estUnMail($mail)) {
                if ($controleur->inscription(
                    $nom,
                    $prenom,
                    $rue,
                    $ville,
                    $cp,
                    $mail,
                    $password,
                    $password_verify,
                    $phone
                )) {
                    $message = afficheMessage('Votre compte a bien été créé.');
                }
            } else if ($action == 'connexion' and estUnMail($mail) and $session->verifMotDePasse($mail, $password)) {
                header('Location: index.php?uc=espaceClient');
                exit();
            } else if (!estUnMail($mail)) {
                $message = afficheErreurs(["Mail non valide.", "Format demandé : exemple@domaine.com"]);
            } else if (!$session->verifMotDePasse($mail, $password)) {
                afficheErreurs(['Mot de passe ou mail inconnu.', 'Réessayez']);
            }
        }
        break;
    default:
        header('Location: index.php');
        exit();
        break;
}

require("app/views/template.php");
