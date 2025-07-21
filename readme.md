# User CRUD REST API in Core PHP

A simple RESTful API built with core PHP for managing users, supporting **Create, Read, Update, Delete** operations.
This project demonstrates a clean architecture using classes, a custom autoloader, and MySQL database connection handling.

---

## Features

* Create users with **name**, **email**, **password** (hashed), and **date of birth (dob)**
* Read list of all users (without password)
* Update user info with unique email validation (allows unchanged email)
* Delete users by ID
* Uses prepared statements to prevent SQL injection
* Handles duplicate email errors gracefully
* Organized code with Controller class and simple autoloader
* MySQL database backend

---

## Requirements

* PHP 8.3 or higher
* MySQL
* Web server (Apache, Nginx, or built-in PHP server)

---

## Setup

### 1. Clone the repo or copy files to your local server

```bash
git clone https://github.com/ankitmishra-dev/user-crud-application-corephp.git
```

### 2. Create the database and `users` table

Run this SQL in your MySQL:

```sql
CREATE DATABASE users_crud;

USE users_crud;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    dob DATE NOT NULL
);
```

### 3. Configure database connection

Edit `database/Database.php` if needed to set your MySQL credentials:

```php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'users_crud';
```

### 4. Run the API

Make sure your web server document root points to the project directory or run the built-in PHP server:

```bash
php -S localhost:8080
```

---

## API Usage

All API endpoints are accessed through the `api.php` file with an `action` query parameter.

### Endpoints

| Action | HTTP Method | Parameters (via POST for create/update/delete)  | Description           |
| ------ | ----------- | ----------------------------------------------- | --------------------- |
| create | POST        | `name`, `email`, `password`, `dob` (YYYY-MM-DD) | Create a new user     |
| read   | GET         | None                                            | Get list of all users |
| update | POST        | `id`, `name`, `email`, `dob`                    | Update user details   |
| delete | POST        | `id`                                            | Delete a user by ID   |

### Example

**Create User**

```bash
POST /routes/api.php?action=create
Content-Type: application/x-www-form-urlencoded

name=Ankit Mishra&email=ankitmishra8268@example.com&password=secret123&dob=1999-11-14
```

**Response**

```json
{
  "status": "success",
  "message": "User created"
}
```

---

## Project Structure

```
user-crud-core-php/
├── controllers/
│   └── UserController.php       # UserController class with all CRUD methods
├── database/
│   └── Database.php             # Database connection class
├── routes/
│   └── api.php                 # API entry point & autoloader
└── README.md                   # This file
```

---

## Notes

* Passwords are stored securely using PHP's `password_hash()`.
* Duplicate email insertion or update attempts return an error message.
* The autoloader loads classes from the `controllers` and `database` folders automatically.
* No frameworks or external dependencies used; fully core PHP.
