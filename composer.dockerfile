FROM composer:latest

ENV COMPOSERUSER=postulaciones
ENV COMPOSERGROUP=postulaciones

RUN adduser -g ${COMPOSERGROUP} -s /bin/sh -D ${COMPOSERUSER}