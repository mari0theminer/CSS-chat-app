# CSS-chat-app

##WICHTIG 
PHP VERSION ^7.2.5 php 8 wird nicht gehen 
##Instalation 

###all in one docker (Windows performance ist leider mä)

1. docker-compose up -d
2. docker-compose run  php-fpm  /bin/bash /application/deploy.sh

### Manual Installation
1. In der .env die daten Bank connection anpassen(see https://symfony.com/doc/current/doctrine.html#configuring-the-database)
   Als beispiel MYSQL "mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
2.  Composer installiern als Paket manger (https://getcomposer.org/download/)
3. prüfen ob php in der %PATH% variable ist "php -v"
4. deploy script ausfüren 
    1. linux(./app/deploy.sh)
    2. windows(app\deploy.bat)