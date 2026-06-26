CREATE DATABASE IF NOT EXISTS bomahomes;
USE bomahomes;

CREATE TABLE IF NOT EXISTS landlords (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('landlord', 'super_admin') DEFAULT 'landlord',
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO landlords (fullname, email, password, role, is_active) 
VALUES (
    'System Administrator',
    'admin@bomahomes.com',
    '$2y$10$hBf9qD3xFsYGpBzf2uJkJOgZ8KZ8vJ8f8Xg8Y8Z8a8b8c8d8e8f8g8',
    'super_admin',
    1
);

INSERT INTO landlords (fullname, email, password, role, is_active) 
VALUES 
('John Landlord', 'john@bomahomes.com', '$2y$10$hBf9qD3xFsYGpBzf2uJkJOgZ8KZ8vJ8f8Xg8Y8Z8a8b8c8d8e8f8g8', 'landlord', 1),
('Mary Landlord', 'mary@bomahomes.com', '$2y$10$hBf9qD3xFsYGpBzf2uJkJOgZ8KZ8vJ8f8Xg8Y8Z8a8b8c8d8e8f8g8', 'landlord', 1),
('Peter Landlord', 'peter@bomahomes.com', '$2y$10$hBf9qD3xFsYGpBzf2uJkJOgZ8KZ8vJ8f8Xg8Y8Z8a8b8c8d8e8f8g8', 'landlord', 1),
('Grace Landlord', 'grace@bomahomes.com', '$2y$10$hBf9qD3xFsYGpBzf2uJkJOgZ8KZ8vJ8f8Xg8Y8Z8a8b8c8d8e8f8g8', 'landlord', 1),
('James Landlord', 'james@bomahomes.com', '$2y$10$hBf9qD3xFsYGpBzf2uJkJOgZ8KZ8vJ8f8Xg8Y8Z8a8b8c8d8e8f8g8', 'landlord', 1),
('Sarah Landlord', 'sarah@bomahomes.com', '$2y$10$hBf9qD3xFsYGpBzf2uJkJOgZ8KZ8vJ8f8Xg8Y8Z8a8b8c8d8e8f8g8', 'landlord', 1);