CREATE DATABASE IF NOT EXISTS `inventariov1`; 
USE `inventariov1`;

-- Estructura para tabla inventariov1.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
);

-- Datos para la tabla inventariov1.categorias
INSERT INTO `categorias` (`id`, `nombre`) VALUES
	(9, 'Alimentos y Bebidas'),
	(6, 'Deportes y Fitness'),
	(4, 'Herramientas y Bricolaje'),
	(2, 'Hogar y Cocina'),
	(10, 'Jardinería'),
	(5, 'Limpieza y Mantenimiento'),
	(7, 'Moda y Accesorios'),
	(3, 'Oficina y Papelería'),
	(8, 'Salud y Belleza'),
	(1, 'Tecnología');

-- Estructura para tabla inventariov1.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `cantidad` int NOT NULL DEFAULT '0',
  `precio` decimal(10,2) NOT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `categoria_id` int DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL
);

-- Volcando datos para la tabla inventariov1.productos
INSERT INTO `productos` (`id`, `nombre`, `cantidad`, `precio`, `fecha_creacion`, `categoria_id`, `fecha_modificacion`) VALUES
	(1, 'Smartwatch Deportivo X4', 25, 120.50, '2025-11-23 02:45:02', 1, NULL),
	(2, 'Audífonos Inalámbricos Bluetooth', 70, 45.99, '2025-11-23 02:45:02', 1, NULL),
	(3, 'Tostadora de Acero Inoxidable', 15, 38.00, '2025-11-23 02:45:02', 2, NULL),
	(4, 'Vajilla de Cerámica (4 Puestos)', 11, 65.90, '2025-11-23 02:45:02', 2, NULL),
	(5, 'Archivador Metálico 3 Gavetas', 8, 99.00, '2025-11-23 02:45:02', 3, NULL),
	(6, 'Paquete de Marcadores Permanentes (12)', 95, 11.50, '2025-11-23 02:45:02', 3, NULL),
	(7, 'Sierra Circular Eléctrica 7"', 9, 135.99, '2025-11-23 02:45:02', 4, NULL),
	(8, 'Juego de Llaves Fijas Métricas', 40, 32.75, '2025-11-23 02:45:02', 4, NULL),
	(9, 'Detergente Líquido Concentrado 3L', 150, 12.50, '2025-11-23 02:45:02', 5, NULL),
	(10, 'Mopa de Microfibra con Spray', 60, 21.90, '2025-11-23 02:45:02', 5, NULL),
	(11, 'Colchoneta de Yoga Antideslizante', 55, 18.00, '2025-11-23 02:45:02', 6, NULL),
	(12, 'Mancuernas Ajustables (Par)', 14, 85.00, '2025-11-23 02:45:02', 6, NULL),
	(13, 'Bufanda de Lana Tejida', 30, 24.99, '2025-11-23 02:45:02', 7, NULL),
	(14, 'Reloj de Pulsera Clásico Cuero', 17, 78.50, '2025-11-23 02:45:02', 7, NULL),
	(15, 'Bloqueador Solar FPS 50', 110, 15.75, '2025-11-23 02:45:02', 8, NULL),
	(16, 'Cepillo Dental Eléctrico', 23, 49.95, '2025-11-23 02:45:02', 8, NULL),
	(17, 'Café Molido Premium (500g)', 85, 14.00, '2025-11-23 02:45:02', 9, NULL),
	(18, 'Agua Mineral con Gas (Caja 12)', 200, 9.99, '2025-11-23 02:45:02', 9, NULL),
	(19, 'Semillas de Tomate Cherry', 180, 2.50, '2025-11-23 02:45:02', 10, NULL),
	(20, 'Kit de Herramientas de Jardín (3 Pzas)', 35, 19.90, '2025-11-23 02:45:02', 10, NULL);

-- Estructura para tabla inventariov1.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- Estructura datos para la tabla inventariov1.usuarios
INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
	(1, 'test@gmail.com', '$2y$10$Tm5SFPqGQZP4ZpXw7XgicOb3Mo59FN.XvsXOjPbelMMSaUoLD32sC');