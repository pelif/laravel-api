## Repositórios para Testes de API Laravel

Este projeto consiste em desenvolvimento de api Utlizando PHP 8.1, Laravel 9.19, Mysql5.7, Nginx, Docker e Docker Compose. 

## Instruções de Instalação

Para rodar este projeto é necessário ter o Docker e Docker Compose devidamente instalado no host. Na raíz do projeto 
basta rodar o comando **composer install**, após concluir as instalações do composer rode o comando **docker-compose up -d --build** que o projeto vai subir em containers e após todo o processo de build o mesmo estará disponível no endereço: **http://localhost:8088**. 

Também será preciso configurar o arquivo .env com algumas credenciais, primeiramente copie o arquivo .env.example na raíz do projeto renomeando-o para .env. Depois configure as credenciais de banco de dados da seguinte forma: 

DB_CONNECTION=mysql  
DB_HOST=160.80.0.2  
DB_PORT=3306  
DB_DATABASE=laravel_api_tests  
DB_USERNAME=laravel_tests  
DB_PASSWORD=laravel_tests  

Pois como o ambiente do projeto está configurado para rodar no docker, é preciso que pelo o DB_HOST esteja conforme especificado, pois o docker está usando rede interna com este ip fixo para o banco de dados. 


Para instalar a base da aplicação, na raiz da aplicação basta rodar o comando **php artisan migrate** que as tables serão criadas. Para criar um usuário de teste basta rodar uma seeder específica com o comando: **php artisan db:seed \\\Database\\\Seeders\\\UserSeeder** . Com este comando será criado o usuário : 

{ "email": "test@email.com",  "password": "123456" }

Este é o usuário que será usado no endpoint de login e será enviado no body payload.
 
### Observações: 

Na raíz do projeto há um arquivo **docker-compose.yml**. O projeto foi separado em três serviços: 

 - db_api_user - Este é o serviço que está rodando nosso banco de dados Mysql, seu contianer é **db_lara_api_user**
 - app_api_user - Este é o serviço que contém a aplicação , seu container é **app_lara_api_user** roda php 8.1 fpm
 - nginx_api_user - Este é o serviço que contém a nginx que faz proxy reverso com o serviço app_api_user , seu container é **nginx_lara_api_user** roda servidor web nginx
 - redis - serviço rodando redis para eventuais caches necessários, seu container é redis_lara_api

 
## Endpionts da API

Segue a lista de alguns endpoints da API: 

 - POST - https://localhost:8088/api/login
 - GET - https://localhost:8088/api/users
 - POST - https://localhost:8088/api/users 
 - PUT - https://localhost:8088/api/users/{user}
 - DELETE - https://localhost:8088/api/users/{user}


Também será disponibilizado uma collection no formato postman para validação dos Endpoints e para detalhamento maior a respeito dos payloads e retornos. 

OBS: 

A Api possui autenticação via JWT , sendo assim antes de consumir os endpoints de crud do usuário é necessário gerar o access token no endponit de autenticação (POST - https://localhost:8088/api/login). Após isso o token deverá ser enviado via Bearer Token no Authorization da requisição. 

