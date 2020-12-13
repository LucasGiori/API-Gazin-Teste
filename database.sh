#!/bin/bash
set -e

FUN_SQL2="
CREATE TABLE IF NOT EXISTS desenvolvedor (
     id SERIAL NOT NULL
    ,nome VARCHAR(80) NOT NULL
    ,sexo CHAR NOT NULL
    ,idade integer NOT NULL
    ,hobby varchar
    ,datanascimento date NOT NULL
    ,PRIMARY KEY (nome)
);
"

# add function to DB
docker exec -it crud sh -c "psql -U postgres -d crud -c \"$FUN_SQL2\" ";
docker exec -it php sh -c "composer install";