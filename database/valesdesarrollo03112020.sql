CREATE TABLE Sucursales (
ID_Sucursal INT NOT NULL AUTO_INCREMENT,
Capital DECIMAL(10,2) NOT NULL,
Nombre_Empresa VARCHAR(50) NOT NULL,
Direccion VARCHAR(50) NOT NULL,
PRIMARY KEY(ID_Sucursal));

ALTER TABLE users ADD CONSTRAINT cliente_a_sucursal FOREIGN KEY(ID_Sucursal) REFERENCES Sucursales(ID_Sucursal);