<?php

/**
 * Affiche une liste d'erreur
 * @param array $msgErreurs
 */
function afficheErreurs(array $msgErreurs)
{
    $message = '<div class="erreur"><ul>';
    foreach ($msgErreurs as $erreur) {
        $message .
            "?>
        <li><?php echo $erreur ?></li>
<?php";
    }
    $message . '</ul></div>';
    return $message;
}

/**
 * Affiche un message bleu
 * @param string $msg
 */
function afficheMessage(string $msg)
{
    return '<div class="message">' . $msg . '</div>';
}
