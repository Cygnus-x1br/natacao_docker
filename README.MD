Inicio do projeto.

Criação do banco de dados.

Criação do Dockerfile para o Banco de Dados.
-Utilizando a imagem do MySQL 8.4
Para inicializar o container do MySQL execute o seguinte comando:

Inicialização com volume local

docker run -d -p 3317:3306 --name mysql_natacao -v /~/projects/natacao/db_data:/var/lib/mysql --rm --network natacao_network -e MYSQL_ALLOW_EMPTY_PASSWORD=True natacao_database

Inicialização com docker volume

docker run -d -p 3317:3306 --name mysql_natacao -v natacao_data_volume:/var/lib/mysql --rm -e MYSQL_ALLOW_EMPTY_PASSWORD=True --network natacao_network natacao_database

Criação do Dockerfile para o PHP.
-Utilizando a imagem do PHP 8.2-apache
Para inicializar o container do PHP execute o seguinte comando (executando em modo de desenvolvimento):

docker run -d -p 8082:80 --name natacao_app -v /~/projects/natacao/php:/var/www/html --rm --network natacao_network natacao_app

Criar uma pasta local db_data (dados do MySQL) ou criar um volume Docker para armazenar o banco ???

Criar o arquivo Env.php
