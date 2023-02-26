# Blog en PHP objet et MVC

Ce projet est un exemple de blog créé en PHP objet et utilisant l'architecture MVC, sans framework. Il comporte un système d'authentification pour les utilisateurs, ainsi que des fonctionnalités de gestion d'articles et de commentaires.

## Fonctionnalités

Le blog comprend les fonctionnalités suivantes :

- Système de connexion pour les utilisateurs existants
- Système d'inscription pour les nouveaux utilisateurs
- Upload de profil pour les utilisateurs
- Suppression de profil pour les utilisateurs
- Création, modification et suppression d'articles pour l'utilisateur authentifié
- Suppression de n'importe quel commentaire pour les utilisateurs authentifiés
- Système de commentaires pour les articles et les utilisateurs connectés
- Système de likes pour les utilisateurs connectés

## Installation

Pour installer ce projet sur votre propre serveur, suivez ces étapes :

1. Clonez le repository GitHub sur votre propre serveur.
2. Créez une base de données MySQL pour le projet.
3. Compléter le fichier `config.php`. Remplissez les informations de connexion à la base de données dans ce fichier en fonction de votre configuration.
4. Exécutez le script SQL fourni (`database.sql`) pour créer les tables de base de données.
5. Exécutez le serveur Apache et ouvrez le site web dans votre navigateur.

## Utilisation

Une fois que le serveur est en cours d'exécution, vous pouvez accéder à l'application via votre navigateur web à l'adresse du site web.

Vous pouvez vous inscrire en utilisant le lien "S'inscrire" sur la page de connexion.

Vous pouvez également ajouter des commentaires et des likes aux articles existants en utilisant le formulaire en bas de chaque article.

Pour l'utilisateur authentifié, vous pouvez créer, modifier ou supprimer des articles en cliquant sur les liens prévus à cet effet.
Pour vous connecter en tant qu'utilisateur authentifié, veuillez entrer les informations de connexion suivantes :

1. E-mail : test.test@test.com
2. Mot de passe  : testAdmin1

## Version en ligne

Une version en ligne de ce projet est disponible à l'adresse suivante : https://nailsbyno.com Vous pouvez explorer les fonctionnalités du projet et tester son fonctionnement.

N'hésitez pas à me contacter si vous rencontrez des problèmes ou si vous avez des questions concernant le projet.




