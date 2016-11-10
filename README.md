2DAM-Symfony3-Multisite
=======================
Multisite FOSRestBundlesymfony3 project to host different backedns for android appps


Instalation
===========
Instal composer[http://getcomposer.com] and the just run:
```
composer install
```
Or it is installed
```
composer update
```
# assets
## Generating comupiled assets

```
php bin/console assetic:dump --env=dev --no-debug
php bin/console assetic:dump
```
Apply watch
```
php bin/console assetic:watch
```
In case of problems:
```
php bin/console cache:clear --env=prod
``
tmpt
====

A Symfony project created on September 15, 2016, 1:24 am.
composer install symfony/console
