DROP DATABASE IF EXISTS red;
CREATE DATABASE red CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE red;

CREATE TABLE usuario (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('diseñador', 'cliente', 'admin', 'revisor') DEFAULT 'cliente'
);

CREATE TABLE producto (
    producto_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    precio_base DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    tipo ENUM('camiseta', 'hoodie', 'taza', 'poster', 'sticker', 'otro') NOT NULL,
    descripcion TEXT
);

CREATE TABLE inventario (
    inventario_id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    talla ENUM('XS','S','M','L','XL','XXL','N/A') DEFAULT 'N/A',
    color VARCHAR(50) DEFAULT 'default',
    stock INT NOT NULL DEFAULT 0,
    FOREIGN KEY (producto_id) REFERENCES producto(producto_id) ON DELETE CASCADE
);

INSERT INTO usuario (nombre, apellido, email, contrasena, rol) VALUES
('Admin', 'Sistema', 'admin@red.com', SHA2('admin123', 256), 'admin'),
('Carlos', 'Pérez', 'carlos@email.com', SHA2('1234', 256), 'cliente');

INSERT INTO producto (nombre, precio_base, categoria, tipo, descripcion) VALUES
('Camiseta básica', 15.99, 'Ropa', 'camiseta', 'Camiseta de algodón'),
('Taza blanca', 12.50, 'Accesorios', 'taza', 'Taza cerámica 11oz');

INSERT INTO inventario (producto_id, talla, color, stock) VALUES
(1, 'M', 'blanco', 50),
(1, 'L', 'negro', 30),
(2, 'N/A', 'blanco', 100);
