# Smart Methods User Management System

A small user management application built as a Smart Methods training project. Users can be added with a name and age, viewed in a table, and assigned a binary status that can be toggled without reloading the page.

## Technologies Used

- HTML for the page structure
- CSS for layout and styling
- JavaScript Fetch API (AJAX) for asynchronous status updates
- PHP for server-side processing and database access
- MySQL for storing user records
- XAMPP for the local Apache and MySQL environment

## Features

- Add a user by entering a name and age
- Store new users in the MySQL database with an initial status of `0`
- Display all users, newest first, in a table
- Show each user's status as `0` or `1`
- Toggle a user's status between `0` and `1`
- Update the status and its visual styling immediately through JavaScript Fetch without refreshing the page

## Database Structure

Create a database named `smartmethods_db` and a table named `users` with the following columns:

| Column | Type | Description |
| --- | --- | --- |
| `id` | `INT` | Primary key; auto-incrementing user ID |
| `name` | `VARCHAR(255)` | User's name |
| `age` | `INT` | User's age |
| `status` | `TINYINT` | Binary status (`0` or `1`); defaults to `0` |

Use this SQL in phpMyAdmin's SQL tab:

```sql
CREATE DATABASE IF NOT EXISTS smartmethods_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE smartmethods_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    status TINYINT NOT NULL DEFAULT 0
);
```

## Setup and Run

1. Install and open the XAMPP Control Panel.
2. Start **Apache** and **MySQL**.
3. Place this project folder in XAMPP's `htdocs` directory. For example: `C:\xampp\htdocs\smartmethods_web`.
4. Open phpMyAdmin at `http://localhost/phpmyadmin` and run the SQL above to create the database and table.
5. The PHP files are configured for the default XAMPP MySQL connection: host `localhost`, user `root`, and an empty password. If your MySQL credentials differ, update the connection settings in both `index.php` and `toggle.php`.
6. Open the application at `http://localhost/smartmethods_web/`.

Enter a name and age and submit the form. Use the **Toggle** button in a user's row to switch that user's status; the table updates without a page reload.

## File Structure

```text
smartmethods_web/
├── index.php    # User form, database insert, and users table
├── toggle.php   # Updates and returns a user's status
├── script.js    # Sends status toggle requests with Fetch/AJAX
├── style.css    # Application layout and visual styling
└── README.md    # Project documentation
```
