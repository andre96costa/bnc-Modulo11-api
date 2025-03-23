## Módulo 11 - API

Application Programming Interface

Apis podem ser web, pacotes e outros tipos.

REST: Representational State Transfer

- Progressivo
- Leve
- Rápido
- Escalável

No laravel, ao criar um um controller usando o artisan, podemos passar a flag *--api* para gerar apenas os métodos usados pela api.

Nos arquivos de rotas podemos utilizar o comando *Route::apiResource* para gerar todas as rotas automaticamente.

No laravel 11+, os arquivos relacionados a api, como o arquivo api.php, não são criados por padrão. É necessário executar o comando *artisan install:api* esse comando ira instalar o sanctum e criar os arquivos de api do laravel.

No arquivo *bootstrap/app.php* no método *withRouting()* podemos mudar alguns dos comportamentos padrão. Como alterar o prefixo padrão das rotas de api para qualquer outra coisa.

A sessão https://laravel.com/docs/12.x/routing#routing-customization mostra varias customizações que podem ser feitas.

O laravel possui um recurso chamado *resource*, esse recurso permite criar um formato de resposta para a chamadas das APIs. Para criar um resource para um recurso utilizamos o comando *art make:resource.* O resource funciona para 1 recurso apenas. Para retornar vários dados podemos utilizar uma collections, através do mesmo comando utilizando o sufixo *Collections* criamos um recurso de collection.

Podemos utilizar um resource dentro do outro para formatar de maneira mais interna os dados retornados.

As collections são usadas quando precisamos retornar o recurso e mais informações. Na collection podemos usar a variável *$this*->collection, está variável ira procurar uma classe resource para retornar os dados do recurso, caso não encontre ou não exista ela ira buscar direto no model.

### Autenticação

No laravel quando trabalhamos com API por padrão o pacote *Sanctum* é instalado. Este pacote permite trabalhar com tokens de autenticação. Por padrão na classe *User* utilizamos a *trait HasApiTokens* que nos da métodos para criar e gerenciar o token de acesso.

Esse token deve ser passado nos headers das requisições que estiverem utilizando o *middlewere sanctum* para autenticar as rotas.

### Versionamento de API

Existem varias opções para versionar uma api no laravel.