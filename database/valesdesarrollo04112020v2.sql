# Renombrando la tabla sucursales
rename table Sucursales to sucursales;

#Borrando la clave foranea para poder renombrar el cambo de id_sucursal
ALTER TABLE users DROP FOREIGN KEY cliente_a_sucursal; 

#Renombrando los nombres de las columnas
alter table sucursales CHANGE ID_Sucursal id_sucursal int auto_increment;
alter table sucursales CHANGE Capital capital decimal(10,2);
alter table sucursales CHANGE Nombre_Empresa nombre_empresa varchar(50);
alter table sucursales CHANGE Direccion direccion varchar(50);

#Creando la llave foranea de clientes a sucursales
ALTER TABLE users ADD CONSTRAINT cliente_a_sucursal FOREIGN KEY(id_sucursal) REFERENCES sucursales(id_sucursal);

#Renombrando los nombres de las columnas de la tabla avales
alter table avales CHANGE iD_Aval id_aval int auto_increment;
alter table avales CHANGE iD_Cliente id_cliente int;
alter table avales CHANGE CURP curp char(18);
alter table avales CHANGE RFC rfc varchar(13);
alter table avales CHANGE Folio_INE folio_ine char(13);
alter table avales CHANGE Direccion direccion varchar(50);
alter table avales CHANGE Telefono telefono varchar(10);

#Renombrando los nombres de las columnas de la tabla clientes
alter table clientes CHANGE iD_Cliente id_cliente int auto_increment;
alter table clientes CHANGE Nombre nombre varchar(45);
alter table clientes CHANGE Folio_INE folio_ine char(13);
alter table clientes CHANGE Direccion direccion varchar(50);
alter table clientes CHANGE Telefono telefono varchar(10);
alter table clientes CHANGE Status status char(1);
alter table clientes CHANGE Salario_Mensual salario_mensual float;

