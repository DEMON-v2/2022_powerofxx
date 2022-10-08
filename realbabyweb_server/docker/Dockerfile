FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get clean
RUN apt-get update -y
RUN apt-get install apache2 -y
RUN apt install lsb-release ca-certificates apt-transport-https software-properties-common -y
RUN add-apt-repository ppa:ondrej/php -y
RUN apt-get update
RUN apt-get install php7.3 php7.3-curl -y
RUN apt-get install libapache2-mod-php -y

COPY ./apache2.conf /etc/apache2/apache2.conf
COPY ./php.ini /etc/php/7.3/apache2/

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data

COPY ./th3s_is_real_flag /

RUN chmod 404 /th3s_is_real_flag

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]