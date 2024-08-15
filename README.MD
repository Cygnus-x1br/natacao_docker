# Sistema de Gestão de Atletas

## v 0.1

- Implementação inicial do projeto. 
- Criação das rotinas de CRUD de Federações, Equipes, Piscinas(complexos), Torneios e Provas.
- Criação das rotinas de CRUD de Atletas e Usuários
- Criação das rotinas de CRUD de Índices, Recordes e Tempos do Atleta.
- Criação de gráficos de tempos com comparação com os índices cadastrados.
- Criação de fórmula para cálculo do Índice Técnico e geração de gráfico.

### TO DO:

- Ajustar visibilidade do atleta;
- Criar usuário (tabela ou rotina) para **Técnico**;
- Ajustar segurança de login e administrador (token???);
- Criar rotinas de **Dados Biomecânicos do Atleta**;
- Criar **Agenda de Torneios**;
- Criar rotina de **Treinos**;

## Criação do banco de dados.

Criação do Dockerfile para o Banco de Dados.  
- Utilizando a imagem do MySQL 8.4  

Para inicializar o container do MySQL execute o seguinte comando:

### Inicialização com volume local

`docker run -d -p 3317:3306 --name mysql_natacao -v /~/projects/natacao/db_data:/var/lib/mysql --rm --network natacao_network -e MYSQL_ALLOW_EMPTY_PASSWORD=True natacao_database:versao`

### Inicialização com docker volume

`docker run -d -p 3317:3306 --name mysql_natacao -v natacao_data_volume:/var/lib/mysql --rm -e MYSQL_ALLOW_EMPTY_PASSWORD=True --network natacao_network natacao_database:versao`

## Criação do Dockerfile para o PHP.
- Utilizando a imagem do PHP 8.1-apache

Para inicializar o container do PHP execute o seguinte comando (executando em modo de desenvolvimento):

`docker run -d -p 8082:80 --name natacao_app -v /home/jean/projetos/natacao_docker/php:/var/www/html --rm --network natacao_network natacao_app:versao`

Criar uma pasta local db_data (dados do MySQL) ou criar um volume Docker para armazenar o banco ???

Criar o arquivo Env.php com as seguintes variáveis:

`<?php
const DB_HOST = 'db_name';
const DB_PORT = num_porta;
const DB_NAME = 'db_name';
const DB_USER = 'db_user';
const DB_PASSWD = 'db_password';
`

Bibliotecas Javascript:

- vanilla-masker: (Mascaras para os dados)

https://github.com/vanilla-masker/vanilla-masker

- Gráfico Circular:

https://gist.github.com/giancore/801b6fecc1fa357d4db3472ffd3f71f7

- Gráficos:

https://www.chartjs.org/docs/latest/charts/mixed.html

