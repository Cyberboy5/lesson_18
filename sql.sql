
CREATE DATABASE lesson_18_db;

USE lesson_18_db;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    image VARCHAR(255) NOT NULL
);

INSERT INTO products (name, price, quantity, image) 
VALUES 
('Apple iPhone 14', 999.99, 10, 'uploads/iphone14.jpg'),
('Samsung Galaxy S21', 799.99, 20, 'uploads/galaxys21.jpg'),
('Google Pixel 6', 599.99, 15, 'uploads/pixel6.jpg'),
('Sony WH-1000XM4 Headphones', 349.99, 8, 'uploads/sony_wh1000xm4.jpg'),
('Dell XPS 13 Laptop', 1199.99, 5, 'uploads/dell_xps13.jpg');
