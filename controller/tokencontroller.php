<?php

use Random\Engine\Secure;

class TokenController
{
    /**
     * Fonction token pour gérer la page de token
     */
    function token()
    {
        $error = '';
        $success = '';
        if (!empty($_POST['mail'])) {
            $email = $_POST['mail'];
            $motDePasseOublie = new MotDePasseOublie();
            if ($motDePasseOublie->checkEmail($email)) {
                $token = $motDePasseOublie->createToken($email);
                // Appel de la fonction qui envoie le mail
                $subject = 'Mot de passe oublié';
                $message = 'Pour changer votre mot de passe, veuillez cliquer sur le lien suivant : https://nailsbyno.com/index.php?page=changePassword&token=' . $token;

                if ($motDePasseOublie->sendMail($email, $subject, $message)) {
                    $success = "Un mail vous a été envoyé";
                    header('refresh:5;url=index.php?page=home');
                } else {
                    $error = "Une erreur est survenue lors de l'envoi du mail";
                }
            } else {
                $error = "L'adresse mail n'existe pas";
            }
        } else {
            $error = "Veuillez entrer une adresse mail";
        }

        if (!empty($error)) {
            require('view/token.php');
        }
        if (!empty($success)) {
            require('view/token.php');
        }
        require('./view/token.php');
    }

    /**
     * Fonction verifieToken pour gérer la page de vérification du token
     */
    function verifieToken()
    {
        $success = '';
        $error = '';

        if (!empty($_POST['password']) && !empty($_POST['token'])) {
            $token = $_POST['token'];
            $password = $_POST['password'];
            $motDePasseOublie = new MotDePasseOublie();
            $securite = new Securite();
            $password = $securite->chiffrer($password);
            $motDePasseOublie->changePassword($password, $token);
            header('Location: index.php?page=home');
        } else {
            // Récupérer le jeton dans
            if (isset($_POST['token']) || isset($_GET['token'])) {
                if ($token = $_POST['token'] ?? $_GET['token']) {
                    $checkMotDePasse = new MotDePasseOublie();
                    if ($checkMotDePasse->checkToken($token)) {
                        $success = "Entre un nouveau mot de passe";
                        // Le jeton est valide, afficher le formulaire de changement de mot de passe
                        require('./view/changePassword.php');
                    } else {
                        // Le jeton n'est pas valide, afficher un message d'erreur
                        $error = "Le lien n'est pas valide";
                    }
                }
            } else {
                // Le jeton n'est pas présent dans l'URL, afficher un message d'erreur
                $error = "Le lien n'est pas valide";
            }
        }
        if (!empty($error)) {
            require('view/changePassword.php');
        }
        if (!empty($success)) {
            require('view/changePassword.php');
        }
    }
}
