<?php

class Likes extends Database
{
    private $article_id;
    private $user_id;
    private $created_at;

    /**
     * Constructeur de la classe Likes
     */
    public function __construct($article_id, $user_id, $created_at)
    {
        $this->article_id = $article_id;
        $this->user_id = $user_id;
        $this->created_at = $created_at;
    }

    /**
     * Getters et setters
     */
    public function getArticleId()
    {
        return $this->article_id;
    }
    public function setArticleId($article_id)
    {
        $this->article_id = $article_id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }


    /**
     * Fonction pour ajouter un like
     * 
     * @param int $id_article
     */
    public static function addLike($articleId, $userId)
    {
        $bdd = Database::connection();
        $requete = $bdd->prepare('INSERT INTO likes (article_id, user_id) VALUES (?, ?)');
        $requete->execute([$articleId, $userId]);
    }


    /**
     * Fonction pour supprimer un like
     * 
     * @param int $id_article
     */
    public static function disLike($id_like)
    {
        $bdd = Database::connection();
        $req = $bdd->prepare('DELETE FROM likes WHERE id = :id_like');
        $req->execute(array(
            'id_like' => $id_like
        ));
    }


    /**
     * Fonction pour compter le nombre de like d'un article
     * 
     * @param int $id_article
     * @return int
     */
    public static function countLike($id_article)
    {
        $bdd = Database::connection();
        $req = $bdd->prepare('SELECT IFNULL(COUNT(*), 0) FROM likes WHERE article_id = :article_id');
        $req->execute(array(
            'article_id' => $id_article
        ));
        $result = $req->fetch();
        return $result[0];
    }

    /**
     * Fonction pour vérifier si l'utilisateur a déjà liké l'article
     * 
     * @param int $id_article
     * @return bool
     */
    public static function userLikedArticle($userId, $articleId)
    {
        $bdd = Database::connection();
        $requete = $bdd->prepare('SELECT COUNT(*) FROM likes WHERE user_id = ? AND article_id = ?');
        $requete->execute([$userId, $articleId]);
        $resultat = $requete->fetch();
        return $resultat[0] > 0;
    }

    /**
     * Fonction pour récuperer l'id du like de l'utilisateur
     * 
     * @param int $id_article
     * @return int
     */
    public static function getLikeId($id_article)
    {
        $bdd = Database::connection();
        $req = $bdd->prepare('SELECT id FROM likes WHERE article_id = :article_id AND user_id = :user_id');
        $req->execute(array(
            'article_id' => $id_article,
            'user_id' => $_SESSION['id']
        ));
        $result = $req->fetch();
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
}
