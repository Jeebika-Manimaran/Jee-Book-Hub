# Jee Book Hub - Complete Online Library Management System

## Technologies
HTML, CSS, JavaScript, PHP 8+, MySQL, XAMPP.

## Features
- User registration with hashed passwords
- User login/logout with sessions
- Book collection loaded from MySQL
- Search by title, author and category
- Borrow books
- Prevent duplicate active borrowing
- Prevent borrowing when no copy is available
- Automatic available-copy update
- My Books page
- Return books
- Admin dashboard
- Add new books from admin dashboard
- Responsive UI

## Installation

1. Install/open XAMPP.
2. Start Apache and MySQL.
3. Copy this folder into:
   C:\xampp\htdocs\Jee_Book_Hub_Complete_System
4. Open phpMyAdmin:
   http://localhost/phpmyadmin/
5. Import:
   database/library.sql
6. Open:
   http://localhost/Jee_Book_Hub_Complete_System/

## Admin account

Register a normal account first. Then open phpMyAdmin and run:

UPDATE users SET role='admin' WHERE email='your-email@example.com';

Replace the email with the account you registered.

## Important
Do not open the PHP files by double-clicking them. Run the project through localhost/XAMPP.
