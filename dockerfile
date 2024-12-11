# Usar una imagen base de PHP
FROM php:8.1-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y libssl-dev libcurl4-openssl-dev

# Instalar dependencias para PHP (como librerías de MQTT)
RUN docker-php-ext-install curl

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html/

# Establecer los permisos adecuados para los archivos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 para el servidor web
EXPOSE 80

# Configurar el contenedor para que ejecute Apache
CMD ["apache2-foreground"]
