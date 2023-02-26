<?php
class Securite
{
    // Générer un hash de mot de passe
    public function chiffrer($password)
    {
        // Générer un hash de mot de passe en utilisant la fonction password_hash
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Verifier les caractère du mot de passe
    public function syntaxePassword($password)
    {
        // Vérifier si le mot de passe contient au moins 8 caractères
        if (strlen($password) < 8) {
            return false;
        }
        // Vérifier si le mot de passe contient au moins une lettre minuscule
        if (!preg_match("#[a-z]+#", $password)) {
            return false;
        }
        // Vérifier si le mot de passe contient au moins une lettre majuscule
        if (!preg_match("#[A-Z]+#", $password)) {
            return false;
        }
        // Vérifier si le mot de passe contient au moins un chiffre
        if (!preg_match("#[0-9]+#", $password)) {
            return false;
        }
        return true;
    }

    // Vérifier si un mot de passe correspond à un hash
    public function verifier($password, $hash)
    {
        // Vérifier si le mot de passe correspond à un hash en utilisant la fonction password_verify
        return password_verify($password, $hash);
    }
    // Verifie si l'utilisateur est connecté
    public function estConnecte()
    {
        if (!empty($_SESSION['id']) && $_SESSION['id'] > 0) {
            $isLoggedIn = true;
        } else {
            $isLoggedIn = false;
        }
        return $isLoggedIn;
    }
}
