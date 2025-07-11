BASE DE DATOS BASE:

## 🗄️ Estructura SQL de la Base de Datos

```sql
-- ==============================================
-- 0) Eliminar tablas existentes en orden de dependencia
--    Así garantizamos un “lienzo limpio” antes de recrear todo
DROP TABLE IF EXISTS `anuncios`;
DROP TABLE IF EXISTS `categorias`;
DROP TABLE IF EXISTS `usuarios`;
-- ==============================================

-- ==============================================
-- 1) Crear tabla `usuarios`
--    Almacena datos básicos y fecha de nacimiento para validar ≥18 años
CREATE TABLE `usuarios` (
  `id` INT UNSIGNED      NOT NULL AUTO_INCREMENT COMMENT 'PK: Identificador único de usuario',
  `nombre` VARCHAR(50)    NOT NULL                COMMENT 'Nombre propio del usuario',
  `apellido` VARCHAR(50)  NOT NULL                COMMENT 'Apellido del usuario',
  `email` VARCHAR(100)    NOT NULL UNIQUE         COMMENT 'Correo electrónico, debe ser único',
  `password_hash` VARCHAR(255) NOT NULL           COMMENT 'Hash seguro de la contraseña',
  `telefono` VARCHAR(20)                      NULL COMMENT 'Teléfono de contacto (opcional)',
  `fecha_nacimiento` DATE      NOT NULL             COMMENT 'Fecha de nacimiento (≥18 años)',
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Marca de creación de cuenta',
  `estado` ENUM('activo','inactivo') NOT NULL DEFAULT 'activo' COMMENT 'Estado de la cuenta',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Usuarios registrados en la plataforma';

-- ==============================================
-- 2) Crear tabla `categorias`
--    Define los tipos de servicios que pueden anunciarse
CREATE TABLE `categorias` (
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PK: Identificador de categoría',
  `nombre` VARCHAR(50)    NOT NULL UNIQUE        COMMENT 'Nombre de la categoría (ej. Cultural, Médico)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Catálogo de categorías de servicios';

-- ==============================================
-- 3) Crear tabla `anuncios`
--    Guarda los servicios publicados, vinculados a usuarios y categorías
CREATE TABLE `anuncios` (
  `id` INT UNSIGNED       NOT NULL AUTO_INCREMENT COMMENT 'PK: Identificador único de anuncio',
  `usuario_id` INT UNSIGNED NOT NULL              COMMENT 'FK → usuarios(id): quien publica',
  `categoria_id` TINYINT UNSIGNED NOT NULL        COMMENT 'FK → categorias(id): tipo de servicio',
  `titulo` VARCHAR(100)   NOT NULL                COMMENT 'Título breve del servicio',
  `descripcion` TEXT      NOT NULL                COMMENT 'Descripción detallada del servicio',
  `precio` DECIMAL(10,2)  NOT NULL                COMMENT 'Precio (por hora/día u otro criterio)',
  `ubicacion` VARCHAR(100)                  NULL COMMENT 'Zona o localidad del servicio',
  `fecha_publicacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de alta',
  `fecha_expiracion` DATETIME              NULL COMMENT 'Fecha opcional de caducidad',
  `estado` ENUM('publicado','pausado','finalizado') NOT NULL DEFAULT 'publicado' COMMENT 'Visibilidad del anuncio',
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_anuncios_usuario`   FOREIGN KEY (`usuario_id`)   REFERENCES `usuarios`(`id`)   ON DELETE CASCADE,
  CONSTRAINT `fk_anuncios_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Servicios ofrecidos por usuarios';

-- ==============================================
-- 4) Crear índices en `anuncios`
--    Mejoran rendimiento de búsquedas frecuentes por usuario o categoría
CREATE INDEX `idx_anuncios_usuario`   ON `anuncios` (`usuario_id`);
CREATE INDEX `idx_anuncios_categoria` ON `anuncios` (`categoria_id`);

-- ==============================================
-- 5) Crear triggers para validar mayor de edad en `usuarios`
--    Se asegura en INSERT y UPDATE que fecha_nacimiento ≤ hoy−18 años

-- Cambiar delimitador para cuerpos de trigger
DELIMITER //

-- Trigger BEFORE INSERT: impide registro de menores de 18 años
CREATE TRIGGER `usuarios_antes_insert`
BEFORE INSERT ON `usuarios`
FOR EACH ROW
BEGIN
  IF NEW.`fecha_nacimiento` > DATE_SUB(CURDATE(), INTERVAL 18 YEAR) THEN
    SIGNAL SQLSTATE '45000' 
      SET MESSAGE_TEXT = 'ERROR: Debe ser mayor de 18 años para registrarse';
  END IF;
END;
//

-- Trigger BEFORE UPDATE: impide actualizar fecha a edad <18 años
CREATE TRIGGER `usuarios_antes_update`
BEFORE UPDATE ON `usuarios`
FOR EACH ROW
BEGIN
  IF NEW.`fecha_nacimiento` > DATE_SUB(CURDATE(), INTERVAL 18 YEAR) THEN
    SIGNAL SQLSTATE '45000' 
      SET MESSAGE_TEXT = 'ERROR: La fecha de nacimiento indica menor de 18 años';
  END IF;
END;
//

-- Restaurar delimitador estándar
DELIMITER ;
-- ==============================================

## Ejecutar la aplicación de ejemplo

1. Instalar dependencias y generar el autoloader:
   ```bash
   composer dump-autoload
   ```
2. Configurar los datos de conexión en `config/database.php`.
3. Puedes apuntar el DocumentRoot al directorio del proyecto. El archivo
   `index.php` ubicado en la raíz redirige automáticamente a `public/`, por lo
   que no es necesario cambiar la configuración del servidor.
4. Visita `http://localhost/conoceme` (ajustando la ruta según corresponda) y
   se te mostrará la página de inicio.

Esta aplicación usa un esquema MVC básico en PHP y Tailwind para la presentación.
