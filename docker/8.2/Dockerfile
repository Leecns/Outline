FROM ubuntu:22.04 AS base

WORKDIR /var/www/html

ARG NODE_VERSION=18

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update \
     && apt-get install -y cron \
     && mkdir -p /etc/apt/keyrings \
     && apt-get install -y curl ca-certificates unzip supervisor sqlite3

# Install nvm with node and npm
RUN curl https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash \
    && . $HOME/.nvm/nvm.sh \
    && nvm alias default $NODE_VERSION \
    && nvm use default

ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
ENV PATH $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

RUN node -v
RUN npm -v

#
#RUN curl -sS 'https://keyserver.ubuntu.com/pks/lookup?op=get&search=0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c' | gpg --dearmor | tee /etc/apt/keyrings/ppa_ondrej_php.gpg > /dev/null \
#     && echo "deb [signed-by=/etc/apt/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
#     && apt-get update \
#     && apt-get install -y php8.2-cli php8.2-dev php8.2-pgsql php8.2-sqlite3 php8.2-gd
#
#RUN curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=compose
#
#
#RUN apt-get -y autoremove \
#     && apt-get clean \
#     && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
#
#
#RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.2

#FROM base AS start
#
#COPY scheduler /etc/cron.d/scheduler
#RUN chmod 0644 /etc/cron.d/scheduler \
#    && crontab /etc/cron.d/scheduler
#
#COPY start-container /usr/local/bin/start-container
#COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
#COPY php.ini /etc/php/8.2/cli/conf.d/99-sail.ini
#RUN chmod +x /usr/local/bin/start-container
#
#EXPOSE 8000
#
#ENTRYPOINT ["start-container"]
