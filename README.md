# Proverbs Project

Init project (first time)


```
docker compose up -d --build
docker-compose exec php composer install
./vendor/bin/grumphp git:init
```

**Poison hosts file**

```sudo vi /etc/hosts``` (MacOS)

```127.0.0.1    proverbs.local.com```

## Env URL
http://proverbs.local.com


## Database StartUp
```
symfony console doctrine:database:create --if-not-exists
symfony console doctrine:schema:update --force
symfony console doctrine:fixtures:load
```

## Styles
```symfony console tailwind:build -w```
