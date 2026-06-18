CREATE DATABASE IF NOT EXISTS bomahomes;
USE bomahomes;

-- USERS TABLE
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    national_id VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','landlord','tenant') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- PROPERTIES TABLE
CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    landlord_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    location VARCHAR(150) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    bedrooms INT,
    bathrooms INT,
    description TEXT,
    image VARCHAR(255),
    status ENUM('Available','Occupied') DEFAULT 'Available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (landlord_id) REFERENCES users(id) ON DELETE CASCADE
);

-- MESSAGES TABLE
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100),
    email VARCHAR(100),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- DEFAULT ADMIN
INSERT INTO users(fullname,email,password,role)
VALUES(
'Administrator',
'admin@bomahomes.com',
'$2y$10$Jr4e9U4DqM2P7W3H4Q4dSeF7mZQ4A5qJ9r0wS5d2nQ5QmPj3qQv4e',
'admin'
);