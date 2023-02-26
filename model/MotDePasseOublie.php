<?php

class MotDePasseOublie extends Database
{
    private $email;
    private $token;

    public function __construct($email = '', $token = '')
    {
        $this->email = $email;
        $this->token = $token;
    }

    // Getters
    public function getEmail()
    {
        return $this->email;
    }
    public function getToken()
    {
        return $this->token;
    }

    // Setters
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Fonction qui verifie si l'email existe dans la base de données et qui crée un token
     */
    public function checkEmail($email)
    {
        // Créer une connexion à la base de données
        $bdd = Database::connection();

        // Préparer la requête SQL pour récupérer l'utilisateur correspondant à l'adresse email
        try {
            $req = $bdd->prepare('SELECT * FROM users WHERE mail = ?');
            $req->execute(array($email));
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // Récupérer le résultat de la requête
        $result = $req->fetch();

        // Si l'utilisateur n'existe pas, lancer une exception
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Fonction qui crée un token temporaire
     */
    public function createToken($email)
    {
        // Créer un token temporaire
        $token = bin2hex(random_bytes(32));

        // Calculer la date d'expiration du token (par exemple, 1 heure à partir de maintenant)
        date_default_timezone_set('Europe/Paris');
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Inscrir le token dans la base de données
        $bdd = Database::connection();
        try {
            $req = $bdd->prepare('INSERT INTO tokens(token, mail, expiry) VALUES (?, ?, ?)');
            $req->execute(array($token, $email, $expiry));
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $token;
    }

    /**
     * Fonction qui supprime le token de la base de données a sa date d'expiration
     */
    public function deleteToken()
    {
        // Calculer la date et l'heure actuelles
        $now = date('Y-m-d H:i:s');

        // Créer une connexion à la base de données
        $bdd = Database::connection();

        // Supprimer les tokens expirés de la table "tokens"
        try {
            $req = $bdd->prepare('DELETE FROM tokens WHERE expiry <= ?');
            $req->execute(array($now));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    /**
     * Fonction qui vérifie si le token existe dans la base de données
     */
    public function checkToken($token)
    {
        // Créer une connexion à la base de données
        $bdd = Database::connection();

        // Préparer la requête SQL pour récupérer le token correspondant
        try {
            $req = $bdd->prepare('SELECT * FROM tokens WHERE token = ?');
            $req->execute(array($token));
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // Récupérer le résultat de la requête
        $result = $req->fetch();

        // Si le token n'existe pas, lancer une exception
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Fonction qui change le mot de passe de l'utilisateur
     */
    public function changePassword($password, $token)
    {
        // Créer une connexion à la base de données
        $bdd = Database::connection();

        // Préparer la requête SQL pour récupérer l'utilisateur correspondant au token
        try {
            $req = $bdd->prepare('SELECT mail FROM tokens WHERE token = ?');
            $req->execute(array($token));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $result = $req->fetch();
        $mail = $result['mail'];

        // Préparer la requête SQL pour modifier le mot de passe de l'utilisateur
        try {
            $req = $bdd->prepare('UPDATE users SET password = ? WHERE mail = ?');
            $req->execute(array($password, $mail));
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // Supprimer le token de la table "tokens"
        try {
            $req = $bdd->prepare('DELETE FROM tokens WHERE token = ?');
            $req->execute(array($token));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->deleteToken();
    }

    /**
     * Fonction qui envoie un mail à l'utilisateur avec un lien pour changer son mot de passe
     */
    public function sendMail($to, $subject, $message)
    {
        $headers = "From: guillaume.ganne@gmail.com\r\n";
        $headers .= "Reply-To: guillaume.ganne@gmail.com\r\n";
        $headers .= "Content-Type: text/html\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
}
