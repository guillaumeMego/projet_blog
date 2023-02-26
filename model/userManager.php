<?php

require_once 'Manager.php';
/**
 * Classe UserManager pour gérer les utilisateurs
 */
class UserManager extends Database
{
    private $_username;
    private $_mail;
    private $_password;

    /**
     * Constructeur de la classe UserManager
     */
    public function __construct($username = "", $mail = "", $password = "")
    {
        $this->_username = $username;
        $this->_mail = $mail;
        $this->_password = $password;
    }

    /**
     * Getters et setters
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function getMail()
    {
        return $this->_mail;
    }
    public function setMail($mail)
    {
        $this->_mail = $mail;
    }
    public function getPassword()
    {
        return $this->_password;
    }
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * Ajouter un nouvel utilisateur à la base de données
     */
    public function setUser($username, $mail, $password)
    {
        // Connexion à la base de données
        $bdd = Database::connection();

        // Préparation de la requête d'insertion
        $requete = $bdd->prepare('INSERT INTO users(username,mail,password) VALUES(?,?,?)');

        // Exécution de la requête
        $result = $requete->execute([$username, $mail, $password]);

        // Retour du résultat de l'exécution
        return $result;
    }

    /**
     * Verification du doublon d'un mail
     */
    public function getUserByMail($mail)
    {
        $bdd = Database::connection();
        $requete = $bdd->prepare('SELECT * FROM users WHERE mail = ?');
        $requete->execute([$mail]);
        return $requete->fetch();
    }

    /**
     * Récupération des informations d'un utilisateur en utilisant son adresse e-mail
     * 
     * @param string $mail Adresse e-mail
     * @return array Tableau contenant les informations de l'utilisateur
     */
    public function getUser($mail)
    {
        // Connexion à la base de données
        $bdd = Database::connection();

        // Préparation de la requête de sélection
        $requete = $bdd->prepare('SELECT * FROM users WHERE mail = ?');

        // Exécution de la requête
        $requete->execute([$mail]);

        // Récupération des informations de l'utilisateur
        $user = $requete->fetchAll();

        // Retour des informations de l'utilisateur
        return $user;
    }


    /**
     * Vérification de l'existence d'un utilisateur en utilisant son adresse e-mail et son mot de passe
     */
    public function verifyUser($mail, $password)
    {
        require_once('./model/Securite.php');
        // Connexion à la base de données
        $bdd = Database::connection();

        // Préparation de la requête de sélection
        $requete = $bdd->prepare('SELECT password FROM users WHERE mail = ?');

        // Exécution de la requête
        $requete->execute([$mail]);

        // Récupération des informations de l'utilisateur
        $user = $requete->fetch();

        // Vérification du nombre de lignes renvoyées par la requête
        if ($requete->rowCount() > 0) {
            $securite = new Securite();
            // Utilisateur trouvé
            if ($securite->verifier($password, $user['password'])) {
                // Mot de passe correct
                return array("found" => true, "valid" => true);
            } else {
                // Mot de passe incorrect
                return array("found" => true, "valid" => false);
            }
        } else {
            // Utilisateur non trouvé
            return array("found" => false, "valid" => false);
        }
    }

    /**
     * Modification du profil d'un utilisateur
     * 
     * @param string $username Nom d'utilisateur
     * @param string $mail Adresse e-mail
     * @param string $password Mot de passe
     * 
     */
    public function changerPseudo($username)
    {
        $bdd = Database::connection();
        $requete = $bdd->prepare('UPDATE users SET username = ? WHERE id = ?');
        $requete->execute([$username, $_SESSION['id']]);
    }
    public function changerMail($mail)
    {
        $bdd = Database::connection();
        $requete = $bdd->prepare('UPDATE users SET mail = ? WHERE id = ?');
        $requete->execute([$mail, $_SESSION['id']]);
    }
    public function changerPassword($password)
    {
        $bdd = Database::connection();
        $requete = $bdd->prepare('UPDATE users SET password = ? WHERE id = ?');
        $requete->execute([$password, $_SESSION['id']]);
    }

    /**
     * Supprimer un utilisateur
     */
    public function deleteUser($id)
    {
        $bdd = Database::connection();

        $requete = $bdd->prepare('DELETE FROM comments WHERE user_id = :id');
        $requete->execute(['id' => $_SESSION['id']]);

        $requete = $bdd->prepare('DELETE FROM likes WHERE user_id = :id');
        $requete->execute(['id' => $_SESSION['id']]);

        $requete = $bdd->prepare('DELETE FROM users WHERE id = ?');
        $requete->execute([$_SESSION['id']]);
    }

    /**
     * Verifie si l'utilisateur a une autorisation auth
     * 
     * @return bool
     */
    public function hasAuth()
    {
        $bdd = Database::connection();
        $requete = $bdd->prepare('SELECT * FROM users WHERE id = ?');
        $requete->execute([$_SESSION['id']]);
        $user = $requete->fetch();
        if ($user['auth'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Créer les sessions de l'utilisateur
     */
    public function creerLesSessions($mail)
    {
        $user = $this->getUserByMail($mail);

        $_SESSION['connect'] = 1;
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['mail'] = $user['mail'];
    }
}
