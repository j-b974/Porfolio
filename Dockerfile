# Utiliser une image PHP officielle avec Apache
FROM php:8.2-apache

# Configuration de l'environnement
ENV APACHE_DOCUMENT_ROOT=/var/www/public

# Met à jour les paquets et installe les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

# Active les extensions PHP nécessaires (SQLite3)
RUN docker-php-ext-install pdo_sqlite

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration Apache
RUN a2enmod rewrite

# remplace la configuration de apache
COPY ./Server.conf /etc/apache2/sites-available/000-default.conf

# Copie des fichiers de l'application dans le conteneur
COPY . /var/www/

# Configuration du propriétaire des fichiers
RUN chown -R www-data:www-data /var/www/
# Installation des dépendances avec Composer

RUN cd /var/www/ && \
composer update --no-interaction --no-ansi && composer install --no-interaction --no-ansi

# change emplacement curseur commande
WORKDIR /var/www/

# Fixe les permissions pour Apache
RUN chown -R www-data:www-data /var/www/ \
    && chmod -R 755 /var/www/

#Exposition du port 80
EXPOSE 80

# Commande pour exécuter Apache
CMD ["apache2-foreground"]
