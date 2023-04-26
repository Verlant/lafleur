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
                        <img src="public/img/logo-la-fleur.svg" alt="logo lafleur" />
                    </a>
                </li>
                <li>
                    <a class="header-link" href="index.php?uc=espaceClient">Espace client</a>
                </li>
                <li>
                    <a class="header-link" href="index.php?uc=panier">Panier</a>
                </li>
            </ul>
        </nav>
        <nav id="header-nav-mobile">
            <ul>
                <li>
                    <!-- <img src="public/img/menu-burger.svg" alt="icone de menu burger"> -->
                    <a class="header-link" href="index.php?uc=boutique">Boutique</a>
                </li>
                <li>
                    <!-- <a href="index.php?uc=espaceClient">
                        <img src="public/img/compte.svg" alt="icone de menu burger">
                    </a> -->
                    <a class="header-link" href="index.php?uc=aPropos">A propos</a>

                </li>
                <li>
                    <a href="index.php?uc=accueil">
                        <img class="logo-mobile" src="public/img/logo-mobile.svg" alt="logo lafleur" />
                    </a>
                </li>
                <li>
                    <a class="header-link" href="index.php?uc=espaceClient">Espace client</a>
                </li>
                <li>
                    <!-- <a href="index.php?uc=panier"><img src="public/img/panier.svg" alt="icone de menu burger"></a> -->
                    <a class="header-link" href="index.php?uc=panier">Panier</a>

                </li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        // Controleur de vues
        // Selon le cas d'utilisation, j'inclus un controleur ou simplement une vue
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
            case 'panier':
                include "app/views/v_panier.php";
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
                <!-- </li>
            <li> -->
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
</body>

</html>