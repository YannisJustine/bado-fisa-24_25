# Projet BADO-FISA

## Sommaire

- [Prérequis](#prérequis)
- [Configuration](#configuration)
- [Lancer les containers](#lancer-les-containers)
  - [Environnement de production](#environnement-de-production)
  - [Environnement de développement](#environnement-de-développement)
  - [Accéder à l'application](#accéder-à-lapplication)
  - [Arrêter les containers](#arrêter-les-containers)
  - [Créer les tables de la base de données](#créer-les-tables-de-la-base-de-données)
  - [Générer des valeurs de tests](#générer-des-valeurs-de-tests)
- [Supprimer les containers et les volumes](#supprimer-les-containers-et-les-volumes)
- [Reconstruire l'image](#reconstruire-limage)
- [Modifier les variables d'environnement à la volée pour Laravel](#modifier-les-variables-denvironnement-à-la-volée-pour-laravel)
- [Accéder à la base de données PostgreSQL](#accéder-à-la-base-de-données-postgresql)
- [Accéder à la base de données Redis](#accéder-à-la-base-de-données-redis)


## Prérequis

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Make](https://www.gnu.org/software/make/)
- [Git](https://git-scm.com/)

Veillez à correctement effectuer l'étape de configuration avant de lancer les containers.

## Configuration

Avant de construire l'image et de lancer les conteneurs, 
il faut modifier le fichier `.env.example` dans le dossier `src` et le renommer en `.env`.

## Lancer les containers

### Environnement de production
Pour lancer les containers, il suffit de lancer la commande suivante:
```bash
make prod
```

### Environnement de développement
Pour lancer le serveur de développement, il suffit de lancer la commande suivante:
```bash
make dev
```

Cela va lancer un serveur de développement sur le port 80.
Le dossier `src` est monté en volume dans le container, ce qui permet de voir les modifications en temps réel.

### Accéder à l'application
Pour accéder à l'application, il suffit d'ouvrir un navigateur et de se rendre à l'adresse suivante:
```
http://localhost
```

### Arrêter les containers
Pour arrêter les containers, il suffit de lancer la commande suivante:
```bash
make stop
```

### Créer les tables de la base de données
La première fois que vous lancez les containers, il faut lancer la commande suivante pour générer les tables de la base de données:
```bash
make migrate
```

### Générer des valeurs de tests
Pour générer des valeurs de tests, lancez la commande suivante:
```bash
make seed
```

## Supprimer les containers et les volumes
Pour supprimer les containers et les volumes, il suffit de lancer la commande suivante:
```bash
make clean
```

## Reconstruire l'image

Pour reconstruire l'image lors du lancemement des containers, il suffit de lancer la commande suivante:
```bash
make prod build=1
```

## Modifier les variables d'environnement à la volée pour Laravel

Pour modifier les variables d'environnement à la volée, il suffit de se connecter au container et de modifier le fichier `.env`:
```bash
make connect-apache
vim .env
```

Si vous avez besoin de redémarrer les processus pour prendre en compte les modifications, il suffit de lancer la commande suivante:
```bash
supervisorctl restart all
```

## Accéder à la base de données PostgreSQL

Pour accéder à la base de données, il suffit de lancer la commande suivante:
```bash
make connect-postgres
```

## Accéder à la base de données Redis

Pour accéder à la base de données, il suffit de lancer la commande suivante:
```bash
make connect-redis
```