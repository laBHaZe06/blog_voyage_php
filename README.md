# Blog de Voyage

Ce projet est un blog de voyage développé en PHP natif utilisant le design pattern MVC (Modèle-Vue-Contrôleur) pour la partie back-end et ReactJS pour le front-end.
En cour...
## Fonctionnalités

- Affichage des articles de blog
- Ajout, édition et suppression d'articles (pour les utilisateurs authentifiés)
- Authentification des utilisateurs
- Gestion des commentaires sur les articles
- Mise en cache des pages pour améliorer les performances

## Architecture

Le projet suit une architecture MVC pour organiser le code de manière modulaire et maintenable :

- **Modèle** : Contient la logique métier et l'accès aux données. Les modèles représentent les données de l'application et interagissent avec la base de données.

- **Vue** : Gère l'affichage des données à l'utilisateur. Dans notre cas, ReactJS est utilisé pour créer des interfaces utilisateur dynamiques et interactives.

- **Contrôleur** : Fait le lien entre le modèle et la vue. Il récupère les données du modèle et les transmet à la vue pour l'affichage.

## Technologies Utilisées

### Back-end (PHP)

- PHP 8.1
- MySQL (ou une autre base de données supportée par PDO)
- Apache (ou un autre serveur web)

### Front-end (ReactJS)

- ReactJS
- HTML5
- CSS3
- JavaScript (ES6+)
- Axios (pour les requêtes HTTP)

## Installation

1. Clonez ce dépôt sur votre machine locale :

   ```bash
   git clone https://github.com/votre-utilisateur/blog-de-voyage.git
   ```

2. Lancer docker
 ```bash
docker-compose up --build
```
3.Votre serveur se trouvera sur le port 8000 et le front sur le port 3000
