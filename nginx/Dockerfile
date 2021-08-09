FROM nginx:alpine

RUN rm /etc/nginx/conf.d/*
COPY ./default.conf /etc/nginx/conf.d/

EXPOSE 80 443

VOLUME /etc/letsencrypt

CMD ["nginx", "-g", "daemon off;"]
