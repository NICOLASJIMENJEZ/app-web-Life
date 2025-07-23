FROM php:8.1-apache

# Copiar solo el contenido de la carpeta 'modulos' al directorio raíz del servidor
COPY modulos/ /var/www/html/

# Activar módulo de reescritura (por si usas URLs limpias)
RUN a2enmod rewrite

# Permisos (opcional)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
