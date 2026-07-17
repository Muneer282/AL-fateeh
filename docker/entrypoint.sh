#!/bin/sh
set -e

echo "🚀 Starting Al-Fateeh Application..."

cd /var/www/html

# ─────────────────────────────────────────
# Ensure storage directories exist
# ─────────────────────────────────────────
mkdir -p storage/logs \
         storage/framework/cache \
         storage/framework/sessions \
         storage/framework/views \
         bootstrap/cache

# ─────────────────────────────────────────
# Create supervisor log directory
# ─────────────────────────────────────────
mkdir -p /var/log/supervisor

# ─────────────────────────────────────────
# Set correct permissions
# ─────────────────────────────────────────
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# ─────────────────────────────────────────
# Laravel Optimization (Production)
# ─────────────────────────────────────────
if [ "${APP_ENV}" = "production" ]; then
    echo "⚡ Optimizing application for production..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
else
    echo "🔧 Running in development/local mode..."
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
fi

# ─────────────────────────────────────────
# Run database migrations
# ─────────────────────────────────────────
echo "🗄️  Running database migrations..."
php artisan migrate --force --no-interaction

# ─────────────────────────────────────────
# Create symlink for storage
# ─────────────────────────────────────────
if [ ! -L public/storage ]; then
    php artisan storage:link
fi

echo "✅ Application is ready!"

# ─────────────────────────────────────────
# Substitute $PORT in Nginx config (required for Render)
# ─────────────────────────────────────────
PORT=${PORT:-80}
export PORT
envsubst '${PORT}' < /etc/nginx/http.d/default.conf > /tmp/default.conf.tmp
mv /tmp/default.conf.tmp /etc/nginx/http.d/default.conf

echo "🌐 Nginx will listen on port: ${PORT}"

# ─────────────────────────────────────────
# Start Supervisor (manages nginx + php-fpm + queue)
# ─────────────────────────────────────────
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
