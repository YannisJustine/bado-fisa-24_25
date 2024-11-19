Pour lancer les containers, il suffit de lancer la commande suivante:
```bash
make prod
```

Pour arrêter les containers, il suffit de lancer la commande suivante:
```bash
make stop
```

La première fois que vous lancez les containers, il faut lancer la commande suivante pour générer les tables de la base de données:
```bash
make migrate
```

Pour générer des valeurs de tests, lancez la commande suivante:
```bash
make seed
```

Pour supprimer les containers et les volumes, il suffit de lancer la commande suivante:
```bash
make clean
```

Pour accéder à l'application, il suffit d'ouvrir un navigateur et de se rendre à l'adresse suivante:
```
http://localhost
```

Pour lancer le serveur de développement, il suffit de lancer la commande suivante:
```bash
make dev
```

Cela va lancer un serveur de développement sur le port 8080.
Le dossier `src` est monté en volume dans le container, ce qui permet de voir les modifications en temps réel.