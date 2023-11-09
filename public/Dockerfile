FROM php:8.2

LABEL org.opencontainers.image.source=https://github.com/arcverse/landing

ENV APP_ENV prod

RUN mkdir /app && chown -R php:php /app

WORKDIR /app

COPY --chown=php:php package.json package.json
COPY --chown=php:php package-lock.json package-lock.json

USER php

RUN composer install
RUN npm install --production
RUN npm run build

COPY --chown=php:php . .


EXPOSE 3000

CMD php -S 0.0.0.0:3000