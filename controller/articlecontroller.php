<?php

require_once('./model/Article.php');


/**
 * Fonction blog pour gérer la page du blog et appeler les articles
 */
function blog()
{
    // Démarrer la session
    session_start();
    // Charger la vue du blog
    require('./view/blog.php');
}

/**
 * Fonction Article pour afficher la page d'un article
 */
function article()
{
    require_once('./model/Commentaire.php');
    // Démarrer la session
    session_start();
    if (isset($_GET['id'])) {
        $id_article = $_GET['id'];
        // Utilisez le modèle "Articles" pour récupérer les informations de l'article
        $article = Articles::getArticleById($id_article);
        $nb_likes = Likes::countLike($id_article);
        if (Securite::estConnecte()) {
            $likeid = Likes::getLikeId($id_article);
            $commentaire = Commentaire::getComments($id_article);
        }
        // ajoute un commentaire
        if (!empty($_POST['commentaire'])) {
            $userId = $_SESSION['id'];
            $content = htmlspecialchars($_POST['commentaire']);
            Commentaire::addComment($userId, $id_article, $content);
            header('Location: index.php?page=article&id=' . $id_article);
        }
    } else {
        header('Location: index.php?page=home');
        exit();
    }


    // Charger la vue d'un article
    require('./view/article.php');
}
/**
 * Fonction deleteCommentaire pour supprimer un commentaire
 */
function deleteCommentaire()
{
    session_start();
    if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
        if (isset($_GET['page']) && $_GET['page'] == 'deleteCommentaire' && isset($_GET['id'])) {
            $id_commentaire = $_GET['id'];
            // Supprimer le commentaire
            Commentaire::deleteComment($id_commentaire);
            // Redirection vers la page du blog
            header('Location: index.php?page=home');
        }
    } else {
        header('Location: index.php?page=home');
        exit();
    }
}

/**
 * Fonction addArticle pour ajouter un article
 */
function addArticle($titre, $description, $article, $image, $id_users)
{
    session_start();
    if (UserManager::hasAuth()) {
        // Ajouter un article
        Articles::ajoutArticle($titre, $description, $article, $image, $id_users);
        // Redirection vers la page du blog
    }
    header('Location: index.php?page=home');
    exit();
}

/**
 * Fonction ajoutArticle pour afficher la page d'ajout d'un article
 */
function ajoutArticle()
{
    session_start();
    if (!empty($_SESSION['id']) && $_SESSION['id'] > 0 && UserManager::hasAuth()) {
        if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['article']) && !empty($_FILES['photo']['name'])) {
            addArticle(htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['description']), htmlspecialchars($_POST['article']), $_FILES['photo'], $_SESSION['id']);
        } else {
            require('./view/ajoutArticle.php');
        }
    } else {
        header('Location: index.php?page=home');
        exit();
    }
}

/**
 * Fonction de demande deleteArticle pour supprimer un article
 */
function deleteArticle()
{
    session_start();
    if (!empty($_SESSION['id']) && $_SESSION['id'] > 0 && UserManager::hasAuth()) {
        if (isset($_GET['page']) && $_GET['page'] == 'deleteArticle' && isset($_GET['id']) && UserManager::hasAuth()) {
            $id_article = $_GET['id'];
            // Supprimer l'article
            Articles::deleteArticle($id_article);
            // Redirection vers la page du blog
            header('Location: index.php?page=home');
        }
    } else {
        header('Location: index.php?page=home');
        exit();
    }
}

/**
 * Fonction updateArticle pour afficher la page de modification d'un article
 */
function updateArticle()
{

    session_start();
    if (!empty($_SESSION['id']) && $_SESSION['id'] > 0 && UserManager::hasAuth()) {
        if (!empty($_POST['titre'])) {
            // Appel de la fonction changerPseudo
            Articles::changerTitre(htmlspecialchars($_POST['titre']));
        }
        if (!empty($_POST['description'])) {
            // Appel de la fonction changerPseudo
            Articles::changerDescription(htmlspecialchars($_POST['description']));
        }
        if (!empty($_POST['article'])) {
            // Appel de la fonction changerPseudo
            Articles::changerContent(htmlspecialchars($_POST['article']));
        }
        if (!empty($_FILES['photo']['name'])) {
            // Appel de la fonction changerPseudo
            Articles::changerImage($_FILES['photo']);
        }
        $id_article = $_GET['id'];
        $article = Articles::getArticleById($id_article);
        // Charger la vue du profil
        require('./view/updateArticle.php');
        exit();
    } else {
        header('Location: index.php?page=home');
        exit();
    }
}
