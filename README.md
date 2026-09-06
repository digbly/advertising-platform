## Setup

```bash
# API and Admin (Laravel)
composer setup
php artisan passport:client --password --name="Users" --provider=users
```

Set id and secret to `.env`

```bash
PASSPORT_PASSWORD_CLIENT_ID=
PASSPORT_PASSWORD_CLIENT_SECRET=
```

## Development

- Run backend dev

```bash
composer dev
```

- Run client dashboard dev

```bash
cd dashboard
npm run dev
```
