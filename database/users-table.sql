-- ====================================================
--  FILE: database/users-table.sql
--  PURPOSE: Creates the "users" table required by
--  register.php, login.php, and logout.php.
--
--  HOW TO RUN THIS:
--  1. Open http://localhost/phpmyadmin
--  2. Select (or create) the "decornest" database
--  3. Click the "SQL" tab and paste this code, then Go
-- ====================================================

CREATE DATABASE IF NOT EXISTS decornest
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE decornest;

CREATE TABLE IF NOT EXISTS users (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  full_name     VARCHAR(100)  NOT NULL,
  email         VARCHAR(150)  NOT NULL UNIQUE,
  phone         VARCHAR(20)   NOT NULL,
  address       VARCHAR(255)  NOT NULL,
  password      VARCHAR(255)  NOT NULL,   -- stored using password_hash()
  role          ENUM('customer', 'admin') NOT NULL DEFAULT 'customer',
  created_at    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Optional: create one test admin account
-- (password is "admin123" - hashed below using PHP's password_hash)
-- You can also just register a normal account and manually
-- change its role to 'admin' in phpMyAdmin for testing.