# Use the webdevops/php-nginx base image with PHP 8.2
FROM webdevops/php-nginx:8.2

# Set the working directory
WORKDIR /app

# Copy all files to the container
COPY . /app

# Change to the app directory
RUN cd /app

# Install dependencies using Composer
RUN composer install --no-interaction --no-ansi --no-progress --no-scripts

# Install Node.js and npm
RUN apt-get update \
    && apt-get install -y nodejs npm

# Install project dependencies using npm
RUN npm install

# Run the build process
RUN npm run build

# Expose the port
EXPOSE 3000

ENV WEB_DOCUMENT_ROOT = /app/public
ENV WEB_DOCUMENT_INDEX = index.php
ENV client_max_body_size = 100M
