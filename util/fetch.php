<?php
session_start();

require '../app/model/M_AccesDonnees.php';
require '../app/model/M_Produit.php';
require '../app/controller/C_Consultation.php';
require '../app/controller/C_Session.php';

$session = new C_Session;
// récupération des données JSON envoyées
$request_data = json_decode(file_get_contents('php://input'));

// vérification de l'action demandée
if ($request_data->action === 'get_data') {
    $controleur = new C_Consultation();
    $idProduit = $request_data->parameter1;
    $produitDispo = $controleur->produitEstDisponible($idProduit);

    if ($produitDispo) {
        // appel de la fonction get_data avec les paramètres fournis
        $data = $controleur->ajouterAuPanier($session, $idProduit);;
        // retourner les données encodées en JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // retourner les données encodées en JSON
        header('Content-Type: application/json');
        echo json_encode("Désolé ce produit est en rupture de stock.");
    }
}
