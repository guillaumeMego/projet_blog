<?php
// Définition du titre de la page
$title = 'Accueil';
$sousTitre = 'Page de blog';
$titrePage = 'A la une :';

// Démarrage de la temporisation de sortie
ob_start();
?>
<!-- Contenu de la page -->
<div class="bg-image mb-5" style="background-image: url('./public/asset/img/fond.jpg');
            height:350px; background-repeat:no-repeat; background-size:cover; background-position:center;">
    <div class="color h-100 d-flex flex-column justify-content-center align-items-center" style="background-color: rgba(255,255,255,0.7);">
        <h1 class="display-3 fw-bold">Bienvenue sur mon blog</h1>
        <p class="fs-3">Parcourez le blog sous forme d'articles.</p>
        <p class="fs-5 ">Commentez et aimez les articles en vous connectant <a href="connexion" class="text-decoration-none text-perso fw-bold fs-3">ici</a>
        </p>
    </div>
</div>
<div class="container">
    <h2 class="display-6 alert alert-perso mb-5 mx-auto shadow text-center w-50">Article a la une :</h2>
    <?php
    $articles = Articles::getArticlesOne();
    foreach ($articles as $article) :
        // Conversion de la date de création en objet DateTime
        $created_at = new DateTime($article['created_at']);

        // Formattage de la date au format européen sans l'heure
        $date_europeenne = $created_at->format('d/m/Y');
    ?>
        <div class="card mx-auto col-lg-8 shadow-lg">
            <img src="<?= $article['image_path'] ?>" alt="">
            <div class="card-body pb-0">
                <h5 class="card-title display-6 border-bottom border-3 border-perso "><?= $article['title'] ?></h5>
                <p class="card-text lead "><?= $article['description'] ?></p>
                <div class="d-flex justify-content-between small text-secondary fs-6">
                    <p class="card-text ">Auteur : <?= $article['username'] ?></p>
                    <p class="card-text">Créé le : <?= $date_europeenne ?></p>
                </div>

            </div>
            <div class="card-footer px-3">
                <div class="d-flex justify-content-between">
                    <a href="index.php?page=article&id=<?php echo $article['id']; ?>" class="card-link btn btn-sm btn-perso text-white">En savoir plus</a>
                    <?php if (Securite::estConnecte()) : ?>
                        <div class="infosLikeComment">
                            <span class="badge text-perso p-2"><i class="fa-solid fa-comments"><?php echo " " . Commentaire::countComments($article['id']); ?></i></span>
                            <span class="badge text-danger p-2"><i class="fa-sharp fa-solid fa-heart"><?php echo " " . Likes::countLike($article['id']); ?></i></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
    endforeach;
    ?>
    <h2 class="display-6 alert alert-perso my-5 mx-auto shadow text-center w-50">Les articles :</h2>
    <div class="row mx-auto">
        <?php
        $articles = Articles::getArticles();
        foreach ($articles as $article) :
            // Conversion de la date de création en objet DateTime
            $created_at = new DateTime($article['created_at']);

            // Formattage de la date au format européen sans l'heure
            $date_europeenne = $created_at->format('d/m/Y');
        ?>
            <div class="col-lg-4 col-sm-6">
                <div class="card m-2 shadow-lg">
                    <img src="<?= $article['image_path'] ?>" style="height: 250px;" alt="">
                    <div class="card-body pb-0">
                        <h5 class="card-title h4 border-bottom border-3 border-perso p-1"> <?= $article['title'] ?></h5>
                        <p class="card-text lead"><?= $article['description'] ?></p>
                        <div class="d-flex justify-content-between text-secondary fs-6">
                            <p class="card-text ">Auteur : <?= $article['username'] ?></p>
                            <p class="card-text">Créé le : <?= $date_europeenne ?></p>
                        </div>
                    </div>
                    <div class="card-footer px-3">
                        <div class="d-flex justify-content-between">
                            <a href="index.php?page=article&id=<?php echo $article['id']; ?>" class="card-link btn btn-sm btn-perso text-white">En savoir plus</a>
                            <?php if (Securite::estConnecte()) : ?>
                                <div class="infosLikeComment">
                                    <span class="badge text-perso p-2"><i class="fa-solid fa-comments"><?php echo " " . Commentaire::countComments($article['id']); ?></i></span>
                                    <span class="badge text-danger p-2"><i class="fa-sharp fa-solid fa-heart"><?php echo " " . Likes::countLike($article['id']); ?></i></span>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>

    </div>
</div>
<footer class="footer bg-persoUn mt-5">
    <div class="container text-white p-3 text-end">&copy; Ganne Guillaume</div>
</footer>
<?php
// Récupération du contenu généré et stockage dans une variable
$content = ob_get_clean();

// Inclusion du template de base
require('base.php');
?>