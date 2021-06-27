FROM node

COPY docker/runner/node/entrypoint.sh /entrypoint.sh

RUN mkdir -p /usr/loca/lib/node_modules \
    && chown node:node /usr/local/lib/node_modules \
    && chmod -R 775 /usr/local/lib/node_modules \
    && mkdir -p /user/local/bin \
    && chown -R node:node /user/local/bin \
    && chmod -R 775 /user/local/bin

RUN chown -R node:node /user/local/bin \
    && chmod -R 775 /user/local/bin

RUN npm install -g @angular/cli@11.0.0

USER node

WORKDIR /var/www

EXPOSE 4200

ENTRYPOINT ["/bin/bash", "/entrypoint.sh"]