FROM node:24.12-bookworm

ENV TERM=xterm

ENV PATH="/root/.config/herd-lite/bin:${PATH}"

COPY . /app

WORKDIR /app

RUN git config --global --add safe.directory /app

RUN /bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.4)" \
 && npm install \
 && npm run build \
 && composer install --no-interaction --prefer-dist --optimize-autoloader

VOLUME ["/app/vendor"]
VOLUME ["/app/node_modules"]
VOLUME ["/app/storage"]
VOLUME ["/app/database"]

CMD ["composer", "run", "dev"]