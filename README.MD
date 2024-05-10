Inicio do projeto.

Criação do banco de dados.

Criação do Dockerfile para o Banco de Dados.
-Utilizando a imagem do MySQL 8.4
Para inicializar o container do MySQL execute o seguinte comando:

docker run -d -p 3317:3306 --name mysql_natacao -v /home/jean/projects/natacao/db_data:/var/lib/mysql --rm -e MYSQL_ALLOW_EMPTY_PASSWORD=True natacao_database

docker run -d -p 8082:80 --name natacao_app -v /home/jean/projects/natacao/php:/var/www/html --rm --network natacao_network natacao_app
