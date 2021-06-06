FROM mysql:latest

RUN apt-get update && apt-get install apt-file -y && apt-file update && apt-get install vim -y && apt-get install netcat -y

COPY src/images/mysql/my.cnf /etc/mysql/my.cnf

ADD ./src/content/digitaz4_p2erls.sql /docker-entrypoint-initdb.d

# ENTRYPOINT /var/mysql/backups/entrypoint.sh users ${MUSR} ${MPW} ${MDB}

