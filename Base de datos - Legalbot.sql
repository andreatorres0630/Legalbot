CREATE DATABASE legalbot;
USE legalbot;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(150) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    departamento VARCHAR(100),
    municipio VARCHAR(100),
    rol ENUM('ciudadano', 'empleador', 'ong', 'admin') NOT NULL DEFAULT 'ciudadano',
    ultimo_login TIMESTAMP NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE especialidad_legal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT
);

CREATE TABLE abogado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    especialidad_id INT NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    whatsapp VARCHAR(20),
    email VARCHAR(150),
    direccion VARCHAR(250),
    disponible TINYINT(1) NOT NULL DEFAULT 1,
    verificado TINYINT(1) NOT NULL DEFAULT 1,
    FOREIGN KEY (especialidad_id) REFERENCES especialidad_legal(id)
);

CREATE TABLE categoria_legal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    icono VARCHAR(50),
    activa TINYINT NOT NULL DEFAULT 1
);


CREATE TABLE regla_legal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT,
    ley_referencia VARCHAR(200),
    articulo VARCHAR(50),
    vigente TINYINT NOT NULL DEFAULT 1,
    FOREIGN KEY (categoria_id) REFERENCES categoria_legal(id)
);

CREATE TABLE expediente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    numero VARCHAR(50) UNIQUE NOT NULL,
    estado ENUM('abierto', 'en_proceso', 'resuelto', 'cerrado') NOT NULL DEFAULT 'abierto',
    descripcion TEXT,
    apertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cierre TIMESTAMP NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

CREATE TABLE consulta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    expediente_id INT NULL,
    categoria_id INT NULL,
    abogado_recomendado_id INT NULL,
    pregunta TEXT NOT NULL,
    respuesta_ia TEXT,
    estado ENUM('pendiente', 'respondida', 'escalada', 'cerrada') NOT NULL DEFAULT 'pendiente',
    prioridad ENUM('baja', 'media', 'alta', 'urgente') NOT NULL DEFAULT 'media',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id),
    FOREIGN KEY (expediente_id) REFERENCES expediente(id),
    FOREIGN KEY (categoria_id) REFERENCES categoria_legal(id),
    FOREIGN KEY (abogado_recomendado_id) REFERENCES abogado(id)
);

CREATE TABLE mensaje_consulta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consulta_id INT NOT NULL,
    remitente ENUM('usuario', 'ia') NOT NULL,
    mensaje TEXT NOT NULL,
    enviado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (consulta_id) REFERENCES consulta(id)
);

CREATE TABLE triaje_consulta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consulta_id INT NOT NULL,
    nivel_riesgo ENUM('bajo', 'medio', 'alto', 'critico') NOT NULL,
    factores JSON,
    derivado_a ENUM('ia', 'abogado', 'ong', 'emergencias') NOT NULL,
    procesado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (consulta_id) REFERENCES consulta(id)
);

CREATE TABLE plantilla_documento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    contenido longtext,
    categoria_id INT,
    activa TINYINT DEFAULT 1,
    FOREIGN KEY (categoria_id) REFERENCES categoria_legal(id)
);

CREATE TABLE documento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consulta_id INT NULL,
    usuario_id INT NOT NULL,
    plantilla_id INT NULL,
    titulo VARCHAR(200) NOT NULL,
    contenido TEXT,
    archivo_url VARCHAR(500),
    generado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (consulta_id) REFERENCES consulta(id),
    FOREIGN KEY (usuario_id) REFERENCES usuario(id),
    FOREIGN KEY (plantilla_id) REFERENCES plantilla_documento(id)
);

CREATE TABLE archivo_adjunto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consulta_id INT NOT NULL,
    nombre_archivo VARCHAR(255) NOT NULL,
    url_archivo VARCHAR(500) NOT NULL,
    tipo VARCHAR(50),
    subido_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (consulta_id) REFERENCES consulta(id)
);

CREATE TABLE institucion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(200) NOT NULL,
    tipo ENUM(
        'PNC',
        'Ministerio de Trabajo',
        'Alcaldia',
        'Juzgado',
        'Fiscalia',
        'CNR',
        'ONG'
    ) NOT NULL,
    telefono VARCHAR(20),
    direccion VARCHAR(300),
    latitud DECIMAL(10,7),
    longitud DECIMAL(10,7),
    horario VARCHAR(200)
);

CREATE TABLE expediente_institucion (
    expediente_id INT NOT NULL,
    institucion_id INT NOT NULL,
    PRIMARY KEY (expediente_id, institucion_id),
    FOREIGN KEY (expediente_id) REFERENCES expediente(id),
    FOREIGN KEY (institucion_id) REFERENCES institucion(id)
);

CREATE TABLE estadistica_zona (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NULL,
    departamento VARCHAR(100) NOT NULL,
    municipio VARCHAR(100),
    total_consultas INT NOT NULL DEFAULT 0,
    total_urgentes INT NOT NULL DEFAULT 0,
    periodo DATE NOT NULL COMMENT 'Primer día del mes',
    FOREIGN KEY (categoria_id) REFERENCES categoria_legal(id)
);


ALTER TABLE plantilla_documento ADD contenido longtext;

ALTER TABLE documento
ADD estado ENUM('borrador','generado','descargado')
DEFAULT 'borrador';
