<?php
// Définition du titre de la page
$title = $article['title'];
$sousTitre = 'Page de blog';
$titrePage = $article['title'];
// Démarrage de la temporisation de sortie
ob_start();
?>
<div class="col-10 col-lg-8 mx-auto">
    <div class="card m-3 mt-5 shadow-lg">
        <img src="<?= $article['image_path'] ?>" alt="">
        <div class="card-body">
            <h5 class="card-title display-6 border-top border-4 border-perso p-2"> <?= $article['title'] ?></h5>
            <p class="card-text px-1 pb-4 lead"><?= $article['content'] ?></p>
            <div class="d-flex justify-content-between text-secondary small border-bottom border-3 border-perso ">
                <p class="card-text">Auteur : <?= $article['username'] ?></p>
                <p class="card-text">Créé le : <?php $date = new DateTime($article['created_at']);
                                                echo $date->format('d/m/Y'); ?></p>
            </div>
            <?php if (!Securite::estConnecte()) : ?>
                <div class="info">
                    <p class="card-text pt-2"><a href="inscription" class="btn btn-perso btn-sm text-white">Créez un compte</a> pour accéder aux commentaire</p>
                </div>
            <?php endif; ?>
            <?php if (Securite::estConnecte()) : ?>
                <div class="card-body">
                    <h4 class="h4">Commentaires :</h4>
                    <?php foreach ($commentaire as $value) :
                        // Conversion de la date de création en objet DateTime
                        $created_at = new DateTime($value['created_at']);

                        // Formattage de la date au format européen sans l'heure
                        $date_europeenne = $created_at->format('d/m/Y'); ?>
                        <div class="comments border border-perso mb-1 p-2">
                            <p class="card-text mb-0"><?= $value['content'] ?></p>
                            <div class="d-flex justify-content-between">
                                <p class="card-text small text-secondary text-end pb-0 mb-0"><?= $value['username'] ?> le : <?= $date_europeenne ?></p>
                                <?php if (UserManager::hasAuth() || Commentaire::getAuthorId($value['id']) == $_SESSION['id']) :
                                    $idComment = $value['id'];
                                ?>
                                    <a href="index.php?page=deleteCommentaire&id=<?= $idComment ?>" class="small text-secondary pb-0 mb-0">Supprimer</a>

                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <button type="button" class="btn border-0 small text-perso" data-bs-toggle="modal" data-bs-target="#Modalcommenter">
                        Ajouter un commentaire ...
                    </button>
                    <!-- Modal commenter -->
                    <div class="modal fade" id="Modalcommenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Commentaire</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="index.php?page=article&id=<?php echo $id_article; ?>" method="post">
                                        <label for="commentaire"></label>
                                        <textarea name="commentaire" id="" cols="53" rows="10"></textarea>
                                        <br>
                                        <button type="submit" class="btn btn-perso btn-sm text-white mt-2">Envoyer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer p-2 bg-persoSecondaire">
            <div class="d-flex justify-content-between p-2">
                <?php if (UserManager::hasAuth()) : ?>
                    <div class="boutton">
                        <a href="index.php?page=updateArticle&id=<?php echo $article['id']; ?>" class="btn btn-perso btn-sm text-white">Modifier</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-perso btn-sm text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Supprimer
                        </button>
                    </div>
                    <!-- Modal suppression -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">suppression</h1>
                                    <button type="button" class="btn-close btn-perso text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer cet article ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn small btn-danger" data-bs-dismiss="modal">Annuler</button>
                                    <a href="index.php?page=deleteArticle&id=<?php echo $id_article; ?>" class="btn btn-success">Confirmer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (Likes::getLikeId($id_article)) : ?>
                    <a href="index.php?page=dislike&id=<?php echo $likeid; ?>"><span class="badge text-danger p-2"><i class="fa-solid fa-heart"><?php echo " " . $nb_likes ?></i></span></a>
                <?php endif; ?>
                <?php if (!Likes::getLikeId($id_article)) : ?>
                    <a href="index.php?page=ajoutLike&id=<?php echo $id_article; ?>"><span class="badge text-danger p-2"><i class="fa-regular fa-heart"><?php echo " " . $nb_likes ?></i></span></a>
                <?php endif; ?>
            <?php endif; ?>
            </div>
        </div>

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