# JsonsStatACar
## L'application qui simplfie la gestion de vos déplacement

### Installation
#### Prérequis :  
    git
    PHP 7.2^  
    MySQL  
    Composer  
#### Procédure :
`git clone https://github.com/Acima2/JsonStatacar.git`
##### Sous système Unix :
1. `cd JsonStatacar`  
2. `make install`  
3. Entrer votre mot de passe utilisateur quand demandé (pour l'initialisation de MySQL)  
4. Ouvrez [127.0.0.1:8000](http://127.0.0.1:8000)  

#### Sous Windows :
1. Ouvrez un terminal à la racine du depo `C:\.....\JsonsStatacar`
2. Avec une installation par-défaut de wamp64, executez simplement la commande  
`bash install.bat`

Sinon


1.  Rendez vous dans [PhpMyAdmin](localhost/phpmyadmin) et
  Créez un User ayant tous les droits avec les infos suivantes :  
`username = db_user` et `password = db_password`  
OU  
  Executez le script dbconfig.sql présent dans le répertoire de l'application

2. Copier-coller les commandes ci dessous :  
`composer install`    
`php bin/console doctrine:database:create --if-not-exists`  
`php bin/console doctrine:schema:update --force`  
`php bin/console doctrine:fixture:load --no-interaction`    
`php bin/console se:ru`

### Utilisation
Ouvrez [127.0.0.1:8000](http://127.0.0.1:8000)
Vous pouvez tester avec l'application en vous connectant avec l'email `admin@jsonstatacar.com` et le mot de passe `admin`
