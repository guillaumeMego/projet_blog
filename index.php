<?php
// Routeur
require('controller/controller.php');
require('controller/articlecontroller.php');
require('controller/likeController.php');
require('controller/tokencontroller.php');

// Enregistrement de la fonction d'autochargement de classes
spl_autoload_register(function ($className) {
    require_once('model/' . $className . '.php');
});

try {
    // Si la variable 'page' est définie dans l'URL
    if (isset($_GET['page'])) {
        // Selon la valeur de 'page'
        switch ($_GET['page']) {
            case 'home':
                // Affichage de la page d'accueil
                blog();
                break;
            case 'inscription':
                // Si les données d'inscription ont été envoyées via le formulaire
                if (!empty($_POST['username']) && !empty($_POST['mail']) && !empty($_POST['password'])) {
                    // Appel de la fonction addUser() du contrôleur
                    addUser(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['password']));
                } else {
                    // Affichage de la page d'inscription
                    home();
                }
                break;
            case 'deleteProfil':
                // Suppression du profil
                deleteProfil();
                break;
            case 'connexion':
                // Si les données de connexion ont été envoyées via le formulaire
                if (!empty($_POST['mail']) && !empty($_POST['password'])) {
                    // Appel de la fonction connexion() du contrôleur
                    connexion(htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['password']));
                } else {
                    // Affichage de la page de connexion
                    pageConnect();
                }
                break;
            case 'profil':
                // Affichage de la page du profil
                profil();
                break;
            case 'article':
                // Affichage de la page du blog
                article();
                break;
            case 'ajoutArticle':
                // Affichage de la page d'ajout d'article
                ajoutArticle();
                break;
            case 'deleteArticle':
                // Suppression d'un article
                deleteArticle();
                break;
            case 'updateArticle':
                // Affichage de la page de modification d'article
                updateArticle();
                break;
            case 'ajoutLike':
                // Ajout d'un like
                addLikes();
                break;
            case 'dislike':
                // Ajout d'un dislike
                disLikes();
                break;
            case 'deconnexion':
                // Déconnexion de l'utilisateur
                logout();
                break;
            case 'deleteCommentaire':
                // Suppression d'un commentaire
                deleteCommentaire();
                break;
            case 'token':
                // Affichage de la page de réinitialisation de mot de passe
                token();
                break;
            case 'changePassword':
                // Affichage de la page de modification de mot de passe
                verifieToken();
                break;
            default:
                // Si la page n'existe pas, levée d'une exception
                throw new Exception("Cette page n'existe pas");
        }
    } else {
        // Par défaut, affichage de la page d'accueil
        blog();
    }
} catch (Exception $e) {
    // Traitement des exceptions
    $error = $e->getMessage();
    require('view/errorView.php');
}
