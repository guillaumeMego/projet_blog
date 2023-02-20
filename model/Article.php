<?php
require_once('./controller/controller.php');

class Articles extends Database
{

    private $_titre;
    private $_description;
    private $_article;
    private $_image;
    private $_idUsers;
    private $_created_at;
    private $_updated_at;

    /**
     * Constructeur de la classe Article
     */
    public function __construct($titre, $description, $article, $image, $idUsers, $created_at, $updated_at)
    {
        $this->_titre = $titre;
        $this->_description = $description;
        $this->_article = $article;
        $this->_image = $image;
        $this->_idUsers = $idUsers;
        $this->_created_at = $created_at;
        $this->_updated_at = $updated_at;
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
    public function getCreated_at()
    {
        return $this->_created_at;
    }
    public function setCreated_at($created_at)
    {
        $this->_created_at = $created_at;
    }
    public function getUpdated_at()
    {
        return $this->_updated_at;
    }
    public function setUpdated_at($updated_at)
    {
        $this->_updated_at = $updated_at;
    }

    /**
     * Cherche les informations de tous les articles dans la base de données
     * 
     * @return array Tableau contenant les informations de tous les articles
     */
    public static function getArticles()
    {
        $bdd = Database::connection();
        $requete = $bdd->prepare('SELECT a.*, u.username, u.mail FROM articles AS a LEFT JOIN users AS u ON a.user_id = u.id ORDER BY a.id DESC');
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }

    /**
     * Cherche les informations d'un seul article dans la base de données
     * 
     * @return array Tableau contenant les informations d'un article
     */
    public static function getArticlesOne()
    {
        $bdd = Database::connection();
        $requete = $bdd->prepare('SELECT a.*, u.username, u.mail FROM articles AS a LEFT JOIN users AS u ON a.user_id = u.id ORDER BY a.id DESC LIMIT 1');
        $requete->execute();
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $resultat;
    }

    /**
     * Cherche les informations d'un article dans la base de données
     * 
     * @return array Tableau contenant les informations d'un article
     */
    public static function getArticleById($id_article)
    {
        $bdd = Database::connection();
        $requete = $bdd->prepare('SELECT a.*, u.username, u.mail FROM articles AS a LEFT JOIN users AS u ON a.user_id = u.id WHERE a.id = :id');
        $requete->execute(array('id' => $id_article));
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat;
    }

    /**
     * Ajoute un article dans la base de données
     * 
     * @return bool True si l'article a été ajouté, false sinon
     */
    public static function ajoutArticle($titre, $description, $article, $image, $idUsers)
    {
        require_once('Verify.php');
        $bdd = Database::connection();
        if ($image = Verifier::imageUpload($image)) {
            $idUsers = $_SESSION['id'];
            $requete = $bdd->prepare('INSERT INTO articles (title, description, content, image_path, user_id) VALUES (?, ?, ?, ?, ?)');
            $result = $requete->execute([$titre, $description, $article, $image, $idUsers]);
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
    public static function ajoutLike($id_article)
    {

        $bdd = Database::connection();
        $requete = $bdd->prepare('UPDATE articles SET likes = likes + 1 WHERE id = :id');
        $result = $requete->execute(array('id' => $id_article));
        return $result;
    }

    /**
     * Supprime un article dans la base de données
     * 
     * @return bool True si l'article a été supprimé, false sinon
     */

    public static function deleteArticle($id_article)
    {
        $bdd = Database::connection();
        $id = 1; // L'ID de la ligne parente à supprimer

        $bdd = Database::connection();
        // Supprimer les enregistrements liés dans la table enfant
        $requete = $bdd->prepare('DELETE FROM likes WHERE article_id = :id');
        $requete->execute(['id' => $_GET['id']]);

        // Supprimer les enregistrements liés dans la table enfant
        $requete = $bdd->prepare('DELETE FROM comments WHERE article_id = :id');
        $requete->execute(['id' => $_GET['id']]);

        // Supprimer la ligne parente
        $requete = $bdd->prepare('DELETE FROM articles WHERE id = :id');
        $requete->execute(['id' => $_GET['id']]);

        return $requete;
    }

    public static function changerTitre($titre)
    {
        $id_article = $_GET['id'];
        $bdd = Database::connection();
        $requete = $bdd->prepare('UPDATE articles SET title = ? WHERE id = ?');
        $requete->execute([$titre, $id_article]);
    }
    public static function changerDescription($description)
    {
        $id_article = $_GET['id'];
        $bdd = Database::connection();
        $requete = $bdd->prepare('UPDATE articles SET description = ? WHERE id = ?');
        $requete->execute([$description, $id_article]);
    }
    public static function changerContent($article)
    {
        $id_article = $_GET['id'];
        $bdd = Database::connection();
        $requete = $bdd->prepare('UPDATE articles SET content = ? WHERE id = ?');
        $requete->execute([$article, $id_article]);
    }
    public static function changerImage($image)
    {
        $id_article = $_GET['id'];
        require_once('Verify.php');
        if ($image = Verifier::imageUpload($image)) {
            $bdd = Database::connection();
            $requete = $bdd->prepare('UPDATE articles SET image_path = ? WHERE id = ?');
            $requete->execute([$image, $id_article]);
        } else {
            return false;
        }
    }
}
