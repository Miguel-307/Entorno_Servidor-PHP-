
CREATE DATABASE crabadopt;
USE crabadopt;


CREATE TABLE categorias (
    id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);


CREATE TABLE adoptantes (
    id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    nif VARCHAR(10) NOT NULL UNIQUE,
    nombre VARCHAR(200) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    alta DATE,
    baja DATE
);

CREATE TABLE cangrejos (
    id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    categoria BIGINT(11),
    fechaRecogida DATE,
    fechaAdopcion DATE,
    idAcogedor BIGINT(20),
    FOREIGN KEY (categoria) REFERENCES categorias(id),
    FOREIGN KEY (idAcogedor) REFERENCES adoptantes(id)
);


INSERT INTO categorias (nombre) VALUES
('Cangrejo rojo'),
('Cangrejo azul'),
('Cangrejo moteado');

INSERT INTO adoptantes (nif, nombre, apellidos, alta, baja) VALUES
('12345678A', 'María', 'López García', '2025-01-10', NULL),
('87654321B', 'Carlos', 'Ruiz Pérez', '2025-02-15', NULL),
('11223344C', 'Lucía', 'Fernández Díaz', '2025-03-01', NULL);

INSERT INTO cangrejos (nombre, categoria, fechaRecogida, fechaAdopcion, idAcogedor) VALUES
('Pinzas', 1, '2025-01-05', '2025-01-12', 1),
('Río', 2, '2025-02-01', '2025-02-18', 2),
('Burbuja', 3, '2025-03-02', '2025-03-10', 3);
