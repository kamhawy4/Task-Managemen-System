# PHP Native Task App (MVC, OOP, PDO)

This is a minimal native PHP task management application implementing the technical assignment requirements.

## Features
- Native PHP (no frameworks) using OOP and a simple MVC structure.
- User register / login / logout (session-based).
- Tasks: create / view / edit / delete (users manage only their tasks).
- MySQL (PDO) repository layer, migrations, seed SQL.
- CSRF protection, input validation, password hashing.
- Pagination, error logging, simple router, and service layer.

## Setup (local)
1. Copy the project to your web server root or point your virtual host to `public/`.
2. Create a MySQL database and user. Default config is in `config/config.php`.
3. Run SQL script `database/schema.sql` to create tables and insert a default user.
4. Update `config/config.php` with your DB credentials.
5. Ensure `storage/logs` is writable by the web server.
6. Access the app (e.g. http://localhost/) and login with the default seeded user.

## Default Credentials
A default user is already created in the database:

- **Email:** `alice@example.com`  
- **Password:** `123456`

You can also register new users from the registration page.

## Notes / Security
- CSRF tokens are checked on POST routes.
- Passwords use `password_hash`.
- Input is validated and sanitized minimally; extend as needed.
- For production, use HTTPS, proper session settings, and stronger input validation.

## Files structure
- `public/` - front controller and assets
- `src/` - Controllers, Models, Services, Repositories, Core
- `views/` - PHP templates
- `database/schema.sql` - schema + seed
- `config/config.php` - configuration

