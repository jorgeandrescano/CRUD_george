CREATE DATABASE crud_george;

USE crud_george;

CREATE TABLE categoria(
    idCategoria INT  AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) UNIQUE NOT NULL
);

CREATE TABLE producto(
    idProducto INT AUTO_INCREMENT PRIMARY KEY,
    idCategoria INT NOT NULL,
    nombre VARCHAR(30) UNIQUE NOT NULL,
    precio DOUBLE(8,2) NOT NULL,
    estado INT(1) NOT NULL,
    FOREIGN KEY (idCategoria) REFERENCES categoria(idCategoria)
);

CREATE TABLE rol(
    idRol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);

CREATE TABLE usuario(
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombreUsuario VARCHAR(20) NOT NULL,
    contrasena VARCHAR(300) NOT NULL,
    idRol INT NOT NULL,
    estado INT NOT NULL,
    FOREIGN KEY (idRol) REFERENCES rol (idRol)
);

CREATE TABLE cliente(
    idCliente INT AUTO_INCREMENT PRIMARY KEY,
    razonSocial VARCHAR(80) NOT NULL,
    direccion VARCHAR(80) NOT NULL
);

CREATE TABLE pedido(
    idPedido INT(10) AUTO_INCREMENT PRIMARY KEY,
    idCliente INT NOT NULL,
    fecha DATETIME NOT NULL,
    estado INT(1),
    idUsuario INT,
    FOREIGN KEY (idCliente) REFERENCES cliente (idCliente)
);

CREATE TABLE detalle_pedido(
    idDetallePedido INT AUTO_INCREMENT PRIMARY KEY,
    idPedido INT,
    idProducto INT,
    cantidad INT NOT NULL,
    precio INT,
    FOREIGN KEY (idPedido) REFERENCES pedido (idPedido),
    FOREIGN KEY (idProducto) REFERENCES producto (idProducto)
);