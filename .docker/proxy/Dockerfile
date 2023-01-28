FROM nginx:1.14

WORKDIR /var/www/html

COPY conf/nginx.conf /etc/nginx/nginx.conf
COPY conf/fast_cgi.conf /etc/nginx/conf.d/default.conf

CMD ["nginx", "-g", "daemon off;"]
