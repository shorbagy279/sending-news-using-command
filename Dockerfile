# Use the official PHP image with CLI
FROM php:8.2-cli

# Install system dependencies and PHP extensions required for Laravel
RUN apt-get update && apt-get install -y \
    build-essential \
    libssl-dev \
    libz-dev \
    unzip \
    libpq-dev \
    libcurl4-openssl-dev \
    gnutls-dev \
    git \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install PCNTL extension (needed for Laravel queue and worker management)
RUN docker-php-ext-install pcntl

# Install Composer (PHP package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install other PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_mysql bcmath

# Set the working directory in the container to /var/www
WORKDIR /var/www

# Copy the application code from your local machine to the container
COPY . /var/www

# Install Laravel dependencies using Composer
RUN composer install --optimize-autoloader  # --no-dev
# --no-dev --optimize-autoloader

ENV PATH="/root/.composer/vendor/bin:$PATH"


# Ensure correct permissions for Laravel storage and cache directories
RUN mkdir -p  bootstrap/cache storage/framework//{sessions,views,cache} ; chown -R www-data:www-data storage bootstrap/cache ; chmod -R 775 storage bootstrap/cache

# Set entrypoint script for container startup (to handle any environment setup)
RUN chmod +x docker/entrypoint.sh ; chmod +x docker/wait-for-it.sh

# Clean up apt-get cache to reduce image size
RUN apt-get clean

# Expose the HTTP port for the container
EXPOSE 80

# Set the entrypoint to start the app using the provided entrypoint script
ENTRYPOINT ["/var/www/docker/entrypoint.sh"]
