#!/usr/bin/env sh

ip=$(docker inspect cpq_database_1 | grep IPAddress | tail -1 | tr -s ' ' | tr -d ',' | cut -d' ' -f3 | tr -d '"')

mysql -uhomestead -psecret -h$ip homestead < db-clean.sql 

docker-compose exec app php artisan migrate:refresh --seed

mysqldump -uhomestead -psecret -h$ip homestead > db.sql
