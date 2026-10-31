
#!/bin/sh
set -e

PORT="${PORT:-10000}"

sed -i "s/Listen 80/Listen ${PORT}/" \
  /etc/apache2/ports.conf

sed -i "s/:80>/:${PORT}>/" \
  /etc/apache2/sites-available/000-default.conf

# Clear old Laravel configuration
php artisan config:clear

# Discover Laravel packages
php artisan package:discover --ansi

# Only migrate once correct database
# credentials are configured.
if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
    php artisan migrate --force
fi

# Start Laravel with Apache
exec apache2-foreground
