##Modificaciones a la tabla documentos

##Eliminar las columnas ruta_comprobante_domicilio, ruta_comprobante_ingresos,ruta_ine
ALTER TABLE documentos DROP COLUMN ruta_comprobante_domicilio, DROP COLUMN ruta_comprobante_ingresos, DROP COLUMN ruta_ine;

##Agregando una nueva columna a ala tabla documentos
ALTER TABLE documentos ADD ruta varchar(300);