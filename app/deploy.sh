cp /opt/web/css-save/.env /opt/web/CSS-chat-app/app/
cp /opt/web/css-save/docker-compose.yml /opt/web/CSS-chat-app/
cd /opt/web/CSS-chat-app/
docker-compose exec php-fpm php bin/console do:mi:mi -q
docker-compose restart