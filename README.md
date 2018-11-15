# JsonsStatACar
## L'application qui simplfie la gestion de vos déplacement

### Installation
Prérequis :  
    PHP 7.2^  
    MySQL  
    Composer  

`git clone https://github.com/Acima2/JsonStatacar.git`  
`cd JsonStatacar`  
`make install`  
Entrer votre mot de passe utilisateur quand demandé (pour l'initialisation de MySQL)  

Si un message d'erreur apparait, rendez vous dans [PhpMyAdmin](localhost/phpmyadmin) et  
#### Option 1 :  
Créez un User ayant tous les droits avec les infos suivantes :  
`username = db_user` et `password = db_password`  
Puis relancez `make install`  
#### Option 2 :  
Executez le script dbconfig.sql présent dans le répertoire de l'application  
Puis relancez `make install`  

Ouvrez [127.0.0.1:8000](http://127.0.0.1:8000)