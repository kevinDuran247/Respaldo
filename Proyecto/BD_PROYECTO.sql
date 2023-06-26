CREATE DATABASE moonstore;
USE moonstore;

CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  contraseña VARCHAR(255) NOT NULL,
  dirección VARCHAR(255) NOT NULL,
  municipio VARCHAR(100) NOT NULL,
  departamento VARCHAR(100) NOT NULL,
  fecha_registro DATETIME NOT NULL,
  perfil VARCHAR(255) NOT NULL,
  tipo_usuario VARCHAR (50),
  PRIMARY KEY (id)
);


CREATE TABLE categorias (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE productos (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  descripcion VARCHAR(255) NOT NULL,
  imagen_principal VARCHAR(255),
  precio DECIMAL(10,2) NOT NULL,
  color VARCHAR(20),
  disponibilidad INT NOT NULL,
  categoria_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

CREATE TABLE imagenes_producto (
  id INT NOT NULL AUTO_INCREMENT,
  ruta VARCHAR(255) NOT NULL,
  producto_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (producto_id) REFERENCES productos(id)
);

CREATE TABLE tallas_producto (
  id INT NOT NULL AUTO_INCREMENT,
  talla VARCHAR(20) NOT NULL,
  producto_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (producto_id) REFERENCES productos(id)
);

CREATE TABLE carrito (
id INT NOT NULL AUTO_INCREMENT,
usuario_id INT NOT NULL,
producto_id INT NOT NULL,
cantidad INT NOT NULL,
subtotal DECIMAL(10,2) NOT NULL,
PRIMARY KEY (id),
FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
FOREIGN KEY (producto_id) REFERENCES productos(id)
);

CREATE TABLE compras(
id INT NOT NULL AUTO_INCREMENT,
id_transaccion VARCHAR (50),
fecha DATETIME,
estado VARCHAR(20),
email VARCHAR(100),
id_cliente VARCHAR(100),
total DECIMAL (10,2),
id_usuario INT,
PRIMARY KEY (id),
FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE detalles_compra(
id INT NOT NULL AUTO_INCREMENT,
id_compra INT,
nombre VARCHAR(200),
precio DECIMAL (10,2), 
cantidad INT,
PRIMARY KEY (id),
FOREIGN KEY (id_compra) REFERENCES compras(id)
);

CREATE TABLE noticias ( 
id INT NOT NULL AUTO_INCREMENT, 
ruta_imagen VARCHAR(255) NOT NULL, 
titulo VARCHAR (200) NOT NULL, 
descripcion TEXT NOT NULL, 
PRIMARY KEY (id) 
);
