CREATE DATABASE IF NOT EXISTS bomahomes;
USE bomahomes;

DROP TABLE IF EXISTS tenants;
DROP TABLE IF EXISTS landlords;

CREATE TABLE IF NOT EXISTS landlords (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('landlord', 'super_admin') DEFAULT 'landlord',
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tenants (
    id INT PRIMARY KEY AUTO_INCREMENT,
    landlord_id INT NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    rent_amount DECIMAL(10,2),
    payment_status ENUM('paid', 'pending', 'overdue') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (landlord_id) REFERENCES landlords(id) ON DELETE CASCADE
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

INSERT INTO tenants (landlord_id, fullname, email, phone, rent_amount, payment_status) 
VALUES 
(2, 'Alice Tenant', 'alice@example.com', '0711111111', 15000.00, 'paid'),
(2, 'Bob Tenant', 'bob@example.com', '0722222222', 12000.00, 'pending'),
(2, 'Carol Tenant', 'carol@example.com', '0733333333', 18000.00, 'overdue'),
(3, 'David Tenant', 'david@example.com', '0744444444', 22000.00, 'paid'),
(3, 'Eve Tenant', 'eve@example.com', '0755555555', 16000.00, 'pending'),
(3, 'Frank Tenant', 'frank@example.com', '0766666666', 25000.00, 'paid'),
(4, 'Grace Tenant', 'grace@example.com', '0777777777', 10000.00, 'pending'),
(4, 'Henry Tenant', 'henry@example.com', '0788888888', 13000.00, 'overdue'),
(4, 'Ivy Tenant', 'ivy@example.com', '0799999999', 19000.00, 'paid'),
(5, 'Jack Tenant', 'jack@example.com', '0700000000', 28000.00, 'paid'),
(5, 'Karen Tenant', 'karen@example.com', '0712345678', 21000.00, 'pending'),
(6, 'Leo Tenant', 'leo@example.com', '0723456789', 14000.00, 'paid'),
(6, 'Mia Tenant', 'mia@example.com', '0734567890', 17000.00, 'overdue'),
(6, 'Noah Tenant', 'noah@example.com', '0745678901', 20000.00, 'pending'),
(6, 'Olivia Tenant', 'olivia@example.com', '0756789012', 23000.00, 'paid'),
(7, 'Paul Tenant', 'paul@example.com', '0767890123', 11000.00, 'pending'),
(7, 'Quinn Tenant', 'quinn@example.com', '0778901234', 15500.00, 'paid'),
(7, 'Rose Tenant', 'rose@example.com', '0789012345', 19500.00, 'overdue'),
(7, 'Sam Tenant', 'sam@example.com', '0790123456', 26500.00, 'paid'),
(7, 'Tina Tenant', 'tina@example.com', '0701234567', 17500.00, 'pending');