FROM nginx:alpine

CMD ["/bin/sh"]

MAINTAINER Kovalev Igor <kovalevgr@gmail.come>

RUN apk update && apk upgrade && \
    apk --update --repository=http://dl-4.alpinelinux.org/alpine/edge/main --no-cache add \
    libressl2.7-libcrypto \
    libressl2.7-libssl \
    musl \
    curl \
    bash \
    git \
    php7-dev \
    python \
    py-pip \
    py-setuptools \
    ca-certificates \
    curl \
    groff \
    less && \
    pip --no-cache-dir install awscli

RUN apk upgrade -U && \
    apk --update --repository=http://dl-4.alpinelinux.org/alpine/edge/community add \
    openssh \
    shadow \
    php7-fpm \
    php7-memcached \
    php7-ctype \
    php7-curl \
    php7-fileinfo \
    php7-gd \
    php7-json \
    php7-ldap \
    php7-mbstring \
    php7-mysqli \
    php7-opcache \
    php7-openssl \
    php7-pdo_mysql \
    php7-phar \
    php7-session \
    php7-simplexml \
    php7-tokenizer \
    php7-xml \
    php7-xmlwriter \
    php7-xsl \
    php7-zlib \
    php7-ftp \
    php7-redis \
    php7-iconv \
    php7-bcmath \
    php7-xdebug

RUN apk update && apk upgrade -U && \
    apk --update --repository=http://dl-4.alpinelinux.org/alpine/edge/testing add \
    php7-ssh2 \
    php7-xdebug && \
    echo "zend_extension=xdebug.so" > /etc/php7/conf.d/xdebug.ini && \
    echo "xdebug.idekey='phpstorm'" >> /etc/php7/conf.d/xdebug.ini && \
    echo "xdebug.remote_enable=on" >> /etc/php7/conf.d/xdebug.ini && \
    echo "xdebug.remote_handler=dbgp" >> /etc/php7/conf.d/xdebug.ini && \
    echo "xdebug.remote_connect_back=0" >> /etc/php7/conf.d/xdebug.ini && \
    echo "xdebug.remote_autostart=on" >> /etc/php7/conf.d/xdebug.ini && \
    echo "xdebug.remote_host=172.20.0.1" >> /etc/php7/conf.d/xdebug.ini && \
    echo "xdebug.remote_port=9004" >> /etc/php7/conf.d/xdebug.ini && \
    echo "xdebug.profiler_enable_trigger=1" >> /etc/php7/conf.d/xdebug.ini

RUN mkdir -p /var/log/php-fpm && \
    touch /var/log/php-fpm/fpm-error.log

RUN ln -s /etc/php7 /etc/php && \
    ln -s /usr/sbin/php-fpm7 /usr/bin/php-fpm && \
    ln -s /usr/lib/php7 /usr/lib/php && \
    rm -fr /var/cache/apk/*

CMD ["/usr/sbin/php-fpm7", "-F"]