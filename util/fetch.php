<?php
session_start();

require '../app/controller/C_Consultation.php';
require '../app/controller/C_Session.php';

$session = new C_Session;
// récupération des données JSON envoyées
$request_data = json_decode(file_get_contents('php://input'));

// vérification de l'action demandée
if ($request_data->action === 'get_data') {
    $controleur = new C_Consultation();
    // appel de la fonction get_data avec les paramètres fournis
    $data = $controleur->ajouterAuPanier($session, $request_data->parameter1);;
    // $data = get_data($request_data->parameter1, $request_data->parameter2);
    // retourner les données encodées en JSON
    header('Content-Type: application/json');
    echo json_encode($data);
}
