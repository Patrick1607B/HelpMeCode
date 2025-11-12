FROM php:8.2-apache


# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev curl \
    nodejs npm
# Installation des extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    libicu-dev \
    curl \
 && docker-php-ext-install pdo pdo_mysql intl

# Activation de mod_rewrite pour Symfony
RUN a2enmod rewrite

# Installation de Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Définition du dossier de travail
WORKDIR /var/www/html

# Copie des fichiers du projet
COPY . .
RUN git config --global --add safe.directory /var/www/html

# Installation des dépendances Symfony
RUN composer install --no-interaction --optimize-autoloader

# Droits corrects
RUN chown -R www-data:www-data /var/www/html

# Copie de la config Apache
COPY docker/php/000-default.conf /etc/apache2/sites-available/000-default.conf

# Lancement d'Apache
CMD ["apache2-foreground"]
