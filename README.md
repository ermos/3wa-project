# Hotelio
> Interface de réservation de chambre d'hotel

Ce projet à été réalisé afin de valider le diplôme RNCP de la formation
développeur web au sein de l'école numérique 3W Academy.

L'application à été réaliser from scratch et sur une période assez courte,
de plus aucun test unitaire ou audit à été effectuer.
Elle n'est donc pas utilisable dans un environnement de production en l'état actuel.

En cas de réutilisation, à votre charge de faire le nécessaire.

Vous pouvez trouver une démo ici : https://hotelio.smiti.fr/

# Pré-requis
- PHP 8 (avec les extensions pdo et pdo-mysql)
- MariaDB 10.5.7 (ou MySQL)
- Nginx

# Installation

#### 1) Importer le projet

```bash
git clone git@github.com:ermos/hotelio.git
cd hotelio
```

#### 1) Importer la base de donnée

```bash
cd docs
mysql -h 127.0.0.1 -P 3306 -u root < database.sql
```

#### 2) Lancer docker-compose dans le dossier `deployments`

```bash
cd ../deployments
docker-compose up -d
```

#### 3) Accéder à l'application

Rendez-vous sur http://localhost:8300/ si vous n'avez pas changer le port dans le fichier `docker-compose`,
si tout est OK, vous pouvez vous connecter avec les identifiants `admin`:`admin`.