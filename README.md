# Arcadia

Zoo Arcadia est un site web pour un zoo virtuel, permettant aux visiteurs de découvrir différents habitats, d'explorer des animaux et de laisser des avis. Le site est construit avec PHP, JavaScript, HTML, et CSS, et utilise MariaDB pour les données SQL et MongoDB pour les données NoSQL.

## Table des Matières

- [Description](#description)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Utilisation](#utilisation)
- [Contact](#contact)

## Description

Arcadia est une plateforme interactive qui permet aux utilisateurs de découvrir des habitats animaliers, de consulter des informations sur les animaux et de laisser des avis sur leur visite. Le site utilise PHP pour le traitement côté serveur, JavaScript pour les interactions dynamiques, et est stylisé avec HTML et CSS.

## Prérequis

- **PHP** : Version 8.3.10
- **Serveur Web** : XAMPP
- **Base de Données SQL** : MariaDB
- **Base de Données NoSQL** : MongoDB Version 1.17.2
- **Composer** : Pour la gestion des dépendances PHP
- **Visual Studio Code** : Éditeur de code recommandé
- **Système d'exploitation** : Windows 11

## Installation

1. **Clonez le dépôt** :
   ```bash
        git clone  https://github.com/Lastef60/Arcadia.git

 
2. **Acceder au repertoire du projet** :
   ```bash
       cd zoo-arcadia

3. **Installez les dépendances PHP avec Composer** :
   ```bash
      composer install

4. **Configurez votre serveur XAMPP** :
    Placez le répertoire du projet dans le dossier htdocs de XAMPP.
    Configurez Apache et MySQL via le panneau de contrôle XAMPP.
   
5. **Importez les bases de données** :
    MariaDB : Importez les fichiers de base de données SQL dans votre serveur MariaDB.
    MongoDB : Configurez MongoDB et importez les données nécessaires via MongoDB Compass.
   
6. **Configurer les variables d'environnement** :
    Créez un fichier .env à la racine du projet pour configurer les variables d'environnement nécessaires comme les détails de connexion à la base de données.


## Configuration

Base de Données SQL : Configurez les paramètres de connexion dans config/database.php.
Base de Données NoSQL : Configurez les paramètres de connexion dans config/mongodb.php.
Vérifiez les permissions : Assurez-vous que les permissions sont correctement définies pour les répertoires de téléchargement (e.g., uploads).

## Utilisation
Démarrer XAMPP : Lancez Apache et MySQL depuis le panneau de contrôle XAMPP.
Accéder au Site : Ouvrez votre navigateur et accédez à http://localhost/zoo-arcadia.
Explorer les Fonctionnalités :
Découvrez les différents habitats et animaux.
Laissez des avis via le formulaire de contact.
Explorez les services proposés.

## Contact
Auteur : La stef
GitHub : Lastef60
