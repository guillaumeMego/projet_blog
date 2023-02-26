<?php

class LikeController
{
    /**
     * Ajout d'un like
     */
    function addlikes()
    {
        if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
            if (isset($_GET['page']) && $_GET['page'] == 'ajoutLike' && isset($_GET['id'])) {
                $articleId = $_GET['id'];
                $userId = $_SESSION['id'];

                $like = new Likes();
                if ($like->userLikedArticle($userId, $articleId)) {
                    // L'utilisateur a déjà aimé l'article
                    header('Location: index.php?page=article&id=' . $articleId);
                    exit();
                } else {
                    // Ajouter un like pour l'article
                    $like->addLike($articleId, $userId);

                    // Rediriger vers la page de l'article
                    header('Location: index.php?page=article&id=' . $articleId);
                    exit();
                }
            }
        } else {
            header('Location: index.php?page=home');
            exit();
        }
    }

    /**
     * Ajout d'un dislike
     */
    function dislikes()
    {
        if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
            if (isset($_GET['page']) && $_GET['page'] == 'dislike' && isset($_GET['id'])) {
                $id_article = $_GET['id'];
                // Ajouter un like
                $like = new Likes();
                $like->disLike($_GET['id']);
                // Redirection vers la page de l'article
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            header('Location: index.php?page=home');
            exit();
        }
    }
}
