<?php

// Démarrage de la temporisation de sortie
ob_start();
?>

<article class="col-10 col-lg-8 mx-auto card m-3 mt-5 shadow-lg">

    <img src="<?= $image_path ?>" alt="Photo de l'article">
    <div class="card-body">
        <h4 class="card-title display-6 border-top border-4 border-perso p-2"><?= $title ?></h4>
        <p class="card-text px-1 pb-4 lead"><?= $contentArt ?></p>
        <div class="d-flex justify-content-between text-secondary border-bottom border-3 border-perso ">
            <p class="card-text small align-self-end mb-0">Auteur : <?= $username ?></p>
            <p class="card-text small">Créé le : <?= date('d/m/Y', strtotime($created_at)) ?></p>
        </div>
        <?php if (!$securiteconnect) : ?>
            <div class="info">
                <p class="card-text pt-2"><a href="index.php?page=inscription" class="card-link btn btn-perso me-3 text-background btn-sm rounded">Créez un compte</a>ou<a href="index.php?page=connexion" class="card-link btn btn-perso text-background btn-sm rounded">Connectez vous</a> pour accéder aux commentaire et aux likes.</p>
            </div>
        <?php endif; ?>
        <?php if ($securiteconnect) : ?>
            <div class="info">
                <h4 class="h4">Commentaires :</h4>
                <?php foreach ($AfficheCommentaire as $value) :
                    $created_at = new DateTime($value['created_at']);
                    $date_europeenne = $created_at->format('d/m/Y'); ?>
                    <div class="comments border border-perso mb-1 p-2">
                        <p class="card-text mb-0"><?= $value['content'] ?></p>
                        <div class="d-flex justify-content-between">
                            <p class="card-text small text-secondary text-end pb-0 mb-0"><?= $value['username'] ?> le : <?= $date_europeenne ?></p>
                            <?php if ($userManager->hasAuth() || $commentaire->getAuthorId($value['id']) == $_SESSION['id']) :
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
                                    <textarea name="commentaire" id="commentaire" class="w-100"></textarea>
                                    <br>
                                    <button type="submit" class="btn btn-perso text-white mt-2">Envoyer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-2 bg-persoSecondaire">
                    <div class="d-flex justify-content-between p-2">
                        <?php if ($auth) : ?>
                            <div class="boutton">
                                <a href="index.php?page=updateArticle&id=<?php echo $id_article ?>" class="card-link btn btn-perso px-3 text-background btn-sm rounded">Modifier</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="card-link btn btn-perso px-3 text-background btn-sm rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Supprimer
                                </button>
                            </div>
                            <!-- Modal suppression -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">suppression</h1>
                                            <button type="button" class="btn-close btn-perso text-police" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
                                            <p class="small text-danger">Cette action est irreversible !</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            <a href="index.php?page=deleteArticle&id=<?php echo $id_article; ?>" class="btn btn-danger">Confirmer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($like->getLikeId($id_article)) : ?>
                            <a href="index.php?page=dislike&id=<?php echo $likeid; ?>"><span class="badge text-danger p-2"><i class="fa-solid fa-heart"><?php echo " " . $nombreLike ?></i></span></a>
                        <?php endif; ?>
                        <?php if (!$like->getLikeId($id_article)) : ?>
                            <a href="index.php?page=ajoutLike&id=<?php echo $id_article; ?>"><span class="badge text-danger p-2"><i class="fa-regular fa-heart"><?php echo " " . $nombreLike ?></i></span></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
</article>


<?php
// Récupération du contenu généré et stockage dans une variable
$content = ob_get_clean();

// Inclusion du template de base
require('base.php');
?>