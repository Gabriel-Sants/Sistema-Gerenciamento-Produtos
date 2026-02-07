# Sistema de Gerenciamento de Produtos - Laravel

Este projeto é uma aplicação Laravel para gerenciar produtos, com funcionalidades de CRUD e geração de relatórios em PDF.

## Tecnologias

- PHP 8.x
- Laravel 10.x
- MySQL
- Sanctum para autenticação da API
- FPDF/TCPDF para geração de PDFs
- Frontend Blade + Tailwind/Bootstrap

## Requisitos

- PHP >= 8.1
- Composer
- MySQL
- Node.js e npm.

---

## Dicas
- Descomente o **extension=fileinfo, extension=pdo_mysql e extension=zip no arquivo php.ini do seu php.**

---

## Instalação

### Clone o repositório:

```bash
git clone <https://github.com/Gabriel-Sants/Sistema-Gerenciamento-Produtos.git>
cd nome-do-projeto

```

Clone o **.ev.example** para **.ev (** Depois configure as variáveis do seu banco)

```bash
cp .env.example .env

```

---

### Instale as dependências 

```bash
composer install
npm install
```

<aside>
💡

Se tiver algum problema com o composer, rode o comando `composer update`. (Vale lembrar que o  extension=fileinfo deve está descomentado no php.ini)

</aside>

--- 

### Caso os seguintes pacotes não tenham sido instalados, rode os seguintes comandos

Para instalar o pacote de linguagens

```bash
composer require laravel-lang/common
php artisan lang:add pt_BR
```

FPDF

```bash
composer require setasign/fpdf

```

Sanctum

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

```
---

### Migration e Subir App

1. Execute os comandos artisan

```bash
php artisan key:generate
php artisan migrate --seed ou php artisan migrate:fresh --seed

```

2. Rodar a Aplicação (localhost)

```bash
composer run dev
```

## Testes da API (Postman)

Para testar a API com autenticação via Sanctum Utilize o postman ou outra ferramenta para testes de API.

### Passos:
1. Abra o [Postman](https://www.postman.com/downloads/).
2. Faça login(POST) usando a rota `/api/login` para gerar o token.
3. Cole o token em Authorization em cada requisição.
4. Execute as rotas protegidas, como `/api/produtos`.


