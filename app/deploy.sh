#/bin/bash
cd $PWD/app
composer install;
php bin/console  doctrine:database:create --if-not-exists;
php bin/console do:mi:mi -q;
