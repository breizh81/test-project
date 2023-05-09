FROM bitnami/symfony:6.2

RUN apt-get update
RUN apt-get install zsh curl git -y npm

# Install MongoDB PHP extension
RUN echo "extension=mongodb.so" >> /opt/bitnami/php/etc/php.ini

RUN sh -c "$(curl -fsSL https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"

#RUN yum install -y tar git
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
