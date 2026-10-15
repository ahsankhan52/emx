#!/usr/bin/env bash
# Runs ON the Hostinger server, piped in via `ssh ... bash -s < this-file`.
# Requires two env vars passed over the SSH command: IS_PROD, DEPLOY_PATH.
set -euo pipefail

cd "$DEPLOY_PATH"

echo ">> composer install"
# --no-scripts: Hostinger disables proc_open, so composer's post-autoload-dump
# hook (`@php artisan package:discover`, which spawns a subprocess) crashes.
# We skip scripts here and run package discovery directly below.
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

echo ">> discover packages (direct; no subprocess needed)"
php artisan package:discover --ansi

echo ">> rebuilding caches"
php artisan config:clear
php artisan cache:clear || true
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link 2>/dev/null || true   # symlink() is disabled on Hostinger; harmless

if [ "${IS_PROD}" = "true" ]; then
  echo ">> production: running migrations"
  php artisan migrate --force
else
  echo ">> staging: blocking search engines via robots.txt"
  printf 'User-agent: *\nDisallow: /\n' > public/robots.txt
fi

echo ">> done"
