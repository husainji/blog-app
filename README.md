# Laravel Blog Application

## Requirements
- PHP 8.1+
- Composer
- Node & npm
- MySQL
- Pusher account (for real-time notifications)

## Setup
1. Clone repository
2. `composer install`
3. `npm install && npm run dev`
4. Copy `.env.example` to `.env` and set DB, Socialite, Pusher keys
5. `php artisan key:generate`
6. `php artisan migrate`
7. (Optional) Create storage link: `php artisan storage:link`
8. `php artisan serve`

## Social Logins
Set Google and Facebook OAuth apps. Add callback URLs:
- `http://localhost:8000/auth/google/callback`
- `http://localhost:8000/auth/facebook/callback`

## Realtime
- Set Pusher keys in `.env` and run `npm run dev`

## Tests
`php artisan test`

## Notes
- Admins: set `role` column to `admin` in users table to give admin access.
