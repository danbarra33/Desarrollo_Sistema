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


