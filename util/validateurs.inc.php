<?php

/*
 * Fonctions de validations
 */

/**
 * teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 * @param String $codePostal : la chaîne testée
 * @return : vrai ou faux
 */
function estUnCp(String $codePostal)
{
    return strlen($codePostal) == 5 && estEntier($codePostal) && $codePostal != "00000";
}

/**
 * teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 * @param String $valeur : la chaîne testée
 * @return : vrai ou faux
 */
function estEntier(String $valeur)
{
    return preg_match("/[^0-9]/", $valeur) == 0;
}

/**
 * Teste si une chaîne a le format d'un mail
 *
 * Utilise les expressions régulières
 * @param String $mail : la chaîne testée
 * @return : vrai ou faux
 */
function estUnMail(String $mail)
{
    return preg_match("#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#", $mail) == 1;
}

/**
 * teste si une chaîne a un format de téléphone français
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 * @param String $phone : la chaîne testée
 * @return : vrai ou faux
 */
function estUnTel(String $phone)
{
    return strlen($phone) == 10 && estEntier($phone) && $phone != "0000000000";
}

/**
 * Retourne vrai si pas d'erreur
 * Retourne un tableau contenant des messages pour chaque erreur rencontrées
 * @param String $nom : chaîne
 * @param String $prenom : chaîne
 * @param String $rue : chaîne
 * @param String $ville : chaîne
 * @param String $cp : chaîne
 * @param String $mail : chaîne
 * @param String $password : chaîne
 * @param String $password_verify : chaîne
 * @param String $phone : chaîne
 * @return String : string
 */
function infosValide(String $nom, String $prenom, String $rue, String $ville, String $cp, String $mail, String $password, String $password_verify, String $phone): String
{
    $erreurs = "";
    if ($nom == "") {
        $erreurs = $erreurs . "Il faut saisir le champ Nom.<br/>";
    } else if (strlen($nom) > 190) {
        $erreurs = $erreurs . "Le champ Nom ne peut contenir que 190 caractères.<br/>";
    }
    if ($prenom == "") {
        $erreurs = $erreurs . "Il faut saisir le champ Prénom.<br/>";
    } else if (strlen($prenom) > 50) {
        $erreurs = $erreurs . "Le champ Prénom ne peut contenir que 50 caractères.<br/>";
    }
    if ($rue == "") {
        $erreurs = $erreurs . "Il faut saisir le champ Rue.<br/>";
    } else if (strlen($rue) > 190) {
        $erreurs = $erreurs . "Le champ Rue ne peut contenir que 190 caractères.<br/>";
    }
    if ($ville == "") {
        $erreurs = $erreurs . "Il faut saisir le champ Ville.<br/>";
    } else if (strlen($ville) > 190) {
        $erreurs = $erreurs . "Le champ Ville ne peut contenir que 190 caractères.<br/>";
    }
    if ($cp == "") {
        $erreurs = $erreurs . "Il faut saisir le champ Code postal.<br/>";
    } else if (!estUnCp($cp)) {
        $erreurs = $erreurs . "Erreur de code postal. Format attendu : \"34000\".<br/>";
    }
    if ($mail == "") {
        $erreurs = $erreurs . "Il faut saisir le champ Email.<br/>";
    } else if (!estUnMail($mail)) {
        $erreurs = $erreurs . "Erreur de mail. Format attendu : \"exemple@domaine.com\".<br/>";
    } else if (strlen($mail) > 190) {
        $erreurs = $erreurs . "Le champ Email ne peut contenir que 190 caractères.<br/>";
    }
    if ($password == "") {
        $erreurs = $erreurs . "Il faut saisir le champ Mot de passe.<br/>";
    }
    if ($password != $password_verify) {
        $erreurs = $erreurs . "Les mots de passe ne correspondent pas.<br/>";
    }
    if ($phone == "") {
        $erreurs = $erreurs . "Il faut saisir le champ Téléphone.<br/>";
    } else if (!estUnTel($phone)) {
        $erreurs = $erreurs . "Erreur de téléphone. Format attendu : \"0615273849\".<br/>";
    }
    return $erreurs;
}

/**
 * Retourne vrai si pas d'erreur
 * Retourne un tableau contenant des messages pour chaque erreur rencontrées
 * @param String $nom : chaîne
 * @param String $prenom : chaîne
 * @param String $rue : chaîne
 * @param String $ville : chaîne
 * @param String $cp : chaîne
 * @param String $mail : chaîne
 * @param String $password : chaîne
 * @param String $password_verify : chaîne
 * @param String $phone : chaîne
 * @return String : string
 */
function infosModifValide(
    String $nom,
    String $prenom,
    String $rue,
    String $ville,
    String $cp,
    String $mail,
    String $password,
    String $password_verify,
    String $phone
): String {
    $erreurs = "";
    if (strlen($nom) > 190) {
        $erreurs = $erreurs . "Le champ Nom ne peut contenir que 190 caractères.<br/>";
    }
    if (strlen($prenom) > 50) {
        $erreurs = $erreurs . "Le champ Prénom ne peut contenir que 50 caractères.<br/>";
    }
    if (strlen($rue) > 190) {
        $erreurs = $erreurs . "Le champ Rue ne peut contenir que 190 caractères.<br/>";
    }
    if (strlen($ville) > 190) {
        $erreurs = $erreurs . "Le champ Ville ne peut contenir que 190 caractères.<br/>";
    }
    if (!empty($cp) and !estUnCp($cp)) {
        $erreurs = $erreurs . "Erreur de code postal. Format attendu : \"34000\".<br/>";
    }
    if (!empty($mail) and !estUnMail($mail)) {
        $erreurs = $erreurs . "Erreur de mail. Format attendu : \"exemple@domaine.com\".<br/>";
    } else if (strlen($mail) > 190) {
        $erreurs = $erreurs . "Le champ Email ne peut contenir que 190 caractères.<br/>";
    }
    if ($password != $password_verify) {
        $erreurs = $erreurs . "Les mots de passe ne correspondent pas.<br/>";
    }
    if (!empty($phone) and !estUnTel($phone)) {
        $erreurs = $erreurs . "Erreur de téléphone. Format attendu : \"0615273849\".<br/>";
    }
    return $erreurs;
}
