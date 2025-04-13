<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

## API de Cadastro de Clientes com Validação de CEP

<p> O objetivo deste teste é desenvolver uma API Rest para o cadastro de clientes, garantindo que o cliente esteja em um CEP valido. </p>

## Instruções : Lista de Comandos


## Tarefas

### Back-End (API Laravel)
- [] Criar um cliente com as seguintes informações:
    - Nome completo
    - CPF (validado, único no banco)
    - E-mail (validado, único no banco)
    - Telefone
    - CEP
    - Endereço (logradouro, bairro, cidade, estado)
- [] Editar um cliente
- [] Excluir um cliente
- [] Listar clientes (paginação, filtro por nome, CPF e CEP)
---

### Migrations
- [x] Migrations
- [x] Seeds
- [x] Factories

---

---

### Requisitos
- [] **Validar CPF** (formato correto e não permitir duplicação).
- [] **Validar e-mail** (formato correto e não permitir duplicação).
- [] **Validar endereço automaticamente** via [BrasilAPI](https://brasilapi.com.br/docs#tag/CEP-V2) ou qualquer outro endpoint público ao inserir ou atualizar um cliente

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
- [] Implementação do Repository Pattern
- [] Testes automatizados (unitários ou de integração)
- [] Dockerização do ambiente para facilitar a instalação
- [] Implementação de cache para otimizar o desempenho

---

### Entrega
1. Faça um **fork** deste repositório.
2. Crie uma **branch** com o seu nome.
3. Altere o **README.md** com as instruções para rodar o projeto (comandos necessários, migrations, seeds, etc.).
4. Após finalizar, envie um **pull request** para avaliação.

---

Boa sorte! 🚀