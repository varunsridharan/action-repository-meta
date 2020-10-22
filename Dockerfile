FROM varunsridharan/actions-alpine-php:latest

COPY entrypoint.sh /entrypoint.sh

COPY app /gh-repo-meta/

RUN chmod 777 entrypoint.sh

RUN chmod -R 777 /gh-repo-meta/

ENTRYPOINT ["/entrypoint.sh"]