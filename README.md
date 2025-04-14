<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

## API de Cadastro de Clientes com Validação de CEP

<p> O objetivo deste teste é desenvolver uma API Rest para o cadastro de clientes, garantindo que o cliente esteja em um CEP valido. </p>

## Instruções : Rodar o Projeto

#### 1 - Clone o Repositório

```bash
git clone https://github.com/alissonalbuquerque/Teste-Dev-php.git
cd Teste-Dev-php
```

#### 2 - Instale as dependências PHP

```bash
composer install
```

#### 3 - Copie o arquivo .env

```bash
cp .env.example .env
```

#### 4 - Troque as seguintes Váriaveis no .env

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME='your user'
DB_PASSWORD='your password'

CACHE_DRIVER=database
```

#### 5 - Gere a chave da aplicação

```bash
php artisan key:generate
```

#### 6 - Rode as Migrations

```bash
php artisan migrate
```

#### 7 - Rode os Seeds

```bash
php artisan db:seed
```

#### 8 - Rode os Testes

```bash
php artisan test
```

#### 9 - Rode o servidor localmente

```bash
php artisan serve
```

#### 10 - 

```bash

```

## Tarefas

### Back-End (API Laravel)
- [x] Criar um cliente com as seguintes informações:
    - Nome completo
    - CPF (validado, único no banco)
    - E-mail (validado, único no banco)
    - Telefone
    - CEP
    - Endereço (logradouro, bairro, cidade, estado)
- [x] Editar um cliente
- [x] Excluir um cliente
- [x] Listar clientes (paginação, filtro por nome, CPF e CEP)
---

### Migrations

- [x] Migrations
- [x] Seeds
- [x] Factories

---

---

### Requisitos
- [x] **Validar CPF** (formato correto e não permitir duplicação).
- [x] **Validar e-mail** (formato correto e não permitir duplicação).
- [x] **Validar endereço automaticamente** via [BrasilAPI](https://brasilapi.com.br/docs#tag/CEP-V2) ou qualquer outro endpoint público ao inserir ou atualizar um cliente

---

## Critérios de Avaliação
- **Adesão aos requisitos funcionais e técnicos**
- **Qualidade do código** (organização, padrões, segurança)
- **Uso adequado do Laravel (migrations, Eloquent, validações, etc.)**
- **README bem estruturado** com instruções de instalação e uso

---

### Tecnologias Utilizadas
- PHP 8.x
- Laravel 10.x
- Banco de Dados: MySQL ou PostgreSQL

---

### Extras
- [x] Implementação do Repository Pattern
- [x] Testes automatizados (unitários ou de integração)
- [x] Implementação de cache para otimizar o desempenho
- [ ] Dockerização do ambiente para facilitar a instalação

---

### Entrega
1. Faça um **fork** deste repositório.
2. Crie uma **branch** com o seu nome.
3. Altere o **README.md** com as instruções para rodar o projeto (comandos necessários, migrations, seeds, etc.).
4. Após finalizar, envie um **pull request** para avaliação.

---

Boa sorte! 🚀