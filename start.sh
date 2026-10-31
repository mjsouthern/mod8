
#!/bin/sh
set -e

# Listen on Render's configured HTTP port
PORT="${PORT:-10000}"

sed -i "s/Listen 80/Listen ${PORT}/" \
    /etc/apache2/ports.conf

sed -i "s/:80>/:${PORT}>/" \
    /etc/apache2/sites-available/000-default.conf

# Prepare Laravel
php artisan package:discover --ansi
php artisan storage:link || true

# Create database tables on first deployment
# Existing migrations will be skipped automatically
php artisan migrate --force

# Start Apache
exec apache2-foreground
