# Asistente Legal Comunitario Digital con IA (LegalBot)

## Descripción del Proyecto

**LegalBot** es una plataforma digital diseñada para facilitar el acceso a la orientación legal básica en El Salvador mediante el uso de Inteligencia Artificial.

LegalBot no es un simple chatbot conversacional; es un ecosistema legal digital especializado en el contexto salvadoreño. Combina procesamiento de lenguaje natural (IA) con un motor de reglas legales estructurado para ofrecer soluciones precisas. El sistema guía al usuario paso a paso, genera documentación legal automatizada, administra expedientes digitales y conecta a los ciudadanos con profesionales del derecho cuando la situación lo requiere.

---

## Integrantes del Equipo

| Nombre                        | Código     |
| ----------------------------- | ---------- |
| Andrea Melissa Torres Batres  | SMSS018824 |
| Nelson Javier Mejía Lemus     | SMSS051024 |
| Roberto Antonio López Ramírez | SMSS068324 |
| Gerardo Eliseo Guevara Reyes  | SMSS023624 |

---

# Tecnologías Utilizadas

## Frontend

* Vue.js 3
* JavaScript
* HTML5
* CSS3
* Axios
* Google Maps JavaScript API

## Backend

* Laravel
* PHP

## Base de Datos

* MySQL

## Inteligencia Artificial

* Groq API
* Modelo Llama 3.1 8B Instant

## Generación de Documentos

* DomPDF


---

# Requisitos Previos

Antes de ejecutar el proyecto debe tener instalado:

* PHP 8.x o superior
* Composer
* Node.js
* npm
* MySQL Server
* Git

---

# Instalación del Proyecto

## 1. Clonar el repositorio

```bash
git clone URL_DEL_REPOSITORIO
cd legalbot
```

---

## 2. Instalar dependencias de Laravel

```bash
composer install
```
---

## 3. Instalar dependencias de Vue

```bash
npm install
```

---

## 4. Instalar DomPDF

```bash
composer require barryvdh/laravel-dompdf
```

---

## 5. Instalar Google Maps

```bash
npm install @googlemaps/js-api-loader
```

---

## 6. Crear archivo .env

Copiar el archivo de ejemplo:

```bash
cp .env.example .env
```

---

## 7. Crear Base de Datos

Crear una base de datos llamada:

```sql
CREATE DATABASE legalbot;
```

Posteriormente ejecutar el script SQL incluido en el proyecto para crear todas las tablas necesarias del sistema.

---

## 8. Configurar conexión MySQL en el archivo .env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=legalbot
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

---

## 9. Configurar API de Groq

LegalBot utiliza la API de Groq para el funcionamiento del módulo **Chat Legal con Inteligencia Artificial**.

Para generar una API Key gratuita ingresar a:

https://console.groq.com/keys

Crear una nueva llave y agregarla al archivo `.env`:

```env
GROQ_API_KEY=la_llave_creada
GROQ_MODEL=llama-3.1-8b-instant
```

### Nota

La API de Groq es gratuita, pero posee límites de tokens por minuto. El sistema fue optimizado para controlar las solicitudes y evitar saturaciones mientras los tokens disponibles son renovados automáticamente.

---

## 10. Configurar API de Google Maps

LegalBot utiliza Google Maps para visualizar instituciones legales cercanas dentro del directorio institucional.

Ingresar al siguiente enlace:

https://console.cloud.google.com/welcome?project=project-0cd509e2-93ba-4b64-bf3

Habilitar la API:

* Maps JavaScript API

Generar una llave y agregarla al archivo `.env`:

```env
GOOGLE_MAPS_API_KEY=su_llave
VITE_GOOGLE_MAPS_KEY=su_llave
```

> Debe colocarse la misma llave en ambas variables para que Laravel y Vite puedan acceder correctamente a la API.

---

## 11. Generar clave de Laravel

```bash
php artisan key:generate
```

---

## 12. Ejecutar Migraciones

```bash
php artisan migrate
```

---

## 13. Cargar Reglas Legales Iniciales

Ejecutar:

```bash
php artisan db:seed --class=ReglaLegalSeeder
```

Este proceso insertará automáticamente toda la información jurídica definida en:

```text
ReglaLegalSeeder.php
```

dentro de la tabla:

```text
regla_legal
```

---

## 14. Crear Usuario Administrador

Para acceder al panel administrativo debe existir previamente un usuario con rol de administrador.

Ejecutar la siguiente sentencia SQL:

```sql
INSERT INTO usuario (
    nombre,
    apellido,
    email,
    password_hash,
    rol
)
VALUES (
    'Administrador',
    'General',
    'admin@legalbot.sv',
    '$2y$10$Vstf.iIJ98j82T25lZOsU.FFo7TIq5Kdc6voBblzU/DQC0FF4LL3q',
    'admin'
);
```

### Credenciales de Acceso

```text
Correo:
admin@legalbot.sv
```

```text
Contraseña:
admin123
o probar
1234
o
12345678
```

---

## 15. Compilar Frontend

```bash
npm run dev
```

---

## 16. Ejecutar Servidor Laravel

```bash
php artisan serve
```

---

# Acceso al Sistema

Aplicación Web:

```text
http://localhost:8000
```

Panel Administrativo:

```text
http://localhost:8000/admin
```

*(La ruta puede variar según la configuración final del proyecto.)*

---

# Funcionalidades Principales

* Chat Legal impulsado por Inteligencia Artificial.
* Sistema de triaje legal automatizado.
* Gestión de consultas legales.
* Administración de expedientes digitales.
* Generación automática de documentos legales en PDF.
* Directorio de abogados.
* Directorio de instituciones públicas.
* Geolocalización mediante Google Maps.
* Panel administrativo.
* Motor de reglas legales basado en legislación salvadoreña.
* Seguimiento de casos mediante expedientes digitales.

---

# Gestor de Base de Datos Utilizado

El sistema utiliza **MySQL** como Sistema Gestor de Base de Datos Relacional (SGBD).
La estructura de la base de datos incluye lo siguiente:

* Usuarios
* Especialidades legales
* Abogados
* Categorías legales
* Reglas legales
* Consultas
* Mensajes de consulta
* Triaje legal
* Expedientes
* Instituciones
* Expediente - Institución
* Plantillas de documentos
* Documentos generados
* Archivos adjuntos
* Estadísticas territoriales

---

# Estado del Proyecto
Proyecto académico desarrollado para la asignatura de **Programación Computacional IV**.
**Universidad Gerardo Barrios**
