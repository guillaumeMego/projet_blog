<?php

// Inclure le fichier userManager pour accéder à la classe UserManager
require('./model/userManager.php');

/**
 * Fonction home pour gérer la page d'accueil
 */
function home()
{
    // Charger la vue d'inscription
    require('./view/inscription.php');
}

/**
 * Fonction pageConnect pour gérer la page de connexion
 */
function pageConnect()
{
    // Charger la vue de connexion
    require('./view/connexion.php');
}


/**
 * Fonction addUser pour gérer l'ajout d'un nouvel utilisateur
 * 
 * @param string $username Le nom d'utilisateur
 * @param string $mail L'adresse e-mail
 * @param string $password Le mot de passe
 * 
 * @throws Exception Si l'adresse e-mail est non valide ou si l'ajout de l'utilisateur échoue
 */
function addUser($username, $mail, $password)
{
    // Inclure les fichiers nécessaires pour vérifier l'adresse e-mail et crypter le mot de passe
    require_once('./model/Verify.php');
    require_once('./model/Securite.php');

    // Créer un nouvel objet UserManager
    $newUser = new UserManager($username, $mail, $password);

    // Crypter le mot de passe
    $password = Securite::chiffrer($password);

    // Vérifier la validité de l'adresse e-mail
    if (Verifier::syntaxeEmail($mail)) {
        if (Verifier::emailExist($mail)) {
            throw new Exception("Cette adresse e-mail est déjà utilisée");
        } else {
            if (Verifier::usernameExist($username)) {
                throw new Exception("Ce nom d'utilisateur est déjà utilisé");
            } else {
                // Ajouter l'utilisateur à la base de données en utilisant la méthode setUser de la classe UserManager
                $result = $newUser->setUser($username, $mail, $password);

                // Si l'ajout de l'utilisateur échoue, lancer une exception
                if ($result === false) {
                    throw new Exception("Impossible d'ajouter l'utilisateur pour le moment");
                } else {
                    // Rediriger vers la page de connexion
                    pageConnect();
                    exit();
                }
            }
        }
    } else {
        // Lancer une exception si l'adresse e-mail est non valide
        throw new Exception('Adresse e-mail non valide');
    }
}

/**
 *Fonction connexion pour gérer la connexion d'un utilisateur

 * @param string $mail L'adresse e-mail
 * @param string $password Le mot de passe
 * 
 * @throws Exception Si la vérification de l'utilisateur échoue
 */
function connexion($mail, $password)
{
    require_once('./model/userManager.php');
    // Créer un nouvel objet UserManager
    $newconnect = new UserManager("", $mail, $password);

    // Vérifier les informations de connexion en utilisant la méthode verifyUser de la classe UserManager
    $result = $newconnect->verifyUser($mail, $password);

    // Si la vérification échoue, lancer une exception
    if ($result === false) {
        throw new Exception("Impossible de se connecter pour le moment");
    } else {
        // Démarrer la session
        session_start();

        // Créer les variables de session en utilisant la méthode creerLesSessions de la classe UserManager
        $newconnect->creerLesSessions($mail);
        // Rediriger vers la page du blog
        header('location: index.php?page=home');
        exit();
    }
}

/**
 * Fonction profil pour gérer la page du profil
 */
function profil()
{
    require_once('./model/Verify.php');
    session_start();
    if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
        if (!empty($_POST['username'])) {
            // Appel de la fonction changerPseudo
            if (!Verifier::usernameExist(htmlspecialchars($_POST['username']))) {
                userManager::changerPseudo(htmlspecialchars($_POST['username']));
            } else {
                throw new Exception("Pseudo déjà utilisé");
            }
        }
        if (!empty($_POST['mail'])) {
            // Appel de la fonction changerMail
            $mail = htmlspecialchars($_POST['mail']);
            if (Verifier::syntaxeEmail($mail)) {
                if (!Verifier::emailExist($mail)) {
                    userManager::changerMail($mail);
                } else {
                    throw new Exception("Email déjà utilisé");
                }
            } else {
                throw new Exception("Email non valide");
            }
        }
        if (!empty($_POST['password'])) {
            // Appel de la fonction changerPassword
            $password = Securite::chiffrer(htmlspecialchars($_POST['password']));
            userManager::changerPassword($password);
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
function deleteProfil()
{
    session_start();
    if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
        $id = $_SESSION['id'];
        userManager::deleteUser($id);
        header('location: deconnexion');
    } else {
        header('location: deconnexion');
        exit();
    }
}

/**
 * Fonction logout pour gérer la déconnexion d'un utilisateur
 */
function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php');
}
