<?php
// Définition du titre de la page
$title = 'Accueil';
$sousTitre = 'Page de blog';
$titrePage = 'A la une :';

// Démarrage de la temporisation de sortie
ob_start();
?>
<!-- Contenu de la page -->
<section class="container">
    <div class="d-flex flex-column align-items-center">

        <img src="./public/asset/img/logoNailsSolo.png" height="150" class="float-left order-first my-4" alt="Logo du site 'Nails by No'">

        <div class="align-middle lead my-4">
            <p>Bienvenue sur mon blog personnel consacré aux ongles et au nail art ! Si vous êtes un amateur de manucure, que vous cherchez des conseils sur les tendances en matière de vernis à ongles ou que vous voulez simplement discuter avec d'autres passionnés, vous êtes au bon endroit.

                Sur ce blog, je partagerai avec vous mes astuces pour prendre soin de vos ongles, mes coups de cœur en matière de vernis à ongles et les tendances à ne pas manquer.
            </p>
            <p>
                Je veux que ce blog soit un endroit où les gens peuvent se connecter, discuter et s'inspirer. C'est pourquoi j'ai inclus des fonctionnalités de commentaire et de like pour que vous puissiez partager vos propres conseils et opinions sur les articles que je publie. J'encourage également tous les lecteurs à partager leurs créations de nail art sur les réseaux sociaux avec le hashtag #MonNailArt (n'oubliez pas de me taguer également pour que je puisse voir vos chefs-d'œuvre !).
            </p>
            <p>
                Je suis très excitée à l'idée de commencer cette aventure de blogging avec vous. Si vous avez des questions, des suggestions d'articles ou simplement envie de discuter, n'hésitez pas à me contacter.

                Bonne lecture et à très bientôt sur le blog !
            </p>
            <p>
                N'hésitez pas a vous <a href="index.php?page=inscription" class="text-police"><strong>Créer un compte</strong></a> pour acceder aux commentaires et aimer les articles.
            </p>
        </div>

    </div>
</section>

<section class="container">
    <h2 class="display-6 alert alert-perso mb-5 mx-auto shadow text-center">Dernier article :</h2>
    <?php
    foreach ($articles as $article) :
        // Conversion de la date de création en objet DateTime
        $created_at = new DateTime($article['created_at']);

        // Formattage de la date au format européen sans l'heure
        $date_europeenne = $created_at->format('d/m/Y');
    ?>
        <article class="card mx-auto col-lg-8 shadow-lg">
            <img src="<?= $article['image_path'] ?>" alt="">
            <div class="card-body py-0">
                <h5 class="card-title display-7 border-bottom border-3 border-perso mt-2"><?= $article['title'] ?></h5>
                <p class="card-text lead "><?= $article['description'] ?></p>
                <div class="d-flex justify-content-between text-secondary">
                    <p class="card-text small align-self-end mb-0">Auteur : <?= $article['username'] ?></p>
                    <p class="card-text small ">Créé le : <?= $date_europeenne ?></p>
                </div>

            </div>
            <div class="card-footer px-3">
                <div class="d-flex justify-content-between">
                    <a href="index.php?page=article&id=<?php echo $article['id']; ?>" class="card-link btn btn-perso px-3 text-background btn-sm rounded">Lire l'article</a>
                    <?php if ($securite->estConnecte()) : ?>
                        <div class="infosLikeComment">
                            <span class="badge text-police p-2"><i class="fa-solid fa-comments"><?php echo " " . $commentaire->countComments($article['id']); ?></i></span>
                            <span class="badge text-danger p-2"><i class="fa-sharp fa-solid fa-heart"><?php echo " " . $like->countLike($article['id']); ?></i></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    <?php
    endforeach;
    ?>
    <h2 class="display-6 alert alert-perso my-5 mx-auto shadow text-center w-50" id="articles">Les articles :</h2>
    <div class="row mx-auto">
        <?php
        $articles = new Articles();
        $articles = $articles->getArticles();
        foreach ($articles as $article) :
            // Conversion de la date de création en objet DateTime
            $created_at = new DateTime($article['created_at']);

            // Formattage de la date au format européen sans l'heure
            $date_europeenne = $created_at->format('d/m/Y');
        ?>
            <section class="col-lg-4 col-sm-6">
                <div class="card m-2 shadow-lg">
                    <img src="<?= $article['image_path'] ?>" style="height: 250px;" alt="">
                    <div class="card-body pb-0">
                        <h5 class="card-title display-7 border-bottom border-3 border-perso mt-2"> <?= $article['title'] ?></h5>
                        <p class="card-text lead"><?= $article['description'] ?></p>
                        <div class="d-flex justify-content-between text-secondary">
                            <p class="card-text small align-self-end mb-0">Auteur : <?= $article['username'] ?></p>
                            <p class="card-text small">Créé le : <?= $date_europeenne ?></p>
                        </div>
                    </div>
                    <div class="card-footer px-3">
                        <div class="d-flex justify-content-between">
                            <a href="index.php?page=article&id=<?php echo $article['id']; ?>" class="card-link btn btn-perso px-3 text-background btn-sm rounded">Lire l'article</a>
                            <?php if ($securite->estConnecte()) : ?>
                                <div class="infosLikeComment">
                                    <span class="badge text-police p-2"><i class="fa-solid fa-comments"><?php echo " " . $commentaire->countComments($article['id']); ?></i></span>
                                    <span class="badge text-danger p-2"><i class="fa-sharp fa-solid fa-heart"><?php echo " " . $like->countLike($article['id']); ?></i></span>
                                </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        endforeach;
        ?>

    </div>
</section>

<?php
// Récupération du contenu généré et stockage dans une variable
$content = ob_get_clean();

// Inclusion du template de base
require('base.php');
?>