## Script de la tabla tipos de pago Zamora
CREATE TABLE `cat_tipos_pago` (

  `id_tipo_pago` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_pago`)
);

## Script de la tabla gastos Zamora
CREATE TABLE `gastos` (
  `id_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `id_sucursal` int(11) NOT NULL,
  `id_usuario` bigint(20) unsigned NOT NULL,
  `id_tipo_pago` int(11) NOT NULL,
  `fecha_gasto` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `monto_gasto` decimal(10,2) NOT NULL,
  `concepto` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_gasto`),
  KEY `FK_gastos_sucursales` (`id_sucursal`),
  KEY `FK_gastos_tipos_pago` (`id_tipo_pago`),
  KEY `FK_gastos_usuarios` (`id_usuario`),
  CONSTRAINT `FK_gastos_sucursales` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`),
  CONSTRAINT `FK_gastos_tipos_pago` FOREIGN KEY (`id_tipo_pago`) REFERENCES `cat_tipos_pago` (`id_tipo_pago`),
  CONSTRAINT `FK_gastos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
)