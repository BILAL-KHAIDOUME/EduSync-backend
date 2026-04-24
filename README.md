# EduSync — School Management System

A PHP + MySQL backend handling user registration, authentication, session management, and access control for a school portal. Built with procedural PHP and Tailwind CSS for styling.

---

## Project Overview

EduSync solves the problem of secure data capture and user management for a school environment. The backend logic handles:

- **Registration** — New users fill out a form (Name, First name, Email, Password) submitted via `$_POST`
- **Login** — Email and password are validated server-side
- **Session control** — Authenticated sessions protect the dashboard; unauthenticated users are redirected to login
- **Logout** — Session is destroyed and the user is redirected to the home page
- **XSS Protection** — All user inputs are sanitized with `htmlspecialchars()` and `strip_tags()`

---

## Project Structure

```
edusync-backend/
├── public/
│   ├── index.php          # Home / landing page
│   ├── login.php          # Login form + error display ($_GET)
│   ├── register.php       # Registration form
│   └── dashboard.php      # Protected page (requires active session)
├── scripts/
│   ├── database.php       # DB connection
│   ├── login_logic.php    # Handles $_POST, validation, login
│   ├── logout.php         # Destroys session + redirect
│   └── registerlogic.php  # Handles $_POST registration + redirect
├── includes/
│   └── navbar.html        # Shared navigation component
├── package.json
├── tailwind.config.js
└── README.md
```

---

## Requirements

- PHP 7.4+
- MySQL 5.7+ (or MariaDB)
- A local server: [XAMPP](https://www.apachefriends.org/) / [WAMP](https://www.wampserver.com/) / [Laragon](https://laragon.org/)
- Node.js (for Tailwind CSS build)

---

## Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/your-username/edusync-backend.git
cd edusync-backend
```

### 2. Set up the database

1. Open **phpMyAdmin** (or your MySQL client)
2. Create a new database named `edusync`
3. Import the provided SQL file (if available) or create the `users` table manually:

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  email VARCHAR(150) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 3. Configure the database connection

Open `scripts/database.php` and update your credentials:

```php
$host = "localhost";
$dbname = "edusync";
$username = "root";
$password = "";
```

### 4. Install Tailwind CSS (optional, for development)

```bash
npm install
npx tailwindcss -i ./src/input.css -o ./dist/output.css --watch
```

### 5. Start your local server

Place the project folder inside your server's root directory:
- XAMPP → `htdocs/edusync-backend`
- Laragon → `www/edusync-backend`

Then visit: [http://localhost/edusync-backend/public/index.php](http://localhost/edusync-backend/public/index.php)

---

## User Flow

```
Register → Login → Dashboard → Logout
```

- Visiting `dashboard.php` without a session → redirected to `login.php`
- Wrong credentials → redirected to `login.php?error=1`
- Successful login → session started, redirected to `dashboard.php`
- Clicking logout → session destroyed, redirected to `index.php`

---

## Security Notes

- Passwords are hashed using `password_hash()` and verified with `password_verify()`
- All inputs are sanitized with `htmlspecialchars()` and `strip_tags()` to prevent XSS
- `session_start()` is called at the top of every relevant PHP file
- No sensitive data is passed through the URL

---

## License

This project was built as part of a school brief at **Simplon**. For educational use only.