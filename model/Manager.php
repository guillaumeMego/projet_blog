<?php
// Inclure le fichier de configuration pour accéder aux constantes de connexion à la base de données
require_once('./config/config.php');


/**
 * Classe Database pour gérer la connexion à la base de données
 */
class Database
{
    /**
     * Connexion à la base de données
     * 
     * @return PDO L'objet de connexion à la base de données
     */
    static function connection()
    {
        // try catch pour gerer les exceptions et erreurs
        try {
            // Créer une nouvelle connexion à la base de données en utilisant les constantes de configuration
            $bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
            // Configurer les options pour renvoyer les erreurs en tant qu'exceptions
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            // Lancer une exception avec un message d'erreur si la connexion échoue
            throw new Exception('Erreur : ' . $e->getMessage());
        }
        // Retourner l'objet de connexion à la base de données
        return $bdd;
    }
}
