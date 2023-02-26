<?php

require_once('./model/Article.php');

// Enregistrement de la fonction d'autochargement de classes
spl_autoload_register(function ($className) {
    require_once('model/' . $className . '.php');
});

class ArticleController
{
    /**
     * Fonction Article pour afficher la page d'un article
     */
    function article()
    {
        $userManager = new UserManager();
        // Instanciation des classes
        $article = new Articles();
        $commentaire = new Commentaire();
        $securite = new Securite();
        $like = new Likes();

        if (!empty($_GET['id'])) {
            $id_article = $_GET['id'];
            // Récupération des données de l'article
            $reponse = $article->getArticleById($id_article);
            foreach ($reponse as $value) {
                $id_article = $value['id'];
                $image_path = $value['image_path'];
                $title = $value['title'];
                $contentArt = $value['content'];
                $created_at = $value['created_at'];
                $username = $value['username'];
            }
            // Récupération de l'etat de la connexion
            $securiteconnect = $securite->estConnecte();
            if (isset($_SESSION['id'])) {


                // Récupération du nombre de like
                $nombreLike = $like->countLike($id_article);



                // Récupération de l'etat de l'authentification
                $auth = $userManager->hasAuth();

                // Récupération du nombre de like
                $nombreLike = $like->countLike($id_article);

                $likeid = $like->getLikeId($id_article);
                // Récupération de commentaires
                $AfficheCommentaire = $commentaire->getComments($id_article);


                if (!empty($_POST['commentaire'])) {
                    $userId = $_SESSION['id'];
                    $content = htmlspecialchars($_POST['commentaire']);
                    $commentaire->addComment($userId, $id_article, $content);
                    header('Location: index.php?page=article&id=' . $id_article);
                    exit();
                }
            }

            require('./view/article.php');
        } else {
            header('Location: index.php?page=home');
            exit();
        }
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
                $commentaire = new Commentaire();
                // Supprimer le commentaire
                $commentaire->deleteComment($id_commentaire);
                // Redirection vers la page du blog
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            header('Location: index.php?page=home');
            exit();
        }
    }

    /**
     * Fonction ajoutArticle pour afficher la page d'ajout d'un article
     */
    function ajoutArticle()
    {
        $userManager = new UserManager();
        if (!empty($_SESSION['id']) && $_SESSION['id'] > 0 && $userManager->hasAuth()) {
            if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['article']) && !empty($_FILES['photo']['name'])) {
                $description = htmlspecialchars($_POST['description']);
                $titre = htmlspecialchars($_POST['titre']);
                $content = htmlspecialchars($_POST['article']);
                $content = nl2br($_POST['article']);
                $image = $_FILES['photo'];
                $id_user = $_SESSION['id'];
                // Ajouter l'article
                $articleModel = new Articles();
                $result = $articleModel->addArticle($titre, $description, $content, $image, $id_user);
                if ($result) {
                    $success = 'Article ajouté avec succès';
                } else {
                    $error = 'Une erreur est survenue';
                }
                if (isset($success) || isset($error)) {
                    require_once('./view/ajoutArticle.php');
                }
            } else {
                require_once('./view/ajoutArticle.php');
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
        $userManager = new UserManager();
        if (!empty($_SESSION['id']) && $_SESSION['id'] > 0 &&  $userManager->hasAuth()) {
            if (isset($_GET['page']) && $_GET['page'] == 'deleteArticle' && isset($_GET['id']) &&  $userManager->hasAuth()) {
                $id_article = $_GET['id'];
                $article = new Articles();
                // Supprimer l'article
                $article->deleteArticle($id_article);
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
        $userManager = new UserManager();
        if (!empty($_SESSION['id']) && $_SESSION['id'] > 0 && $userManager->hasAuth()) {
            $id_article = $_GET['id'];
            $article = new Articles();
            $resultat = $article->getArticleById($id_article);
            foreach ($resultat as $value) {
                $id_article = $value['id'];
                $image_path = $value['image_path'];
                $title = $value['title'];
                $description = $value['description'];
                $contentArt = $value['content'];
                $created_at = $value['created_at'];
                $username = $value['username'];

                // Afficher les données du content dans le textarea sans les br
                $contentArt = str_replace('<br />', '', $contentArt);
            }
            if (!empty($_POST['titre'])) {
                $article->changerTitre(htmlspecialchars($_POST['titre']));
            }
            if (!empty($_POST['description'])) {
                $article->changerDescription(htmlspecialchars($_POST['description']));
            }
            if (!empty($_POST['article'])) {
                $article->changerContent(nl2br($_POST['article']));
            }
            if (!empty($_FILES['photo']['name'])) {
                $article->changerImage($_FILES['photo']);
            }
            if (!empty($_POST['titre']) || !empty($_POST['description']) || !empty($_POST['article']) || !empty($_FILES['photo']['name'])) {
                header('Location: index.php?page=article&id=' . $id_article);
            }
            $article = $article->getArticleById($id_article);
            // Charger la vue du profil
            require('./view/updateArticle.php');
        } else {
            header('Location: index.php?page=home');
            exit();
        }
    }
}
