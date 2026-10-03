CREATE DATABASE IF NOT EXISTS library_db;
USE library_db;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user','admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    author VARCHAR(150) NOT NULL,
    category VARCHAR(100) NOT NULL,
    available_copies INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS issues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    issue_date DATE NOT NULL,
    return_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);

INSERT INTO books (title,author,category,available_copies)
SELECT 'Atomic Habits','James Clear','Self Help',4
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title='Atomic Habits');

INSERT INTO books (title,author,category,available_copies)
SELECT 'Clean Code','Robert C. Martin','Programming',3
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title='Clean Code');

INSERT INTO books (title,author,category,available_copies)
SELECT 'The Alchemist','Paulo Coelho','Fiction',5
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title='The Alchemist');

INSERT INTO books (title,author,category,available_copies)
SELECT 'Python Crash Course','Eric Matthes','Programming',3
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title='Python Crash Course');

INSERT INTO books (title,author,category,available_copies)
SELECT 'Ikigai','Hector Garcia','Lifestyle',4
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title='Ikigai');

INSERT INTO books (title,author,category,available_copies)
SELECT 'Rich Dad Poor Dad','Robert Kiyosaki','Finance',4
WHERE NOT EXISTS (SELECT 1 FROM books WHERE title='Rich Dad Poor Dad');

-- Optional admin:
-- Register a normal account first, then run:
-- UPDATE users SET role='admin' WHERE email='your-email@example.com';
