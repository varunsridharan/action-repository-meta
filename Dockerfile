FROM php:cli-alpine

COPY entrypoint.sh /entrypoint.sh

COPY app /repository-meta/

RUN chmod 777 entrypoint.sh

RUN chmod -R 777 /repository-meta/

ENTRYPOINT ["/entrypoint.sh"]