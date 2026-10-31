
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
    # php artisan migrate --force
    echo "Checking Render environment variables..."

    php -r '
    echo "DB_CONNECTION: ".(getenv("DB_CONNECTION") ?: "NOT SET").PHP_EOL;
    echo "DB_URL: ".(getenv("DB_URL") ? "SET" : "NOT SET").PHP_EOL;
    echo "DATABASE_URL: ".(getenv("DATABASE_URL") ? "SET" : "NOT SET").PHP_EOL;
    '

    php artisan config:clear
fi

# Start Laravel with Apache
exec apache2-foreground
