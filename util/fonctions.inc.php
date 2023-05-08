<?php

/**
 * Affiche une liste d'erreur
 * @param String $msgErreurs
 */
function afficheErreur(String $msgErreurs): String
{
    return '<p class="message error">' . $msgErreurs . '</p>';
}

/**
 * Affiche un message bleu
 * @param String $msg
 */
function afficheMessage(String $msg): String
{
    return '<p class="message validation">' . $msg . '</p>';
}
