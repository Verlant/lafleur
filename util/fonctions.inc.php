<?php

/**
 * Affiche une liste d'erreur
 * @param array $msgErreurs
 */
function afficheErreurs(array $msgErreurs): String
{
    $message = '<div class="erreur"><ul>';
    foreach ($msgErreurs as $erreur) {
        $message . "<li>" . $erreur . "</li>";
    }
    $message . '</ul></div>';
    return $message;
}

/**
 * Affiche un message bleu
 * @param string $msg
 */
function afficheMessage(string $msg): String
{
    return '<p class="message">' . $msg . '</p>';
}
