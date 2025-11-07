Description : 
Le site nécéssite une connexion pour accéder au contenu
2 rôle sont possibles, le rôle Admin et le role USER.

Vous allez pouvoir créer des Chargements en fonction de Client, Transporteur et de Produits.

Pour se connecter : 

Admin : 
email: sudboistest@admin.com
mdp: sudboistestAdmin
Rôle : 
	- Côté Chargement : a le droit de Visualier, Créer, Modifier, Supprimer.
	- Côté Client : a le droit de Visualier, Créer, Modifier.
	- Côté Produit : a le droit de Visualier, Créer, Modifier.
	- Côté Transporteur : a le droit de Visualier, Créer, Modifier.


Public : 
email: sudboistest@public.com
mdp: sudboistestPublic
Rôle : 
	- Côté Chargement : a le droit de Visualier, Créer.
	- Côté Client : a le droit de Visualier.
	- Côté Produit : a le droit de Visualier.
	- Côté Transporteur : a le droit de Visualier.


Instructions : 
OPTION 1 : Avec Docker
# 1) démarrer la stack
docker compose up -d --build

# 2) entrer dans le conteneur app
docker compose -it app bash

# 3) (dans le conteneur) Récupération du projet test
git clone https://github.com/khmerdao/sud_bois_test.git ./

# 4)(dans le conteneur) installer deps & préparer la base
composer install

Si vous avez une base de donnée en local 
# 1) cp .env .env.local
# 2) modifier la variable DATABASE_URL par vos identifiants.
# 3) Si vous êtes déja en postgreSQl passer a l'étape 6
# 4) Sinon supprimer la Version de la migration présent dans le dossier /migrations
# 5) Création de la migration en fonction de votre BDD
php bin/console make:migration

6.0) (optionnel) Création de la base de donnée, cela permet de vérifier si oui ou non elle existe
php bin/console doctrine:database:create --if-not-exists

# 6) Création des tables dans la Base de donnée
php bin/console d:m:m

# 7) Insertion des données (fixture + user) dans la base de donnée
php bin/console doctrine:fixtures:load --no-interaction

OPTION 2 : Sans Docker
Prérequis : 
PHP 8.2
Composer 2.2.*

1) Installation des dépendances
composer install

2) en ce qui concerne la connexion a la base de donnée voir OPTION 1 partie : *Si vous avez une base de donnée en local 

3) Lancement du serveur :
php -S localhost:8000 -t public


Visualisation de l'interface : https://localhost:8000
