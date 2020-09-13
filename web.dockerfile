FROM nginx:1.10

ADD vhost.conf /etc/nginx/conf.d/default.conf
RUN apt-get update && apt-get -y install texlive-latex-base
