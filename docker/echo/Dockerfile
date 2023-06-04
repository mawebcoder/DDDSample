FROM node:latest

WORKDIR /var/www

COPY ./config .

RUN npm i -g laravel-echo-server

CMD ["laravel-echo-server","start","--force"]
