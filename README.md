# Teste Técnico - Landing Page Full Stack

Projeto PHP com frontend estático, formulário de leads e persistência em banco relacional.

## Estrutura

```text
.
├── app/
│   └── Support/          # Código interno do backend
├── database/             # Scripts SQL
├── public/               # Web root da aplicação
│   ├── assets/
│   │   ├── css/          # CSS compilado
│   │   ├── images/       # Imagens públicas
│   │   └── js/           # JavaScript do cliente
│   ├── index.php         # Página inicial
│   └── submit.php        # Endpoint do formulário
├── resources/
│   └── styles/           # Fonte SCSS
├── Dockerfile
├── docker-compose.yml
├── package.json
└── render.yaml
```

## Scripts

```bash
npm install
npm run build:css
```

Para desenvolvimento dos estilos:

```bash
npm run sass
```

## Docker

```bash
docker compose up --build
```

A aplicação fica em `http://localhost:8080`.

O Apache serve o diretório `public/` como document root.

Por padrão, o `docker-compose.yml` usa SQLite com o arquivo `database/app.sqlite`.

Para subir também o PostgreSQL auxiliar:

```bash
docker compose --profile postgres up --build
```

## Banco de dados

- `database/schema.sql`: MySQL
- `database/schema-postgres.sql`: PostgreSQL
- `database/schema-sqlite.sql`: SQLite
- `database/app.sqlite`: arquivo local do SQLite

As credenciais podem ser configuradas por `DB_*` ou `DATABASE_URL`.

### SQLite

Para usar SQLite, configure:

```bash
DB_DRIVER=sqlite
DB_DATABASE=database/app.sqlite
```

Também é aceito:

```bash
DATABASE_URL=sqlite:database/app.sqlite
```

Quando o driver for SQLite, a aplicação cria o arquivo se necessário e inicializa a tabela `contatos` usando `database/schema-sqlite.sql`.

### PostgreSQL no Docker Compose

Se você quiser usar o serviço `db` do Compose, ajuste o serviço `web` com:

```yaml
environment:
  DB_DRIVER: pgsql
  DB_HOST: db
  DB_PORT: "5432"
  DB_NAME: nexa_growth
  DB_USER: postgres
  DB_PASS: postgres
depends_on:
  - db
```
