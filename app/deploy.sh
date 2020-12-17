echo env ="$1";

if [ -n "$1" ]; then
  rm  .env;

if [ "$1" == "dev" ]; then
    echo "coppied dev env";
  cp /var/www/html/env/$1/DOD_env /var/www/html/$1/DOD/.env;
fi
if [ "$1" == "test" ]; then
  echo "coppied test env"
  cp /var/www/html/env/$1/DOD_env /var/www/html/$1/DOD/.env;
fi
if [ "$1" == "prod" ]; then
  cp /var/www/html/env/$1/DOD_env /var/www/html/$1/DOD/.env;
fi
  rm -rf vendor;
  composer install;
  yarn install;
  yarn encore dev;
  php bin/console do:mi:mi -n;
  php bin/console cache:clear;
else
  echo "First parameter not supplied."
fi

