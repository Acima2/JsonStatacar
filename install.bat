composer install --verbose
C:/wamp64/bin/mysql/mysql5.7.23/bin/mysql.exe -u root < dbconfig.sql
C:\wamp64\bin\mysql\mysql5.7.23\bin\mysql.exe -u root < dbconfig.sql
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixture:load --no-interaction
php bin/console se:ru