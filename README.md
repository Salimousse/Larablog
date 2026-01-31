# Larablog

Projet de blog développé avec Laravel , ce site permet de rechercher des blogs par un filtre de recherche selon leurs catégories ou tags avec possibilité de liker.
D'un autre côté , il est possible d'en créer en choisissant une ou plusieurs catégories et / ou tags.


# Installation minimale

Étapes essentielles pour démarrer le projet localement :

1) Cloner le dépôt
```bash
git clone <repo-url>
cd Larablog-
```

2) Installer les dépendances PHP
```bash
composer install
```

3) Copier le fichier d'environnement et générer la clé
```bash
copy .env.example .env    # Windows
php artisan key:generate
```

> **Important :** modifiez les variables de connexion à la base de données dans le fichier `.env` (DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD) avant de lancer les migrations.

4) Lancer les migrations
```bash
php artisan migrate
```

5) (Optionnel) Pour compiler les assets et le développement front
```bash
npm install
npm run dev
```

6) Lancer le serveur local
```bash
php artisan serve
```

C'est tout — le projet est prêt à être utilisé.