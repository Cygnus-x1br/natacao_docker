FROM mysql:8.4
#importa o arquivo schema.sql que copia o banco para o mysql (executando o script de banco de dados)
COPY natacao.sql /docker-entrypoint-initdb.d
#expor porta
EXPOSE 3306
#cria um volume para backup
VOLUME ["/backup"]
VOLUME ["/home/jean/projects/natacao/db_data:/var/lib/mysql"]
