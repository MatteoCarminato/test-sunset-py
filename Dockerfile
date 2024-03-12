# Imagem base do PHP 8.0 com suporte para Apache
FROM php:8.2-apache

# Instala as dependências do sistema operacional
RUN apt-get update && apt-get install -y \
        libpq-dev \
        libzip-dev \
        unzip \
        zip \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        zip

# Configurações do Apache
RUN a2enmod rewrite
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Copia os arquivos da aplicação para o container
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala as dependências do Laravel
RUN composer install

# Dar permissões de escrita no diretório de logs
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/database

RUN chmod -R 777 /var/www/html/storage
RUN chmod -R 777 /var/www/html/database

# Expõe a porta 80 do container
EXPOSE 80

# Inicia o servidor Apache
CMD ["apache2-foreground"]