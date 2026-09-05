### Development

```bash
# API (Laravel)
cd api
composer setup
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan passport:client --password --name="Users" --provider=users

composer dev
```
