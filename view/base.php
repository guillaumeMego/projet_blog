<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/d2f808818c.css" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/design/css/defaut.css">
    <link rel="icon" href="./public/asset/img/logo.png" type="image/x-icon">
    <title><?= $title ?> || Noé'Nails</title>
</head>

<body class="bg-persoDeux">
    <header class="bg-persoUn shadow">
        <div class="container">
            <nav class="navbar navbar-expand-lg sticky-top p-0 " id="menu">
                <div class="container-fluid">
                    <a class="navbar-brand text-white" href="index.php?page=home"><img src="./public/asset/img/logo.png" alt="Logo du site" height="50px"> Noé'Nails</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link text-white active" href="index.php?page=home">Blog</a>
                            </li>

                            <?php if (Securite::estConnecte()) {  ?>
                                <?php if (UserManager::hasAuth()) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link text-white" href="index.php?page=ajoutArticle">Nouvel article</a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="index.php?page=deconnexion">Deconnexion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="index.php?page=profil"><i class="fa-solid fa-user"></i></a>
                                </li>

                            <?php  } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="index.php?page=connexion">Connexion</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <?= $content ?>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://kit.fontawesome.com/d2f808818c.js" crossorigin="anonymous"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>