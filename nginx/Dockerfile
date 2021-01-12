FROM debian

ARG workDir=/app/3ds

RUN apt update \
    && apt install --yes \
    nginx \
    bash \
    php-cgi \
    php-fpm \
    php \
    && apt-get clean \
    && rm -rf /var/cache/* \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir -p $workDir 

COPY ./index/index.php $workDir/
COPY ./index/favicon.ico $workDir/
COPY ./conf/nginx.conf /etc/nginx/
COPY ./entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

WORKDIR $workDir

EXPOSE 80

CMD ["/entrypoint.sh"]
