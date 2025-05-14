# 📱 Synapse - Réseau Social en PHP (MVC)

**Synapse** est un projet de réseau social développé en PHP en utilisant le modèle **MVC** (Model-View-Controller). Il permet aux utilisateurs de se connecter, publier des stories, gérer leurs profils et leurs relations (système d’amis). Ce projet est destiné à explorer la logique des réseaux sociaux tout en respectant une architecture propre.

## 🚀 Fonctionnalités

- ✅ Authentification (Inscription / Connexion)
- 🖼️ Système de stories (ajout, affichage, expiration)
- 👤 Gestion des utilisateurs (profil, photo, bannière, bio)
- 👥 Système d’amis (invitation, acceptation, suppression)
- 📅 Dates et interactions dynamiques
- 💾 Base de données MySQL avec structure relationnelle

## 🛠️ Technologies Utilisées

- **PHP** (Architecture MVC)
- **MySQL** (Base de données)
- **HTML/CSS** (Interface utilisateur)
- **JavaScript** (Fonctionnalités dynamiques)
- **Bootstrap** (Design responsive)
- **XAMPP** (Serveur local)

## 📂 Structure du projet

```
synapse/
├── app/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   └── core/
├── public/
│   ├── assets/
│   └── index.php
├── config/
│   └── database.php
├── .htaccess
└── README.md
```

## 🧑‍💻 Base de données (Table `user`)

Voici les champs principaux de la table `user` :

- `id_user` (INT, PK)
- `prenom` (VARCHAR)
- `nom` (VARCHAR)
- `date_naissance` (DATE)
- `email` (VARCHAR)
- `password` (VARCHAR, hashé)
- `photo_profil` (VARCHAR)
- `banner` (VARCHAR)
- `bio` (TEXT)

## 🧪 Lancer le projet en local

1. Cloner le dépôt :
   ```bash
   git clone https://github.com/votre-utilisateur/synapse.git
   ```
2. Placer le projet dans le dossier `htdocs/` de XAMPP.
3. Importer la base de données `synapse.sql` via phpMyAdmin.
4. Modifier les informations de connexion dans `config/database.php`.
5. Lancer Apache et MySQL via XAMPP.
6. Accéder à [http://localhost/synapse/public](http://localhost/synapse/public)

## 📌 Auteurs

Projet réalisé par :

- **Ton Nom**
- [Ajoute d'autres collaborateurs si nécessaire]

## 📃 Licence

Ce projet est open-source et disponible sous la licence [MIT](LICENSE).
