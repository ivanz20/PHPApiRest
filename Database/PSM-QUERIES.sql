create database movilesdb;
use movilesdb;
select * from producto_carrito;
CREATE TABLE usuarios(
	iduser smallint unsigned auto_increment  primary key,
	email VARCHAR (100) unique,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    contrasena VARCHAR(30),
    telefono varchar(30),
    imagen mediumblob,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE producto(
	idproducto int auto_increment primary key,
    nombreproducto VARCHAR(150),
    descripcion VARCHAR(150),
    precio float,
    categoria varchar(50),
    imagen mediumblob,
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE producto_carrito(
	idcarrito int auto_increment primary key,
    talla varchar(30),
    color varchar(30),
    imagen mediumblob,
    nombreproducto varchar(100),
    precio float,
    comprado bit default false,
	created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    iduser smallint unsigned,
	FOREIGN KEY (iduser) REFERENCES usuarios(iduser)
);

drop procedure SP_USUARIO;

DELIMITER //
CREATE PROCEDURE SP_USUARIO (
	IN op int,
    IN _id smallint unsigned,
	IN _nombre varchar(100),
    IN _apellido varchar(100),
    IN _email varchar(100),
    IN _password varchar(100),
    IN _telefono varchar(30),
    IN _imagen mediumblob
)
BEGIN

	#Insertar usuario en la base de datos
	IF op = 1 THEN
		INSERT INTO usuarios (email, nombre, apellido, contrasena, telefono, imagen,created_at)
		VALUES (_email, _nombre, _apellido, _password, _telefono, _imagen,NOW());
    END IF;
    
    #Editar alias, contrasena, imagen
    IF op = 2 THEN
		UPDATE usuarios set nombre = _nombre, contrasena = _password, imagen = _imagen
        WHERE iduser = _id;
    END IF;
    
    #Inicio de sesion
    IF op = 3  THEN
		SELECT * FROM usuarios
        WHERE email = _email AND contrasena = _password limit 1;
    END IF;
END//


drop procedure SP_PRODUCTOS;
DELIMITER //
CREATE PROCEDURE SP_PRODUCTOS (
	IN op int,
    IN _idproducto int,
    IN _nombreproducto VARCHAR(150),
    IN _descripcion VARCHAR(150),
    IN _precio float,
    IN _categoria varchar(50),
    IN _imagen mediumblob
)
BEGIN

	#Insertar usuario en la base de datos
	IF op = 1 THEN
		INSERT INTO producto (nombreproducto, descripcion, precio, categoria, imagen)
		VALUES 	(_nombreproducto, _descripcion, _precio, _categoria, _imagen);
    END IF;
    
    #FindById
    IF op = 2 THEN
		SELECT * FROM producto
        WHERE idproducto = _idproducto;
    END IF;
    
    IF op = 3 THEN
		#Busqueda
		SELECT * FROM producto
		WHERE nombreproducto like CONCAT(_nombreproducto,'%')  ORDER By nombreproducto limit 10;
    END IF;
END//

SELECT * FROM producto
		WHERE nombreproducto like CONCAT(_nombreproducto,'%')  ORDER By nombreproducto limit 10;
    

drop procedure SP_CARRITO;
DELIMITER //
CREATE PROCEDURE SP_CARRITO (
	IN op int,
	IN _idcarrito int,
    IN _talla varchar(30),
    IN _color varchar(30),
    IN _imagen mediumblob,
    IN _nombreproducto varchar(100),
    IN _precio float,
    IN _iduser smallint unsigned
    )
BEGIN

	#Insertar usuario en la base de datos
	IF op = 1 THEN
		INSERT INTO producto_carrito (talla, color, imagen, nombreproducto, precio, iduser)
		VALUES (_talla, _color, _imagen, _nombreproducto, _precio, _iduser);
    END IF;
    
    #FindByUserId
    IF op = 2 THEN
		SELECT * FROM  producto_carrito
        WHERE iduser = _iduser AND comprado = false;
    END IF;
    
	#Borrar producto de carrito
    IF op = 3 THEN
		DELETE  FROM  producto_carrito
        WHERE idcarrito = _idcarrito;
    END IF;
    
    #Compra
    IF op = 4 THEN
		UPDATE  producto_carrito SET comprado = TRUE 
		WHERE comprado = false AND iduser = _iduser;
	END IF;
    
END//

CALL SP_USUARIO (1,NULL,'haime','Rodgriguez','jaime@hotmail.com','jaime2022','8671417389','C:\\Users\\ivanz\\Downloads\\w-a-s-d.jpg');




