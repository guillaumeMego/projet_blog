<?php

class MotDePasseOublie extends Database
{
    private $email;
    private $token;

    public function __construct($email, $token)
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
    public static function checkEmail($email)
    {
        // Créer une connexion à la base de données
        $bdd = Database::connection();

        // Préparer la requête SQL pour récupérer l'utilisateur correspondant à l'adresse email
        $req = $bdd->prepare('SELECT * FROM users WHERE mail = ?');
        $req->execute(array($email));

        // Récupérer le résultat de la requête
        $result = $req->fetch();

        // Si l'utilisateur n'existe pas, lancer une exception
        if ($result) {
            return true;
        } else {
            throw new Exception("L'adresse mail n'existe pas");
        }
    }

    /**
     * Fonction qui crée un token temporaire
     */
    public static function createToken($email)
    {
        // Créer un token temporaire
        $token = bin2hex(random_bytes(32));

        // Calculer la date d'expiration du token (par exemple, 1 heure à partir de maintenant)
        date_default_timezone_set('Europe/Paris');
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Inscrir le token dans la base de données
        $bdd = Database::connection();
        $req = $bdd->prepare('INSERT INTO tokens(token, mail, expiry) VALUES (?, ?, ?)');
        $req->execute(array($token, $email, $expiry));
        return $token;
    }

    /**
     * Fonction qui supprime le token de la base de données a sa date d'expiration
     */
    public static function deleteToken($token)
    {
        // Calculer la date et l'heure actuelles
        $now = date('Y-m-d H:i:s');

        // Créer une connexion à la base de données
        $bdd = Database::connection();

        // Supprimer les tokens expirés de la table "tokens"
        $req = $bdd->prepare('DELETE FROM tokens WHERE expiry <= ?');
        $req->execute(array($now));
    }


    /**
     * Envoi un email à l'utilisateur avec un lien contenant le token
     * @return void
     */
    public static function sendMail($token, $email)
    {
        $to = $email;
        // Définir le sujet du message
        $subject = 'Réinitialisation de mot de passe';

        // Définir le corps du message avec le token stocké dans l'attribut token de l'objet
        $message = 'Voici votre code de réinitialisation de mot de passe : ' . $token . "\r\n" .
            'Ce code est valable 1 heure.';

        // Définir les en-têtes de l'email pour spécifier l'adresse de l'expéditeur et l'adresse de réponse
        $headers = 'From: contact@guillaumeganne.com' . "\r\n" .
            'Reply-To: contact@guillaumeganne.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // Utiliser la fonction mail() de PHP pour envoyer l'e-mail avec les paramètres définis ci-dessus
        mail($to, $subject, $message, $headers);
    }

    /**
     * Fonction qui vérifie si le token existe dans la base de données
     */
    public static function checkToken($token)
    {
        // Créer une connexion à la base de données
        $bdd = Database::connection();

        // Préparer la requête SQL pour récupérer le token correspondant
        $req = $bdd->prepare('SELECT * FROM tokens WHERE token = ?');
        $req->execute(array($token));

        // Récupérer le résultat de la requête
        $result = $req->fetch();

        // Si le token n'existe pas, lancer une exception
        if ($result) {
            return true;
        } else {
            throw new Exception("Le token n'existe pas");
        }
    }

    /**
     * Fonction qui change le mot de passe de l'utilisateur
     */
    public static function changePassword($password, $token)
    {
        // Créer une connexion à la base de données
        $bdd = Database::connection();

        // Préparer la requête SQL pour récupérer l'utilisateur correspondant au token
        $req = $bdd->prepare('SELECT * FROM tokens WHERE token = ?');
        $req->execute(array($token));

        // Récupérer le résultat de la requête
        $result = $req->fetch();

        // Préparer la requête SQL pour modifier le mot de passe de l'utilisateur
        $req = $bdd->prepare('UPDATE users SET password = ? WHERE mail = ?');
        $req->execute(array($password, $result['mail']));

        // Supprimer le token de la table "tokens"
        $req = $bdd->prepare('DELETE FROM tokens WHERE token = ?');
        $req->execute(array($token));
    }
}
