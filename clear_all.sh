#!/bin/bash

echo "🔄 Nettoyage des caches Laravel..."

composer install

php artisan migrate:fresh --seed

php artisan event:clear
php artisan event:cache
php artisan cache:clear
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan view:clear
php artisan view:cache
php artisan optimize:clear

echo "Dépendences installées"

echo "Migrations effectuées"

echo "✅ Caches Laravel nettoyés."

echo "🎯 Génération de l'autoload optimisé avec Composer..."
composer dump-autoload -o
echo "✅ Autoload optimisé généré."

echo "🚀 Terminé !"
