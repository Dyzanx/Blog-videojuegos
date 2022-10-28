CREATE TABLE IF NOT EXISTS usuarios(
	id int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(255),
    apellido varchar(255),
    email varchar(255),
    contraseña varchar(255),
    fecha DATE
);

CREATE TABLE IF NOT EXISTS categorias(
	id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre varchar(255)
);

CREATE TABLE IF NOT EXISTS entradas(
	id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id int(255),
    categoria_id int(255),
    titulo varchar(255),
    descripcion LONGTEXT,
    fecha DATE
);

ALTER TABLE entradas
ADD FOREIGN KEY (user_id) REFERENCES usuarios(id);

ALTER TABLE entradas
ADD FOREIGN KEY (categoria_id) REFERENCES categorias(id);