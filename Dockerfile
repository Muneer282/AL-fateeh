# ============================================================
# Stage 1: Build frontend assets (Node.js)
# ============================================================
FROM node:22-alpine AS frontend-builder

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci --ignore-scripts

COPY vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/

RUN npm run build

# ============================================================
# Stage 2: Install PHP dependencies (Composer)
# ============================================================
FROM composer:2.8 AS composer-builder

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --ignore-platform-reqs \
    --prefer-dist

COPY . .
RUN composer dump-autoload --optimize --no-dev

# ============================================================
# Stage 3: Final production image
# ============================================================
FROM php:8.3-fpm-alpine AS production

LABEL maintainer="Al-Fateeh"
LABEL description="Al-Fateeh Laravel Application"

# Install required PHP extensions and system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    gettext \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev \
    postgresql-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    # Temporary build tools needed by pecl
    autoconf \
    g++ \
    make \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del autoconf g++ make

WORKDIR /var/www/html

# Copy PHP dependencies from composer stage
COPY --from=composer-builder /app/vendor ./vendor

# Copy frontend build from node stage
COPY --from=frontend-builder /app/public/build ./public/build

# Copy application source
COPY . .

# Copy nginx configuration
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf

# Copy PHP configuration
COPY docker/php/php.ini /usr/local/etc/php/conf.d/app.ini
COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Copy supervisor configuration
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Expose port (Render uses $PORT env var, defaults to 80 locally)
EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
