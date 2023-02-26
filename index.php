<?php

session_start();
// Routeur
require './controller/userController.php';
require './controller/articleController.php';
require './controller/likeController.php';
require './controller/tokenController.php';


$controller = new UserController();
$article    = new ArticleController();
$like       = new LikeController();
$token      = new TokenController();
try {
    // Si la variable 'page' est définie dans l'URL
    if (isset($_GET['page'])) {
        // Selon la valeur de 'page'
        switch ($_GET['page']) {
            case 'home':
                // Affichage de la page d'accueil
                $controller->home();
                break;
            case 'connexion':
                // Affichage de la page de connexion
                $controller->connexion();
                break;
            case 'inscription':
                // Affichage de la page d'inscription
                $controller->addUser();
                break;
            case 'deleteProfil':
                // Suppression du profil
                $controller->deleteProfil();
                break;
            case 'profil':
                // Affichage de la page du profil
                $controller->profil();
                break;
            case 'article':
                // Affichage de la page du blog
                $article->article();
                break;
            case 'ajoutArticle':
                // Affichage de la page d'ajout d'article
                $article->ajoutArticle();
                break;
            case 'deleteArticle':
                // Suppression d'un article
                $article->deleteArticle();
                break;
            case 'updateArticle':
                // Affichage de la page de modification d'article
                $article->updateArticle();
                break;
            case 'ajoutLike':
                // Ajout d'un like
                $like->addLikes();
                break;
            case 'dislike':
                // Ajout d'un dislike
                $like->disLikes();
                break;
            case 'deconnexion':
                // Déconnexion de l'utilisateur
                $controller->logout();
                break;
            case 'deleteCommentaire':
                // Suppression d'un commentaire
                $article->deleteCommentaire();
                break;
            case 'token':
                // Affichage de la page de réinitialisation de mot de passe
                $token->token();
                break;
            case 'changePassword':
                // Affichage de la page de modification de mot de passe
                $token->verifieToken();
                break;
            default:
                // Si la page n'existe pas, levée d'une exception
                throw new Exception("Cette page n'existe pas");
        }
    } else {
        // Par défaut, affichage de la page d'accueil
        $controller->home();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    $controller->pageErreur($errorMessage);
}
