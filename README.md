Projet de Réseau Social en PHP

Préambule: Ceci est un résumé des différents points que nous devions réaliser dans le cadre de notre project collectif. Vous retrouverez également les consignes nécessaires au lancement du projet. ⚠️ Les seeds de bases de données ne sont pas présents !
Description

Ce projet est un réseau social inspiré de plateformes comme Twitter et Facebook. Il permet aux utilisateurs de publier des messages, de voir les messages des autres utilisateurs, et de filtrer les messages par utilisateur et par mot-clé. Le projet est divisé en plusieurs niveaux de complexité, permettant une progression étape par étape.
Objectifs

    Niveau 1 : Afficher les messages des utilisateurs à partir d'une base de données.
    Niveau 2 : Permettre aux utilisateurs de s'inscrire, de se connecter et d'ajouter de nouveaux messages.
    Niveau 3 : Améliorer l'interface et les fonctionnalités du site, ainsi que la conception de la base de données.

Fonctionnalités

    Affichage des derniers messages
    Affichage des messages par utilisateur
    Affichage des messages par mot-clé
    Authentification des utilisateurs
    Publication de nouveaux messages
    Gestion des sessions et des droits d'accès

Technologies Utilisées

    Langages : PHP, HTML, CSS
    Base de données : MySQL (ou MariaDB)
    Serveur : Apache (via MAMP, WAMP ou XAMPP)
    Bibliothèques : Optionnellement jQuery pour AJAX

Installation
Prérequis

    Serveur Apache avec PHP (MAMP, WAMP, XAMPP)
    MySQL ou MariaDB

Étapes d'installation

    Importation de la base de données :
        Récupérer le fichier Niveau1.sql de l'archive Niveau1.zip.
        Se connecter à phpMyAdmin (probablement à l'adresse http://localhost/phpmyadmin/).
        Importer le fichier Niveau1.sql dans une nouvelle base de données appelée socialnetwork.

    Installation des fichiers du projet :
        Extraire les fichiers de l'archive Niveau1.zip.
        Copier le répertoire Niveau1 dans le répertoire htdocs de votre installation Apache.
        Renommer le répertoire en resoc_n1.

    Configuration :
        Assurez-vous que le serveur Apache et MySQL sont en cours d'exécution.
        Accédez à l'URL http://localhost/resoc_n1/news.php pour vérifier que le projet est correctement installé.

Utilisation
Navigation dans le projet

    news.php : Affiche les derniers messages.
    admin.php : Interface d'administration.
    settings.php : Page de paramètres utilisateur.
    wall.php : Mur d'un utilisateur spécifique.
    feed.php : Fil des utilisateurs suivis.
    tags.php : Messages associés à un mot-clé.
    subscriptions.php : Gestion des abonnements.
    followers.php : Gestion des abonnés.

Authentification et publication

    Pour le niveau 1, les fonctionnalités d'authentification et de publication sont considérées comme déjà réalisées.
    À partir du niveau 2, vous pourrez implémenter les formulaires d'inscription, de connexion et de publication de messages.

Captures d'écran

![image](https://github.com/user-attachments/assets/7fa20977-490f-4df7-aafa-ff40ffbf4b72)

Exemple de page d'accueil Page d'accueil

![image](https://github.com/user-attachments/assets/e0ccbaa6-b1e3-4199-8262-0f57529f8a9a)

Example de la page mur Page mur



Crédits

Ce projet a été réalisé dans le cadre d'un exercice pédagogique visant à enseigner les bases du développement web avec PHP et MySQL.
Ressources

    Tutoriel PHP
    Documentation MySQL
    Documentation Apache
