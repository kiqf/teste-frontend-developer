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

## Banco de dados

- `database/schema.sql`: MySQL
- `database/schema-postgres.sql`: PostgreSQL

As credenciais podem ser configuradas por `DB_*` ou `DATABASE_URL`.
