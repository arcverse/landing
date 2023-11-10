# Use the webdevops/php-nginx base image with PHP 8.2
FROM webdevops/php-nginx:8.2

LABEL org.opencontainers.image.source="https://github.com/arcverse/landing"

# Set the working directory
WORKDIR /app

# Copy all files to the container
COPY . /app

# Set environment variable to allow superuser for Composer plugins
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN cd /app

RUN chmod -R 777 .

# Expose the port
EXPOSE 3000

ENV WEB_DOCUMENT_ROOT /app/public
ENV WEB_DOCUMENT_INDEX index.php
ENV client_max_body_size 100M
