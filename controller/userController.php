<?php

// Inclure le fichier userManager pour accéder à la classe UserManager

use Random\Engine\Secure;

require_once './model/UserManager.php';

// Enregistrement de la fonction d'autochargement de classes
spl_autoload_register(function ($className) {
    require_once('model/' . $className . '.php');
});

class UserController
{
    /**
     * Fonction home pour gérer la page d'accueil
     */
    public function home()
    {
        $securite    = new Securite();
        $userManager = new UserManager();
        $like        = new Likes();
        $commentaire = new Commentaire();

        $articles = new Articles();
        $articles = $articles->getArticlesOne();

        require_once './view/blog.php';
    }

    /**
     * Fonction pageConnect pour gérer la page de connexion
     */
    public function pageConnexion()
    {
        require './view/connexion.php';
    }

    /**
     * Fonction addUser pour gérer l'ajout d'un nouvel utilisateur
     * 
     * @param string $username Le nom d'utilisateur
     * @param string $mail L'adresse e-mail
     * @param string $password Le mot de passe
     */
    public function addUser()
    {
        if (!empty($_POST['username']) && !empty($_POST['mail']) && !empty($_POST['password'])) {
            // Inclure les fichiers nécessaires pour valider les données d'entrée
            require './model/Verifier.php';

            // Initialiser un tableau pour stocker les messages d'erreur
            $error = '';

            // Récupérer les données d'entrée
            $username = htmlspecialchars($_POST['username']);
            $mail = htmlspecialchars($_POST['mail']);
            $password = htmlspecialchars($_POST['password']);

            // Valider les données d'entrée
            // Verifier la syntaxe de l'adresse mail
            $verifier = new Verifier();
            if (!$verifier->syntaxeEmail($mail)) {
                $error = "Adresse mail non valide";
            }

            // Vérifier si l'adresse mail ou le nom d'utilisateur existe déjà
            $userManager = new UserManager();
            if ($userManager->getUserByMail($mail)) {
                $error = "Adresse mail déjà utilisée";
            }

            if ($verifier->usernameExist($username)) {
                $error = "Nom d'utilisateur déjà utilisé";
            }

            // Valider les caractères du mot de passe
            $securite = new Securite();
            if (!$securite->syntaxePassword($password)) {
                $error = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial";
            }

            // Chiffrer le mot de passe
            $password = $securite->chiffrer($password);

            // Créer un nouvel objet UserManager
            $user = new UserManager($username, $mail, $password);

            // Si des erreurs sont détectées, afficher la vue d'inscription avec les messages d'erreur
            if (!empty($error)) {
                require_once 'view/inscription.php';
            } else {
                // Ajouter l'utilisateur en utilisant la méthode setUser de la classe UserManager
                try {
                    $user->setUser($username, $mail, $password);
                } catch (Exception $e) {
                    $error = "Impossible d'ajouter l'utilisateur pour le moment. ";
                }
                // Rediriger vers la page de connexion
                header('Location: index.php?page=connexion');
                exit();
            }
        } else {
            require_once 'view/inscription.php';
        }
    }

    /**
     *Fonction connexion pour gérer la connexion d'un utilisateur
     * @param string $mail L'adresse e-mail
     * @param string $password Le mot de passe
     */
    public function connexion()
    {
        if (!empty($_POST['mail']) && !empty($_POST['password'])) {

            $error = '';

            $mail = htmlspecialchars($_POST['mail']);
            $password = htmlspecialchars($_POST['password']);

            // Créer un nouvel objet UserManager
            $newconnect = new UserManager($mail, $password);

            // Vérifier les informations de connexion en utilisant la méthode verifyUser de la classe UserManager
            $result = $newconnect->verifyUser($mail, $password);
            if (!$result['found']) {
                $error = "Votre e-mail ou votre mot de passe est incorrect";
            } else if (!$result['valid']) {
                $error = "Votre e-mail ou votre mot de passe est incorrect";
            } else {
                // Démarrer la session
                session_start();
                // Créer les variables de session en utilisant la méthode creerLesSessions de la classe UserManager
                $newconnect->creerLesSessions($mail);
                // Rediriger vers la page du blog
                header('location: index.php?page=home');
                exit();
            }

            // Si des erreurs sont détectées, afficher la vue d'inscription avec les messages d'erreur
            if (!empty($error)) {
                require_once 'view/connexion.php';
            }
        } else {
            $this->pageConnexion();
        }
    }

    /**
     * Fonction profil pour gérer la page du profil
     */
    public function profil()
    {
        require_once './model/Verifier.php';
        if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
            $error = '';
            $success = '';

            $verifier = new Verifier();
            $userManager = new UserManager();
            $securite = new Securite();

            if (!empty($_POST['username'])) {
                $username = htmlspecialchars($_POST['username']);
                // Appel de la fonction changerPseudo
                if ($verifier->usernameExist(htmlspecialchars($username))) {
                    $error = "Pseudo déjà utilisé";
                } else {
                    $userManager->changerPseudo(htmlspecialchars($username));
                    $success = "Votre pseudo a été modifié";
                }
            }

            if (!empty($_POST['mail'])) {
                // Appel de la fonction changerMail
                $mail = htmlspecialchars($_POST['mail']);
                if ($verifier->syntaxeEmail($mail)) {
                    if (!$verifier->emailExist($mail)) {
                        $userManager->changerMail($mail);
                        $success = "Votre e-maila été modifié";
                    } else {
                        $error = "Email déjà utilisé";
                    }
                } else {
                    $error = "Email non valide";
                }
            }

            if (!empty($_POST['password'])) {
                $password = htmlspecialchars($_POST['password']);
                if (!$securite->syntaxePassword($password)) {
                    $error = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial";
                } else {
                    $password = $securite->chiffrer($password);
                    $userManager->changerPassword($password);
                    $success = "Votre mot de passe a été modifié";
                }
            }

            if (!empty($error) || !empty($success)) {
                require_once 'view/profil.php';
            }
        } else {
            header('location: index.php?page=home');
            exit();
        }

        // Charger la vue du profil
        require('./view/profil.php');
    }

    /**
     * Fonction pour supprimer un utilisateur
     */
    public function deleteProfil()
    {
        if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
            $id = $_SESSION['id'];
            $userManager = new UserManager();
            $userManager->deleteUser($id);
            header('location: deconnexion');
        } else {
            header('location: deconnexion');
            exit();
        }
    }

    /**
     * Fonction qui permet d'afficher la page erreur
     */
    public function pageErreur($errorMessage)
    {
        $securite    = new Securite();
        $userManager = new UserManager();
        $like        = new Likes();
        $commentaire = new Commentaire();
        require_once 'view/errorView.php';
    }

    /**
     * Fonction logout pour gérer la déconnexion d'un utilisateur
     */
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php');
    }
}
