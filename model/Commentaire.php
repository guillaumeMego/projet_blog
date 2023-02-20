<?php

class Commentaire extends Database
{
    private $_articleId;
    private $_userId;
    private $_content;
    private $_created_at;
    private $_updated_at;

    public function __construct($articleId, $userId, $content, $created_at, $updated_at)
    {
        $this->_articleId = $articleId;
        $this->_userId = $userId;
        $this->_content = $content;
        $this->_created_at = $created_at;
        $this->_updated_at = $updated_at;
    }

    public function getArticleId()
    {
        return $this->_articleId;
    }
    public function setArticleId($articleId)
    {
        $this->_articleId = $articleId;
    }
    public function getUserId()
    {
        return $this->_userId;
    }
    public function setUserId($userId)
    {
        $this->_userId = $userId;
    }
    public function getContent()
    {
        return $this->_content;
    }
    public function setContent($content)
    {
        $this->_content = $content;
    }
    public function getCreatedAt()
    {
        return $this->_created_at;
    }
    public function setCreatedAt($created_at)
    {
        $this->_created_at = $created_at;
    }
    public function getUpdatedAt()
    {
        return $this->_updated_at;
    }
    public function setUpdatedAt($updated_at)
    {
        $this->_updated_at = $updated_at;
    }

    /**
     * Méthode permettant d'ajouter un commentaire
     * 
     * @param int $articleId
     * @param int $userId
     * @param string $content
     */
    public static function addComment($articleId, $userId, $content)
    {
        $articleId = $_GET['id'];
        $userId = $_SESSION['id'];
        try {
            $bdd = Database::connection();
            $req = $bdd->prepare('INSERT INTO comments (article_id, user_id, content, created_at, updated_at) VALUES (:article_id, :user_id, :content, NOW(), NOW())');
            $req->execute(array(
                'article_id' => $articleId,
                'user_id' => $userId,
                'content' => $content
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Méthode permettant de récupérer les commentaires d'un article
     * 
     * @param int $articleId
     * @return array
     */
    public static function getComments($articleId)
    {
        try {
            $bdd = Database::connection();
            $req = $bdd->prepare('SELECT c.*, u.username FROM comments AS c LEFT JOIN users AS u ON c.user_id = u.id WHERE c.article_id = :article_id ORDER BY c.id DESC');
            $req->execute(array(
                'article_id' => $articleId
            ));
            $comments = $req->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Méthode qui permet de recuperer l'id de l'auteur d'un commentaire
     * 
     * @param int $id
     * @return int
     */
    public static function getAuthorId($id)
    {
        try {
            $bdd = Database::connection();
            $req = $bdd->prepare('SELECT user_id FROM comments WHERE id = :id');
            $req->execute(array(
                'id' => $id
            ));
            $authorId = $req->fetchColumn();
            return $authorId;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Méthode permettant de supprimer un commentaire
     * 
     * @param int $id
     */
    public static function deleteComment($id)
    {
        try {
            $bdd = Database::connection();
            $req = $bdd->prepare('DELETE FROM comments WHERE id = :id');
            $req->execute(array(
                'id' => $id
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Méthode permettant de compter le nombre de commentaires dans un article
     * 
     * @param int $articleId
     * @return int
     */
    public static function countComments($articleId)
    {
        try {
            $bdd = Database::connection();
            $req = $bdd->prepare('SELECT COUNT(*) FROM comments WHERE article_id = :article_id');
            $req->execute(array(
                'article_id' => $articleId
            ));
            $nbComments = $req->fetchColumn();
            return $nbComments;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
