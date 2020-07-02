FROM php:cli-alpine

COPY app /repository-meta/

RUN chmod -R 777 /repository-meta/

ENTRYPOINT ["php /repository-meta/app.php"]