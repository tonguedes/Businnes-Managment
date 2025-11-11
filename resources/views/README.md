# Magnent Busines - Sistema de Gestão

Este é um sistema de gestão desenvolvido em Laravel, projetado para administrar grupos econômicos, bandeiras, unidades e colaboradores. A aplicação conta com uma interface web construída com Livewire e uma API RESTful para integrações.

## 📜 Requisitos

- PHP 8.2 ou superior
- Composer
- Node.js & NPM
- Um banco de dados suportado pelo Laravel (ex: MySQL, PostgreSQL)

## 🚀 Instalação e Configuração

Siga os passos abaixo para configurar o ambiente de desenvolvimento.

1.  **Clonar o repositório:**
    ```bash
    git clone <url-do-seu-repositorio>
    cd magnent-busines
    ```

2.  **Instalar dependências do PHP:**
    ```bash
    composer install
    ```

3.  **Configurar o ambiente:**
    Copie o arquivo de exemplo `.env.example` para um novo arquivo chamado `.env`.
    ```bash
    cp .env.example .env
    ```
    Em seguida, gere a chave da aplicação:
    ```bash
    php artisan key:generate
    ```

4.  **Configurar o Banco de Dados:**
    Abra o arquivo `.env` e configure as variáveis de conexão com o seu banco de dados:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=magnent_busines
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Executar as Migrations e Seeders:**
    As *migrations* criarão a estrutura de tabelas no banco de dados, e os *seeders* irão popular o sistema com dados de exemplo para facilitar os testes.
    ```bash

    ```

6.  **Instalar dependências do Node.js e compilar os assets:**
    ```bash
    npm install
    npm run dev
    ```

7.  **Iniciar o servidor de desenvolvimento:**
    ```bash
    php artisan serve
    ```

A aplicação estará disponível em `http://127.0.0.1:8000`.

## 🔑 Login

Após executar os seeders, um usuário padrão será criado. Você pode usar as seguintes credenciais para acessar o sistema:

- **Email:** `test@example.com"`
- **Senha:** `password`

## 🤖 Rotas da API

A API é protegida usando o Laravel Sanctum. Para interagir com as rotas protegidas, você primeiro precisa obter um token de autenticação.

### Autenticação

**Endpoint:** `POST /api/token`

Envie uma requisição `POST` para esta rota com os seguintes dados no corpo para obter um token de acesso:

```json
{
    "email": "seu-email@exemplo.com",
    "password": "sua-senha",
    "device_name": "nome-do-dispositivo"
}
```

A resposta incluirá o token que deve ser enviado em todas as requisições subsequentes no cabeçalho `Authorization` como um *Bearer Token*.

`Authorization: Bearer <seu-token>`

### Endpoints Protegidos

Todas as rotas abaixo requerem um token de autenticação válido.

| Verbo  | Rota                  | Ação                        |
| :----- | :-------------------- | :-------------------------- |
| `GET`    | `/api/grupos`         | Lista todos os grupos.      |
| `POST`   | `/api/grupos`         | Cria um novo grupo.         |
| `GET`    | `/api/grupos/{id}`    | Exibe um grupo específico.  |
| `PUT`    | `/api/grupos/{id}`    | Atualiza um grupo.          |
| `DELETE` | `/api/grupos/{id}`    | Deleta um grupo.            |
| `GET`    | `/api/bandeiras`      | Lista todas as bandeiras.   |
| `POST`   | `/api/bandeiras`      | Cria uma nova bandeira.     |
| `GET`    | `/api/bandeiras/{id}` | Exibe uma bandeira.         |
| `PUT`    | `/api/bandeiras/{id}` | Atualiza uma bandeira.      |
| `DELETE` | `/api/bandeiras/{id}` | Deleta uma bandeira.        |
| `GET`    | `/api/unidades`       | Lista todas as unidades.    |
| `POST`   | `/api/unidades`       | Cria uma nova unidade.      |
| `GET`    | `/api/unidades/{id}`  | Exibe uma unidade.          |
| `PUT`    | `/api/unidades/{id}`  | Atualiza uma unidade.       |
| `DELETE` | `/api/unidades/{id}`  | Deleta uma unidade.         |
| `GET`    | `/api/colaboradores`  | Lista todos os colaboradores. |
| `POST`   | `/api/colaboradores`  | Cria um novo colaborador.   |
| `GET`    | `/api/colaboradores/{id}` | Exibe um colaborador.     |
| `PUT`    | `/api/colaboradores/{id}` | Atualiza um colaborador.  |
| `DELETE` | `/api/colaboradores/{id}` | Deleta um colaborador.    |
| `GET`    | `/api/user`           | Retorna o usuário autenticado. |

---
*Este README foi gerado para facilitar a configuração e o uso da aplicação.*