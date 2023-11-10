# Use the webdevops/php-nginx base image with PHP 8.2
FROM webdevops/php-nginx:8.2

LABEL org.opencontainers.image.source="https://github.com/arcverse/landing"

# Set the working directory
WORKDIR /app

# Copy all files to the container
COPY . /app

# Set environment variable to allow superuser for Composer plugins
ENV COMPOSER_ALLOW_SUPERUSER 1

# Change to the app directory
RUN cd /app

# Install dependencies using Composer
RUN composer install --no-interaction --no-ansi --no-progress --no-scripts

# Install Node.js and npm
RUN apt-get update -y \
    && apt-get install -y curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install nodejs -y

# Install project dependencies using npm
RUN npm install

# Run the build process
RUN npm run build

# Set the permissions
RUN chmod -R 777 .

# Expose the port
EXPOSE 3000

ENV WEB_DOCUMENT_ROOT /app/public
ENV WEB_DOCUMENT_INDEX index.php
ENV client_max_body_size 100M
