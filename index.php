<?php
session_start();
// $_SESSION["produits"] = [];
// $_SESSION["id"] = [];
// var_dump($_SESSION);
// unset($_SESSION["id"]);
// var_dump($_POST);
// echo '<br/>';

// $date = new DateTime();
// var_dump(date("Y-m-d"));
// var_dump($date->add(DateInterval::createFromDateString('3 days'))->format("Y-m-d H:i:s"));

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
            $mail = trim(filter_input(INPUT_POST, 'mail_connexion'));
            $password = filter_input(INPUT_POST, 'password_connexion');
            break;
        case "S'inscrire":
            $nom =  trim(strtolower(filter_input(INPUT_POST, 'nom')));
            $prenom = trim(strtolower(filter_input(INPUT_POST, 'prenom')));
            $rue = trim(filter_input(INPUT_POST, 'rue'));
            $ville = trim(strtolower(filter_input(INPUT_POST, 'ville')));
            $cp = trim(filter_input(INPUT_POST, 'cp'));
            $mail = trim(filter_input(INPUT_POST, 'mail'));
            $password = filter_input(INPUT_POST, 'password');
            $password_verify = filter_input(INPUT_POST, 'password_verify');
            $phone = preg_replace('/\s+/', '', filter_input(INPUT_POST, 'phone'));
            break;
            // case "Valider l'adresse":
            //     $nom = filter_input(INPUT_POST, 'nom');
            //     $adresse = filter_input(INPUT_POST, 'adresse');
            //     $ville = filter_input(INPUT_POST, 'ville');
            //     $cp = filter_input(INPUT_POST, 'cp');
            //     break;
            // case "Valider l'adresse de livraison":
            //     $adresse_id = filter_input(INPUT_POST, 'adresse_id');
            //     break;
        case "modifierInfos":
            $nom =  trim(strtolower(filter_input(INPUT_POST, 'nom')));
            $prenom = trim(strtolower(filter_input(INPUT_POST, 'prenom')));
            $rue = trim(filter_input(INPUT_POST, 'rue'));
            $ville = trim(strtolower(filter_input(INPUT_POST, 'ville')));
            $cp = trim(filter_input(INPUT_POST, 'cp'));
            $mail = trim(filter_input(INPUT_POST, 'mail'));
            $password = filter_input(INPUT_POST, 'password');
            $password_verify = filter_input(INPUT_POST, 'password_verify');
            $phone = preg_replace('/\s+/', '', filter_input(INPUT_POST, 'phone'));
            break;
        case "confirmerCommande":
            $date_livraison = filter_input(INPUT_POST, "date-livraison");
            $quantites_ventes = [];
            foreach ($_POST as $input_name => $quantite_vente) {
                $quantite_input = trim(filter_input(INPUT_POST, $input_name));
                if ($quantite_input > 0 and estEntier($quantite_input)) {
                    $quantites_ventes[] =  $quantite_input;
                } else {
                    $quantites_ventes = [];
                    break;
                }
            }
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
        $controleur = new C_Consultation;
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
    case 'produit':
        $controleur = new C_Consultation;
        $produit = $controleur->trouveLeProduit($idProduit);
        $produitDispo = $controleur->produitEstDisponible($idProduit);
        if (!$produitDispo) {
            $message = afficheMessage("Désolé, ce produit est en rupture de stock.");
        }
        break;
    case 'panier':
        $controleur_panier = new C_GestionPanier;
        $controleur_client = new C_Client;
        $controleur_consultation = new C_Consultation;
        if ($action == 'supprimerUnProduit') {
            $controleur_panier->supprimerUnProduit($session, $idProduit);
        }
        $desIdProduit = $session->getLesIdProduitsDuPanier();
        $lesProduitsDuPanier = $controleur_panier->voirPanier($session, $desIdProduit);
        if ($session->getIdClient() == false) {
            $uc = "";
            $message =
                count($lesProduitsDuPanier) > 0
                ? afficheMessage("Votre panier contient des articles.<br/><br/>Connectez-vous pour poursuivre votre commande.<br/><br/><a class='primary-btn' href='index.php?uc=connexion'>Connexion</a>")
                : afficheMessage("Connectez-vous pour passer commande.<br/><br/>Votre panier est vide.<br/><br/>Venez visiter notre boutique !<br/><br/><a class='primary-btn' href='index.php?uc=boutique'>Boutique</a>");
        } else {
            $infosClient = $controleur_client->infosClient($session);
            $uc = count($lesProduitsDuPanier) > 0 ? $uc : $message = afficheMessage("Votre panier est vide.<br/><br/>Venez visiter notre boutique !<br/><br/><a class='primary-btn' href='index.php?uc=boutique'>Boutique</a>");
        }
        break;
    case 'commander':
        $controleur_client = new C_Client;
        $infosClient = $controleur_client->infosClient($session);
        $controleur_commande = new C_Commande;
        if ($action == 'confirmerCommande' and $infosClient["est_livrable"] and !empty($quantites_ventes)) {
            $message = $controleur_commande->confirmerCommande($session, $quantites_ventes);
        } else if (!$infosClient["est_livrable"]) {
            $message = afficheMessage("Commande non valide, votre ville n'est pas encore desservie.");
        } else {
            $message = afficheMessage("Commande non valide, la quantité entrée doit être un nombre entier positif.");
        }
        $infosClient = $controleur_client->infosClient($session);
        $commandes = $controleur_client->listeLesCommandes($session);
        $produitsParCommandes = $controleur_client->listeLesProduitsParCommandes($commandes);
        $uc = "espaceClient";
        break;
    case 'espaceClient':
        $controleur = new C_Client;
        if ($action == 'deconnexion') {
            session_destroy();
            header('Location: index.php?uc=accueil');
            exit();
        } else if ($action == 'modifierInfos') {
            $erreursSaisie = infosValide($nom, $prenom, $rue, $ville, $cp, $mail, $password, $password_verify, $phone);
            if (empty($erreursSaisie) and $session->getIdClient() != false) {
                $id_client = $session->getIdClient();
                $controleur->modifInfos(
                    $nom,
                    $prenom,
                    $rue,
                    $ville,
                    $cp,
                    $mail,
                    $password,
                    $password_verify,
                    $phone,
                    $id_client,
                );
                $message = afficheMessage("Vos informations ont bien été enregistrées");
            } else {
                $message = afficheMessage($erreursSaisie);
                $uc = "modifierInfos";
            }
        }
        $infosClient = $controleur->infosClient($session);
        $commandes = $controleur->listeLesCommandes($session);
        $produitsParCommandes = $controleur->listeLesProduitsParCommandes($commandes);
        break;
    case 'connexion':
        $controleur = new C_Client;
        if ($action == 'inscription') {
            $erreursSaisie = infosValide($nom, $prenom, $rue, $ville, $cp, $mail, $password, $password_verify, $phone);
            if (empty($erreursSaisie)) {
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
                } else {
                    $message = afficheMessage("Cette adresse mail est déjà utilisé");
                }
            } else {
                $message = afficheMessage($erreursSaisie);
            }
        } else if ($action == 'connexion') {
            if (!estUnMail($mail)) {
                $message = afficheMessage("Mail non valide. Format demandé : exemple@domaine.com");
            } else if (!$session->verifMotDePasse($mail, $password)) {
                $message = afficheMessage('Mot de passe ou mail inconnu. Réessayez');
            } else {
                header('Location: index.php?uc=espaceClient');
                exit();
            }
        }
        break;
    case 'aPropos':
        break;
    case 'modifierInfos':
        break;
    default:
        header('Location: index.php?uc=accueil');
        exit();
        break;
}

require("app/views/template.php");
