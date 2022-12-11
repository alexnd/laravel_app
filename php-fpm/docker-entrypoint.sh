#!/usr/bin/env sh
set -eu

if [ ! -f /app/.env ]; then
cp -f /etc/laravel-app.env /app/.env
fi

exec "$@"