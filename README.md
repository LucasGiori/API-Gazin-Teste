
<br>
<b>API - Avaliação</b>
<br>
<br>
<br>
<br>

## Comandos para executar o projeto:

No diretório do Projeto  Executar:

## `cp .env.example .env` 
## `docker-compose build`
## `docker-compose up -d`

Ao Finalizar execução dos comandos acima, executar:

## `sh database.sh`
Este sh irá acessar os containers para criar a tabela no banco de dados `crud` e para executar o comando `composer install` para instalar as dependências do projeto.


# Rotas Disponíveis

### Method: `POST` Host: `http://localhost:8081/developers/`
Esta rota cadastro um novo desenvolvedor;

### Method: `GET` Host: `http://localhost:8081/developers/{id}`
Esta rota busca um desenvolvedor especifico conforme o id informado;

### Method: `GET` Host: `http://localhost:8081/developers/`
Esta rota busca todos desenvolvedores cadastrados;

### Method: `GET` Host: `http://localhost:8081/developers/?page=1&limit=5`
Esta rota busca os desenvolvedores cadastrados realizando a paginação, sendo o parametro `page` obrigatório e o parâmetro `limit` opcional;

### Method: `PUT` Host: `http://localhost:8081/developers/{id}`
Esta rota atualiza as informações do desenvolvedor conforme o id informado e os dados no corpo da requesição;

### Method: `DELETE` Host: `http://localhost:8081/developers/{id}`
Esta rota exclui um desenvolvedor conforme o id informado;