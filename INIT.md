# Démarrage d'un Projet MVC avec Twig, Composer et phpdotenv

Ce guide vous accompagne pas à pas pour démarrer un projet en architecture MVC (Modèle-Vue-Contrôleur) avec les outils suivants :

- **Twig** : Moteur de templates pour séparer la logique de présentation.
- **Composer** : Gestionnaire de dépendances PHP.
- **phpdotenv** : Chargement des variables d'environnement depuis un fichier `.env`.

---

## 📋 1. Pré-requis

- PHP installé (version 7.4+ recommandée)
- [![Composer](https://img.shields.io/badge/Composer-Install-blue.svg)](https://getcomposer.org/)

Pour vérifier la bonne installation de Composer, ouvrez un terminal et tapez :

```bash
composer --version
```

---

## 🚀 2. Initialiser le projet et installer les dépendances

Ouvrez un terminal à la racine de votre futur projet et lancez :

```bash
composer init
```

Suivez les instructions pour créer le fichier `composer.json`.

Ensuite, installez Twig et phpdotenv :

```bash
composer require twig/twig vlucas/phpdotenv
```

Ou vous pouvez tout simplement faire :

```bash
composer update
```

---

## 🔄 3. Mettre à jour l'autoload

Après avoir installé vos dépendances, il est important de mettre à jour l'autoload de Composer pour s'assurer que toutes les classes sont correctement chargées. Exécutez la commande suivante :

```bash
composer dump-autoload
```

---

## 📂 4. Structure de base du projet MVC

Voici une structure simple recommandée :

```
/app
│
├── /src
│   ├── /config
│   │   └── Database.php
│   ├── /controllers
│   │   └── HomeController.php
│   ├── /models
│   ├── /router
│   └── /views
│       ├── /layout
│       │   ├── home.html.twig
│       │   └── home-layout.html.twig     (layout classique)
│       └── /errors
│
│
├── .env             (fichier des variables d'environnement)
├── composer.json
└── vendor/          (dossier géré par Composer)
```

---

## ⚙️ 5. Configuration du fichier `.env`

Créez un fichier `.env` à la racine du projet avec vos variables d'environnement, par exemple :

```
DB_HOST=
DB_NAME=
DB_USER=
DB_PASS=
```

Ces variables seront accessibles dans votre code PHP via `phpdotenv`.

---

## 🌐 6. Lancer le projet

Depuis la racine du projet, vous pouvez lancer un serveur PHP intégré (utile pour du développement local) :

```bash
php -S localhost:8000 -t public
```

Ensuite, ouvrez votre navigateur et allez sur [http://localhost:8000](http://localhost:8000) pour voir votre projet en action.

---

## 🎉 Conclusion

Vous avez maintenant toutes les étapes nécessaires pour démarrer votre projet MVC avec Twig, Composer et phpdotenv. Bonne chance dans votre développement !

---

## 📚 Documentation

Pour plus d'informations, consultez la documentation officielle :

- [Twig Documentation](https://twig.symfony.com/doc/)
- [Composer Documentation](https://getcomposer.org/doc/)
- [phpdotenv Documentation](https://github.com/vlucas/phpdotenv)