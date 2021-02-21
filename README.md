<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## API Ally 

A API foi desenvolvida em PHP, Laravel e banco de dados MySQL.
A API consiste em um CRUD (Create, Read, Update e Delete) de Cursos e Escolas e uma rota para conversão de moedas, informando o valor do cursos em real, dolar, dolar australiano e euro. 


**Para rodar o projeto é necessário ter o docker e o composer instalados na sua máquina local.**

## Para rodar local faça:
- clonar projeto com o comando **git clone https://github.com/jessicacarolina/api-course-school.git**

-  Abrir a pasta onde o projeto está para criar os containers do docker com o comando **docker-compose up**

- Para instalar as dependencias do projeto rode o comando **docker-compose exec app composer install**

- Crie um novo database no MySql.

- Crie o arquivo .env e inclua as informações do seu banco local.

- Agora é necessário rodar as migrations para criar as tabelas com o comando **docker-compose exec app php artisan migrate**

Após esses passos o projeto estará funcionando, para testar as rotas você pode usar o Insomnia, basta fazer o download - https://insomnia.rest/download/ e com o Insomnia aberto importe o arquivo que está na pasta clonada nomeado como Insomnia_2021-02-21 onde todas as rotas estarão disponíveis para testar a aplicação.

## CRUD Escola
### Rotas Escolas
- GET http://localhost:8000/api/school <br>
Irá retornar em formado JSON todas as escolas salvas no banco de dados ou um array vazio caso não exista nenhum 

- POST http://localhost:8000/api/school <br>
É a rota para criação de uma nova escola, onde precisa passar os seguintes dados em formato JSON: <br> 
```json
    {
	    "name": "Nome da Escola",
	    "city": "Cidade da escola"
    }
```
Estando com todos os dados corretos irá retornar o JSON com os dados inseridos no banco.

- PUT http://localhost:8000/api/school/:id <br>
O id da escola que deseja alterar deve ser passado como parâmetro na URL e no corpo na requisição deve ser passado em formato JSON somente as informações que deseja alterar e o retorno será o JSON com todas as informações inseridas no banco. 

- DELETE http://localhost:8000/api/school/:id <br>
O id da escola que deseja excluir deve ser passado como parâmetro na URL, em caso  de sucesso será retornado o código HTTP 200 e caso o mesmo não seja encontrado uma mensagem de erro será retornada.


## CRUD cursos
### Rotas Cursos
- GET http://localhost:8000/api/course <br>
Irá retornar em formado JSON todos os cursos salvos no banco de dados ou um array vazio caso não exista nenhum 

- POST http://localhost:8000/api/course <br>
É a rota para criação de um novo curso, onde precisa passar os seguintes dados em formato JS: <br> 
```json
    {
        "name": "Nome do curso",
        "description": "descrição do curso",
        "dt_start": "2021-02-18T02:28:03",
        "school_id": 1
    }
```
Estando com todos os dados corretos irá retornar o JSON com os dados inseridos no banco.

- PUT http://localhost:8000/api/course/:id <br>
O id do curso que deseja alterar deve ser passado como parâmetro na URL e no corpo na requisição deve ser passado em formato JSON somente as informações que deseja alterar e o retorno será o JSON com todas as informações inseridas no banco. 

- DELETE http://localhost:8000/api/course/:id <br>
O id do curso que deseja excluir deve ser passado como parâmetro na URL, em caso  de sucesso será retornado o código HTTP 200 e caso o mesmo não seja encontrado uma mensagem de erro será retornada.

### Autor
---

 <img style="border-radius: 50%;" src="https://media-exp1.licdn.com/dms/image/C4D03AQFihflKcc1-Jw/profile-displayphoto-shrink_800_800/0/1596638285084?e=1619654400&v=beta&t=OBxqzj7WXBgMOs3B13rsyiIMriGzYZvooahUBL55TwY" width="100px;" alt=""/>
 <br />
 <sub><b>Jéssica Silva </b></sub>

Feito com ❤️ por Jéssica Silva 👋🏽 Entre em contato!

[![Linkedin Badge](https://img.shields.io/badge/-Jéssica-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/)](https://www.linkedin.com/in/jessica-carolina-silva/) 
[![Gmail Badge](https://img.shields.io/badge/-jessica.carolina.silva26@gmail.com-c14438?style=flat-square&logo=Gmail&logoColor=white&link=mailto:jessica.carolina.silva26@gmail.com)](mailto:jessica.carolina.silva26@gmail.com)
