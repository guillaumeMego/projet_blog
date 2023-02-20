<?php

/**
 * Fonction pour ajouter un like
 */
function addlikes()
{
    session_start();
    if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
        if (isset($_GET['page']) && $_GET['page'] == 'ajoutLike' && isset($_GET['id'])) {
            $articleId = $_GET['id'];
            $userId = $_SESSION['id'];

            if (Likes::userLikedArticle($userId, $articleId)) {
                // L'utilisateur a déjà aimé l'article
                header('Location: index.php?page=article&id=' . $articleId);
                exit();
            } else {
                // Ajouter un like pour l'article
                Likes::addLike($articleId, $userId);

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

function dislikes()
{
    session_start();
    if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
        if (isset($_GET['page']) && $_GET['page'] == 'dislike' && isset($_GET['id'])) {
            $id_article = $_GET['id'];
            // Ajouter un like
            Likes::disLike($_GET['id']);
            // Redirection vers la page de l'article
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        header('Location: index.php?page=home');
        exit();
    }
}
