# Doctrine ORM

## Doctrine via console
- criar banco de dados
```
$ cd project/
vendor/bin/doctrine-module orm:schema-tool:create
```

- atualizando banco de dados
```
$ cd project/
vendor/bin/doctrine-module orm:schema-tool:update --force
```

- Conferir SQL produzido
```
$ cd project/
vendor/bin/doctrine-module orm:schema-tool:update --dump-sql
```

- validação do banco de dados
```
$ cd project/
vendor/bin/doctrine-module orm:validate-schema
```

Doctrine Query Language:
http://doctrine-orm.readthedocs.io/en/latest/reference/dql-doctrine-query-language.html

The QueryBuilder: 
http://doctrine-orm.readthedocs.io/en/latest/reference/query-builder.html


## DQL Cli

- Testando consultas SQL
```
vendor/bin/doctrine-module dbal:run-sql "SELECT * from cliente"
```

- Testando consultas DQL
```
vendor/bin/doctrine-module orm:run-dql "SELECT c FROM App\Entity\Cliente c order by c.nome desc"
```

## Eventos

http://doctrine-orm.readthedocs.io/en/latest/reference/events.html


## Data Fixture
https://github.com/doctrine/data-fixtures

https://github.com/codeedu/zend-doctrine-fixture

```
vendor/bin/d octrine-module data-fixture:import [--purge-with-trucate] [--append]
```