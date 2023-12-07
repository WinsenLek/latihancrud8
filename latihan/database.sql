-- Create the database
CREATE DATABASE IF NOT EXISTS latihan;

-- Use the database
USE latihan;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL PRIMARY KEY,
  `nama_lengkap` varchar(255) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `jurusan` varchar(255) NOT NULL
);


-- Add a unique constraint to the username column to ensure uniqueness
ALTER TABLE users ADD UNIQUE (username);