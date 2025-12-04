CREATE DATABASE IF NOT EXISTS biblioteca_personal;
USE biblioteca_personal;

-- =========================
--  TABLA: autores
-- =========================
CREATE TABLE autores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  apellido VARCHAR(100) NOT NULL,
  nacionalidad VARCHAR(100),
  fecha_nacimiento DATE,
  biografia TEXT,
  foto_url VARCHAR(255),
  estado ENUM('activo','inactivo') DEFAULT 'activo',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL
);

-- =========================
--  TABLA: categorias
-- =========================
CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  descripcion TEXT,
  estado ENUM('activo','inactivo') DEFAULT 'activo'
);

-- =========================
--  TABLA: libros
-- =========================
CREATE TABLE libros (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  autor_id INT,
  categoria_id INT,
  anio_publicacion INT,
  descripcion TEXT,
  condicion VARCHAR(100),
  estado ENUM('activo','inactivo') DEFAULT 'activo',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  
  CONSTRAINT fk_libro_autor 
    FOREIGN KEY (autor_id) REFERENCES autores(id)
      ON DELETE SET NULL ON UPDATE CASCADE,

  CONSTRAINT fk_libro_categoria 
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
      ON DELETE SET NULL ON UPDATE CASCADE
);

-- =========================
--  TABLA: prestamos
-- =========================
CREATE TABLE prestamos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  libro_id INT,
  nombre_prestamista VARCHAR(100),
  email_prestamista VARCHAR(100),
  fecha_prestamo DATE,
  fecha_devolucion_esperada DATE,
  fecha_devolucion_real DATE NULL,
  estado ENUM('activo','devuelto','vencido'),
  notas TEXT,
  
  CONSTRAINT fk_prestamo_libro
    FOREIGN KEY (libro_id) REFERENCES libros(id)
      ON DELETE CASCADE ON UPDATE CASCADE
);
