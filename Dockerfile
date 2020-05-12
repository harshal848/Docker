#Pull the ubuntu image
FROM ubuntu

RUN sed -i 's/archive.ubuntu.com/tw.archive.ubuntu.com/g' \
    /etc/apt/sources.list

#update the ubuntu apt-package
RUN apt-get update 

#installing wget and net-tools
RUN apt-get -y install wget net-tools

RUN wget https://www.apachefriends.org/xampp-files/7.4.5/xampp-linux-x64-7.4.5-0-installer.run

#change permissions to run installer
RUN chmod +x xampp-linux-x64-7.4.5-0-installer.run

RUN ./xampp-linux-x64-7.4.5-0-installer.run

RUN mv /opt/lampp/etc/extra/httpd-xampp.conf /opt/lampp/etc/extra/httpd-xampp.conf.bak

RUN echo "export PATH=\$PATH:/opt/lampp/bin/" >> /root/.bashrc

RUN echo "export TERM=dumb" >> /root/.bashrc

ADD config/httpd-xampp.conf /opt/lampp/etc/extra/httpd-xampp.conf

ADD . /opt/lampp/htdocs/api/

#exposing ports
EXPOSE 80 443 3306

#starting xampp-server
CMD /opt/lampp/lampp start && tail -F /opt/lampp/logs/error_log


