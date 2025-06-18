@echo off
chcp 65001 >nul
echo 🔄 Nettoyage des caches Laravel...

echo.
echo Installation des dépendances Composer...
composer install

echo.
echo Application des migrations avec seed...
php artisan migrate:fresh --seed

echo.
echo Nettoyage et cache des événements...
php artisan event:clear
php artisan event:cache

echo.
echo Nettoyage des caches...
php artisan cache:clear
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan view:clear
php artisan view:cache
php artisan optimize:clear

echo.
echo ✅ Dépendances installées.
echo ✅ Migrations effectuées.
echo ✅ Caches Laravel nettoyés.

echo.
echo 🎯 Génération de l'autoload optimisé avec Composer...
composer dump-autoload -o
echo ✅ Autoload optimisé généré.

echo.
echo 🚀 Terminé !
pause