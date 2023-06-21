# Imagem base
FROM php:8.1.9-apache

# Diretório de trabalho
WORKDIR /var/www/html

# Instalar dependências
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Copiar arquivos do projeto
COPY . .

# Instalar dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --optimize-autoloader

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html/storage

# Executar migrations e seeders
RUN php artisan migrate --seed

# Expor a porta do Apache
EXPOSE 80

# Comando para iniciar o servidor Apache
CMD ["apache2-foreground"]
