<?php
class Securite
{
    // Générer un hash de mot de passe
    public static function chiffrer($password)
    {
        // Générer un hash de mot de passe en utilisant la fonction password_hash
        return password_hash($password, PASSWORD_DEFAULT);
    }
    // Vérifier si un mot de passe correspond à un hash
    public static function verifier($password, $hash)
    {
        // Vérifier si le mot de passe correspond à un hash en utilisant la fonction password_verify
        return password_verify($password, $hash);
    }
    // Verifie si l'utilisateur est connecté
    public static function estConnecte()
    {
        if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }
        return $isLoggedIn;
    }
}
