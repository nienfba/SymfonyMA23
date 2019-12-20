# Symfony Blog - MA23


## Installation
-   Cloner le dépôt distant avec 
	- `$ git clone https://github.com/nienfba/SymfonyMA23.git votreDossier/`
-   Maintenant il s'agit d'installer Symfony et ses dépendances, la base de données et d'y injecter le contenu pour celà en 
ligne de commande à la racine de `votreDossier/` :
-   `$ composer install` ou `$php composer.phar install`. Cette commande peut prendre plusieurs minutes :(
-   une fois le framework et ses dépendances mises à jour, modifier le fichier dist.env à la racine et renommez le en .env. Trouvez le ligne 
	- `$ DATABASE_URL=mysql://user:password@127.0.0.1:3306/votreBase` 
	- Remplacez user et password et votreBase par vos valeurs locales. Pour une installation standard de Wamp ou 
Mamp (ici le mot de passe est vide et la base s'appelle blogSymfony !!) : 
	- `$ DATABASE_URL=mysql://root:@127.0.0.1:3306/blogSymfony`
-   Nous allons maintenant créer la base de données, c'est automatique avec symfony !!: 
	- `$ php bin/console doctrine:database:create`
-   Puis créer les tables de la bases : 
	- `$ php bin/console make:migration` 
	- `$ php bin/console doctrine:migrations:migrate` 
	- Il faut répondre "y" à la question "WARNING ! ...."
-   Puis nous allons insérer les données dans la base : 
	- `$ php bin/console doctrine:fixtures:load` 
	- Répondre "y" à la question "WARNING ! ...."
-   OUF ! All is done !! Go to Work ;)
-   Maintenant lancez le serveur Web PHP et rendez vous sur l'adresse indiquée !
	- `$ php bin/console server:run`

Je vous aime !
