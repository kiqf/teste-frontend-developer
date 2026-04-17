# Teste Técnico - Landing Page Full Stack

Landing page em PHP para captação de leads, com frontend estático, backend simples para persistência dos contatos e build de estilos com Sass.

## Deploy

- Produção: https://teste-frontend-developer.onrender.com/

## Estrutura

```text
.
├── app/
│   └── Support/              # Código interno do backend
├── database/
│   ├── schema.sql           # Schema MySQL
│   └── schema-postgres.sql  # Schema PostgreSQL
├── docker/
│   └── Dockerfile.sass      # Imagem de desenvolvimento para watcher do Sass
├── public/                  # Web root da aplicação
│   ├── assets/
│   │   ├── css/             # CSS compilado
│   │   ├── images/          # Imagens públicas
│   │   └── js/              # JavaScript do cliente
│   ├── index.php
│   └── submit.php
├── resources/
│   └── styles/              # Fonte SCSS
├── Dockerfile               # Build principal da aplicação
├── docker-compose.yml       # Ambiente base com PostgreSQL
├── docker-compose.dev.yml   # Override para desenvolvimento com watcher do Sass
├── package.json
└── render.yaml
```

## Scripts

Instalação das dependências:

```bash
npm install
```

Build único do CSS:

```bash
npm run build:css
```

Watch local do Sass:

```bash
npm run sass
```

Os scripts atuais fazem:

- `build:css`: compila `resources/styles/main.scss` para `public/assets/css/style.css`
- `sass`: roda `sass --watch --poll` para recompilar o CSS sempre que um arquivo SCSS for salvo

## Build da aplicação

O projeto usa build multi-stage no [Dockerfile](./Dockerfile):

- estágio `node:20-alpine` para instalar dependências e compilar o CSS
- estágio final `php:8.2-apache` para servir a aplicação

O Apache serve o diretório `public/` como document root.

## Docker

### Ambiente base

```bash
docker compose up --build
```

Esse ambiente sobe:

- `web`: aplicação PHP/Apache
- `db`: PostgreSQL 15

A aplicação fica disponível em `http://localhost:8080`.

### Desenvolvimento com watcher do Sass

```bash
docker compose -f docker-compose.yml -f docker-compose.dev.yml up --build
```

Nesse modo:

- o serviço `web` recebe bind mounts de `app/`, `public/` e `database/`
- o serviço `sass` roda separado para desenvolvimento
- o watcher executa diretamente:

```bash
./node_modules/.bin/sass --watch --poll resources/styles/main.scss:public/assets/css/style.css
```

- alterações em `resources/styles/*.scss` recompilam automaticamente o CSS
- o CSS gerado em `public/assets/css/style.css` é compartilhado com o container `web`

## Banco de dados

O backend suporta:

- PostgreSQL
- MySQL

Schemas disponíveis:

- `database/schema-postgres.sql`
- `database/schema.sql`

As variáveis suportadas pela aplicação são:

- `DB_DRIVER`
- `DB_HOST`
- `DB_PORT`
- `DB_NAME`
- `DB_USER`
- `DB_PASS`
- `DATABASE_URL`

### Docker Compose

O [docker-compose.yml](docker-compose.yml) atual está configurado para PostgreSQL:

```yaml
DB_DRIVER: pgsql
DB_HOST: db
DB_PORT: "5432"
DB_NAME: nexa_growth
DB_USER: postgres
DB_PASS: postgres
```

O container `db` inicializa o banco usando `database/schema-postgres.sql`.

## Render

O deploy em produção usa [render.yaml](/home/divino-fogao/Documents/teste-frontend-developer/render.yaml:1) com ambiente Docker e banco PostgreSQL gerenciado.
