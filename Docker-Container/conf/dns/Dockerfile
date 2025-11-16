FROM ubuntu:latest

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y \
        nano \
        bind9 \
        bind9utils \
        bind9-doc \
        net-tools \
        iputils-ping \
        iproute2 \
        dnsutils && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

EXPOSE 53/udp 53/tcp

CMD ["named", "-g", "-c", "/etc/bind/named.conf", "-u", "bind"]
