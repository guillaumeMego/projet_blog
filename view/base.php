<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog de nails art pour les amateurs et professionnels, avec des tutoriels, des astuces et des photos de designs créatifs. Trouvez l'inspiration pour vos prochains projets de nail art ici !" />
    <meta name="keywords" content="nails art, ongles, nail art, tutoriels, astuces, créations, inspiration, conseils" />
    <meta name="author" content="Nails by No" />
    <title><?= $title ?> - Blog Nails by No</title>
    <link rel="canonical" href="https://www.nailsbyno.com<?= $_SERVER['REQUEST_URI'] ?>" />
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/d2f808818c.css" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/design/css/defaut.css">
    <link rel="icon" href="./public/asset/img/logoNailsSolo.png" type="image/x-icon">

</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8WCS8B9LB6"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-8WCS8B9LB6');
</script>

<body class="bg-background vh-100 text-police d-flex flex-column justify-content-between">
    <header class="bg-persoUn shadow">
        <div class="container">
            <nav class="navbar navbar-expand-lg sticky-top py-4 " id="menu">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php?page=home"><img src="./public/asset/img/nomLogo.png" alt="Logo du site" height="40px"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=home">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#articles">Articles</a>
                            </li>

                            <?php if ($securite->estConnecte()) {  ?>
                                <?php if ($userManager->hasAuth()) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php?page=ajoutArticle">Nouvel article</a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=deconnexion">Deconnexion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=profil"><i class="fa-solid fa-user"></i></a>
                                </li>

                            <?php  } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=connexion">Connexion</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <?= $content ?>
    <footer class="footer bg-persoUn mt-5">
        <div class="container text-police p-4 d-flex justify-content-between flex-wrap">
            <div class="d-flex flex-column justify-content-center align-items-center mb-4 mb-md-0">
                <h3 class="display-8 mb-4">Rejoins-moi ici :</h3>
                <ul class="d-flex justify-content-center m-0">
                    <li class="nav-link mx-2">
                        <a href="#" class="text-police fs-4" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li class="nav-link mx-2">
                        <a href="#" class="text-police fs-4" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="contact d-flex flex-column justify-content-center align-items-center">
                <h3 class="display-8 mb-4">Tu peux me contacter aussi ici :</h3>
                <li class="nav-link mx-2">
                    <a href="mailto:contact@guillaumeganne.com" class="text-police fs-4">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        Envoie-moi un mail
                    </a>
                </li>
            </div>
        </div>
    </footer>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://kit.fontawesome.com/d2f808818c.js" crossorigin="anonymous"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>