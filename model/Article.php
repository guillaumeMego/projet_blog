<?php
require_once('./controller/userController.php');
require_once('./controller/articleController.php');

class Articles extends Database
{
    private $_titre;
    private $_description;
    private $_article;
    private $_image;
    private $_idUsers;

    /**
     * Constructeur de la classe Article
     */
    public function __construct($titre = '', $description = '', $article = '', $image = '', $idUsers = '')
    {
        $this->_titre = $titre;
        $this->_description = $description;
        $this->_article = $article;
        $this->_image = $image;
        $this->_idUsers = $idUsers;
    }


    /**
     * Getters et setters
     */
    public function getTitre()
    {
        return $this->_titre;
    }
    public function setTitre($titre)
    {
        $this->_titre = $titre;
    }
    public function getDescription()
    {
        return $this->_description;
    }
    public function setDescription($description)
    {
        $this->_description = $description;
    }
    public function getArticle()
    {
        return $this->_article;
    }
    public function setArticle($article)
    {
        $this->_article = $article;
    }
    public function getImage()
    {
        return $this->_image;
    }
    public function setImage($image)
    {
        $this->_image = $image;
    }
    public function getIdUsers()
    {
        return $this->_idUsers;
    }
    public function setIdUsers($idUsers)
    {
        $this->_idUsers = $idUsers;
    }

    /**
     * Cherche les informations de tous les articles dans la base de données
     * 
     * @return array Tableau contenant les informations de tous les articles
     */
    public function getArticles()
    {
        $bdd = Database::connection();
        try {
            $requete = $bdd->prepare('SELECT a.*, u.username, u.mail FROM articles AS a LEFT JOIN users AS u ON a.user_id = u.id ORDER BY a.id DESC');
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        return $resultat;
    }

    /**
     * Cherche les informations d'un seul article dans la base de données
     * 
     * @return array Tableau contenant les informations d'un article
     */
    public function getArticlesOne()
    {
        $bdd = Database::connection();
        try {
            $requete = $bdd->prepare('SELECT a.*, u.username, u.mail FROM articles AS a LEFT JOIN users AS u ON a.user_id = u.id ORDER BY a.id DESC LIMIT 1');
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        return $resultat;
    }

    /**
     * Cherche les informations d'un article dans la base de données
     * 
     * @return array Tableau contenant les informations d'un article
     */
    public  function getArticleById($id_article)
    {
        $bdd = Database::connection();
        try {
            $requete = $bdd->prepare('SELECT a.*, u.username, u.mail FROM articles AS a LEFT JOIN users AS u ON a.user_id = u.id WHERE a.id = :id');
            $requete->execute(array('id' => $id_article));
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        return $resultat;
    }

    /**
     * Ajoute un article dans la base de données
     * 
     * @return bool True si l'article a été ajouté, false sinon
     */
    public function addArticle($titre, $description, $article, $image, $idUsers)
    {
        $bdd = Database::connection();
        $verifier = new Verifier();
        if ($image = $verifier->imageUpload($image)) {
            try {
                $requete = $bdd->prepare('INSERT INTO articles(title, description, content, image_path, user_id) VALUES (?, ?, ?, ?, ?)');
                $result = $requete->execute([$titre, $description, $article, $image, $idUsers]);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $result;
        } else {
            return false;
        }
    }



    /**
     * Ajout d'un like sur l'article dans la base de données
     * 
     * @return bool True si le like a été ajouté, false sinon
     */
    public function ajoutLike($id_article)
    {
        $bdd = Database::connection();
        try {
            $requete = $bdd->prepare('INSERT INTO likes(article_id, user_id) VALUES (?, ?)');
            $result = $requete->execute([$id_article, $_SESSION['id']]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Supprime un article dans la base de données
     * 
     * @return bool True si l'article a été supprimé, false sinon
     */

    public function deleteArticle($id_article)
    {
        $bdd = Database::connection();

        try {
            // Supprimer les enregistrements liés dans la table enfant
            $requete = $bdd->prepare('DELETE FROM likes WHERE article_id = :id');
            $requete->execute(['id' => $_GET['id']]);

            // Supprimer les enregistrements liés dans la table enfant
            $requete = $bdd->prepare('DELETE FROM comments WHERE article_id = :id');
            $requete->execute(['id' => $_GET['id']]);

            // Supprimer la ligne parente
            $requete = $bdd->prepare('DELETE FROM articles WHERE id = :id');
            $requete->execute(['id' => $_GET['id']]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $requete;
    }

    /**
     * Modifie le titre de l'article dans la base de données
     * 
     * @return bool True si l'article a été modifié, false sinon
     */
    public function changerTitre($titre)
    {
        $id_article = $_GET['id'];
        $bdd = Database::connection();
        try {
            $requete = $bdd->prepare('UPDATE articles SET title = ? WHERE id = ?');
            $requete->execute([$titre, $id_article]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $requete;
    }

    /**
     * Modifie la description de l'article dans la base de données
     * 
     * @return bool True si l'article a été modifié, false sinon
     */
    public static function changerDescription($description)
    {
        $id_article = $_GET['id'];
        $bdd = Database::connection();
        try {
            $requete = $bdd->prepare('UPDATE articles SET description = ? WHERE id = ?');
            $requete->execute([$description, $id_article]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $requete;
    }

    /**
     * Modifie le contenu de l'article dans la base de données
     */
    public static function changerContent($article)
    {
        $id_article = $_GET['id'];
        $bdd = Database::connection();
        try {
            $article = nl2br($article);
            $requete = $bdd->prepare('UPDATE articles SET content = ? WHERE id = ?');
            $requete->execute([$article, $id_article]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $requete;
    }

    /**
     * Modifie l'image de l'article dans la base de données
     */
    public static function changerImage($image)
    {
        $id_article = $_GET['id'];
        require_once('Verifier.php');
        $verifier = new Verifier();
        $image = $verifier->imageUpload($image);
        if ($image) {
            $bdd = Database::connection();
            $requete = $bdd->prepare('UPDATE articles SET image_path = ? WHERE id = ?');
            $requete->execute([$image, $id_article]);
        } else {
            return false;
        }
        return $requete;
    }
}
