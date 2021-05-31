FROM mariadb:latest

ENV MYSQL_ROOT_PASSWORD="p" \
    MYSQL_USER="mysql_client" \
    MYSQL_PASSWORD="p"

COPY db.sql /docker-entrypoint-initdb.d/

CMD ["--default-authentication-plugin=mysql_native_password"]