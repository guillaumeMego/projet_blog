<?php

require_once 'Manager.php';

/**
 * Classe UserManager pour gérer les utilisateurs
 */
class Verifier extends Database
{
    /**
     * Vérifie la syntaxe d'une adresse email
     *
     * @param string $mail Adresse email à vérifier
     * @return bool True si l'adresse email est valide, false sinon
     */
    public function syntaxeEmail($mail)
    {
        // Utilisation de la fonction filter_var pour vérifier la syntaxe de l'adresse email
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Vérifie si l'adresse email existe déjà dans la base de données
     *
     * @param string $mail Adresse email à vérifier
     * @return bool True si l'adresse email existe déjà, false sinon
     */
    public function emailExist($mail)
    {
        $bdd = Database::connection();
        $req = $bdd->prepare('SELECT COUNT(*) AS nb FROM users WHERE mail = ?');
        $req->execute(array($mail));
        $result = $req->fetch();
        if ($result['nb'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifie si le pseudo existe déjà dans la base de données
     * 
     * @param string $username Pseudo à vérifier
     * @return bool True si le pseudo existe déjà, false sinon
     */
    public function usernameExist($username)
    {
        $bdd = Database::connection();
        $req = $bdd->prepare('SELECT COUNT(*) AS nb FROM users WHERE username = ?');
        $req->execute(array($username));
        $result = $req->fetch();
        if ($result['nb'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Vérifie si l'adresse email existe déjà dans la base de données
     *
     * @param string $mail Adresse email à vérifier
     * @return bool True si l'adresse email existe déjà, false sinon
     */
    public function imageUpload($image)
    {
        $tailleMax = 2097152;
        $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
        if ($image['size'] <= $tailleMax) {
            $extensionUpload = strtolower(substr(strrchr($image['name'], '.'), 1));
            if (in_array($extensionUpload, $extensionsValides)) {
                $chemin = "public/asset/img/article/" . $image['name'];
                $resultat = move_uploaded_file($image['tmp_name'], $chemin);
                if ($resultat) {
                    return $chemin;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
