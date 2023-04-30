<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Fleur</title>
    <link rel="stylesheet" href="public/css/main.css">
    <link href="https://fonts.cdnfonts.com/css/agile-jewelry-personal-use" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/heldane-text" rel="stylesheet">
</head>

<body>
    <header>
        <nav id="header-nav">
            <ul>
                <li>
                    <a class="header-link" href="index.php?uc=boutique">Boutique</a>
                </li>
                <li>
                    <a class="header-link" href="index.php?uc=aPropos">A propos</a>
                </li>
                <li>
                    <a href="index.php?uc=accueil">
                        <img class="header-logo" src="public/img/logo-la-fleur.svg" alt="logo lafleur" />
                    </a>
                </li>
                <?php if ($session->getIdClient()) : ?>
                    <li><a class="header-link" href="index.php?uc=espaceClient">Espace client</a></li>
                <?php else : ?>
                    <a class="header-link" href="index.php?uc=connexion">Connexion</a>
                <?php endif; ?>
                <li>
                    <a class="header-link" href="index.php?uc=panier">Panier</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <?php
        // Controleur de vues
        // Selon le cas d'utilisation, j'inclus un controleur ou simplement une vue
        if (isset($message) and !empty($message)) {
            echo $message;
        }
        switch ($uc) {
            case 'accueil':
                include 'app/views/v_accueil.php';
                break;
            case 'boutique':
                include "app/views/v_boutique.php";
                break;
            case 'aPropos':
                include "app/views/v_aPropos.php";
                break;
            case 'espaceClient':
                include "app/views/v_espaceClient.php";
                break;
            case 'connexion':
                include "app/views/v_connexion.php";
                break;
            case 'panier':
                include "app/views/v_panier.php";
                break;
            case 'modifInfos':
                include "app/views/v_modifInfos.php";
                break;
            case 'boutique':
                include "app/views/v_boutique.php";
                break;
            default:
                break;
        }
        ?>
    </main>

    <footer id="footer-nav">
        <ul>
            <li class="footer-link-container">
                <a class="footer-link" href="index.php?uc=blog">Blog</a>
                <a class="footer-link" href="index.php?uc=boutique">Boutique</a>
            </li>
            <li>
                <a href="index.php?uc=accueil">
                    <img class="footer-logo-lafleur" src="public/img/logo-la-fleur.svg" alt="logo lafleur" />
                </a>
            </li>
            <li>
                <ul class="footer-contact">
                    <li>Contactez nous !</li>
                    <li class="logo-container">
                        <a href="https://twitter.com/?lang=fr" target="_blank">
                            <img class="logo" src="public/img/twitter.svg" alt="logo twitter" />
                        </a>
                        <a href="https://www.facebook.com/" target="_blank">
                            <img class="logo" src="public/img/facebook.svg" alt="logo facebook" />
                        </a>
                    </li>
                    <li>lafleur@domaine.com</li>
                    <li>06 01 02 03 04</li>
                </ul>
            </li>
        </ul>
    </footer>
    <script src="public/js/main.js"></script>
</body>

</html>