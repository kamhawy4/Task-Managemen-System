-- SQL schema for task_app (MySQL)
CREATE DATABASE IF NOT EXISTS task_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE task_app;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(200) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  status ENUM('pending','in_progress','done') DEFAULT 'pending',
  due_date DATE NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- seed
INSERT INTO users (name,email,password) VALUES
    ('Alice','alice@example.com','$2y$10$Jwusu/RhiMjb2zRUqnO5k.y/2GbgRy/U.NL57iVvYwopzfHplkFGi');


INSERT INTO tasks (user_id,title,description,status,due_date) VALUES
(1,'Welcome task','This is your first task','pending',NULL);
