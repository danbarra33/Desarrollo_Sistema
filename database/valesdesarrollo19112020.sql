create table prestamos(
id_prestamo int not null auto_increment primary key,
id_sucursal int not null,
id_cliente int not null,
id_usuario bigint(20) unsigned not null,
fecha_prestamo timestamp not null,
monto_prestamo decimal (10,2) not null,
interes_prestamo decimal (4,2) not null,
saldo decimal(10,2) not null,
plazo varchar(10) not null,
status char(1) not null,
constraint FK_prestamos_sucursales foreign key (id_sucursal) references sucursales(id_sucursal),
constraint FK_prestamos_clientes foreign key (id_cliente) references clientes(id_cliente),
constraint FK_prestamos_usuarios foreign key (id_usuario) references users(id)
);

create table documentos(
id_usuario bigint(20) unsigned not null primary key,
tipo_documento int not null,
ruta_ine varchar(200) not null,
ruta_comprobante_ingresos varchar(200) not null,
ruta_comprobante_domicilio varchar(200) not null, 
constraint FK_documentos_usuarios foreign key (id_usuario) references users(id)
);