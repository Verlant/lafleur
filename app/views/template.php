<!-- balise doctype html signifiant au navigateur
    que ce document est de type HTML -->
<!DOCTYPE html>
<!-- balise html marquant la racine du document
    attribut lang définissant la langue de base du site -->
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'
        https://fonts.cdnfonts.com/css/agile-jewelry-personal-use
        https://fonts.cdnfonts.com/css/heldane-text
        https://code.jquery.com/jquery-3.6.4.slim.min.js
        https://cdnjs.cloudflare.com/ajax/libs/jquery.spritely/0.6.8/jquery.spritely.min.js
        https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6468.51747073409!2d5.360954216219698!3d43.76461762480631!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12ca18e8c43ef017%3A0x37311f4ada7a48af!2sRue%20du%20Grand%20Pr%C3%A9%2C%2084160%20Lourmarin!5e0!3m2!1sfr!2sfr!4v1683025305334!5m2!1sfr!2sfr">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaFleur</title>
    <link rel="icon" href="public/img/logo-la-fleur.svg" />
    <link rel="stylesheet" href="public/css/main.css">
    <link href="https://fonts.cdnfonts.com/css/agile-jewelry-personal-use" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/heldane-text" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.spritely/0.6.8/jquery.spritely.min.js"></script>
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
        // Selon le cas d'utilisation, j'inclus une vue
        if (isset($message) and !empty($message) and !is_array($message)) {
            echo $message;
        }
        switch ($uc) {
            case 'accueil':
                include 'app/views/v_accueil.php';
                break;
            case 'boutique':
                include "app/views/v_boutique.php";
                break;
            case 'produit':
                include "app/views/v_produit.php";
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
            case 'modifierInfos':
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
                <a class="footer-link" href="https://verlyck.needemand.com/projets_web/blog_lafleur">Blog</a>
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