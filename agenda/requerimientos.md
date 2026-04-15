# Documentación de Requerimientos - Agenda PHP

## 1. Resumen del Proyecto

Aplicación PHP ABM/CRUD para gestionar una **agenda de contactos personales** organizada por **categorías**.

### Características Principales
- Gestionar contactos (personas) con sus datos
- Clasificar contactos por categorías
- Operaciones CRUD completas sobre ambas entidades

---

## 2. Base de Datos

### Nombre: `agenda`

### Conexión
| Parámetro | Valor |
|----------|-------|
| Host | localhost |
| Puerto | 3307 |
| Usuario | root |
| Contraseña | (vacía) |
| BD | agenda |

---

## 3. Esquema de Tablas

### Tabla: `personas`

| Campo | Tipo | PK | FK | Nullable | Descripción |
|-------|------|-----|-----|-----------|-------------|
| id | INT | ✓ | - | NO | Identificador único auto-incremental |
| nombre | VARCHAR(255) | - | - | NO | Nombre de la persona |
| apellidos | VARCHAR(255) | - | - | SI | Apellidos |
| telefono | VARCHAR(50) | - | - | SI | Teléfono de contacto |
| categoria_id | INT | - | ✓ | SI | FK a categorias.categoria_id |

**Relación:** Una persona pertenece a una categoría (relación N:1).

---

### Tabla: `categorias`

| Campo | Tipo | PK | FK | Nullable | Descripción |
|-------|------|-----|-----|-----------|-------------|
| categoria_id | INT | ✓ | - | NO | Identificador único |
| nombre | VARCHAR(255) | - | - | NO | Nombre de la categoría |
| descripcion | TEXT | - | - | SI | Descripción detallada |

---

## 4. Archivos PHP Requeridos

### 4.1 Archivo: `varios.php` (Funciones Auxiliares)

**Estado:** ✓ Implementado

**Propósito:** Contiene funciones reutilizables para toda la aplicación.

**Funciones existentes:**

| Función | Descripción |
|--------|-------------|
| `conectarPDO($ip, $port, $user, $pass, $database)` | Establece conexión PDO a MySQL |
| `selectCategorias($pdo)` | Obtiene todas las categorías |
| `selectContactos($pdo)` | Obtiene personas con nombre de categoría (LEFT JOIN) |
| `selectPersonalizado($pdo, $query, $campos)` | Ejecuta query con parámetros |
| `selectDatos($pdo, $query)` | Ejecuta query simple |
| `eliminarContacto($pdo, $id)` | Elimina persona por ID |
| `eliminarCategoria($pdo, $id)` | Elimina categoría (y limpia FK en personas) |
| `insertCategoria($pdo, $campos)` | Inserta nueva categoría |
| `generarTabla($titulos, $datos)` | Genera tabla HTML dinámica |

---

### 4.2 Archivos de Categoría

#### `listar-categoria.php` -.Listado de Categorías

**Estado:** ✓ Implementado

**Funcionalidad:**
- Muestra todas las categorías existentes en la BD
- Tabla con columnas: nombre
- Enlace para regresar al inicio

#### `ficha-categoria.php` - Ficha de Categoría

**Estado:** ✓ Implementado

**Funcionalidad:**
- Dropdown para seleccionar categoría
- Muestra los datos de la categoría seleccionada
- Campos: nombre, descripción

#### `eliminar-categoria.php` - Eliminar Categoría

**Estado:** ✓ Implementado

**Funcionalidad:**
- Lista todas las categorías con botón de eliminar
- Confirmación antes de borrar
- Advertência: puede dejar contactos sin categoría

#### `guardar-categoria.php` - Guardar Categoría

**Estado:** ✓ Implementado

**Funcionalidad:**
- Formulario con campos: id, nombre, descripción
- Valida que el ID no esté ocupado
- Inserta nueva categoría en la BD

---

### 4.3 Archivos de Persona (NO Implementados)

El ejercicio original indica 4 archivos para persona, pero **NO existen** en el proyecto:

| Archivo Enunciado | Archivo Propuesto | Descripción |
|------------------|-------------------|-------------|
| PersonaListado | `listar-persona.php` | Listado de todos los contactos |
| PersonaEliminar | `eliminar-persona.php` | Eliminar un contacto |
| PersonaFicha | `ficha-persona.php` | Ver/crear contacto |
| PersonaGuardar | `guardar-persona.php` | Guardar contacto (insert/update) |

---

### 4.4 Archivo: `index.php` - Menú Principal

**Estado:** ⚠ Parcial (enlaces duplicados, faltan persona)

**Funcionalidad actual:**
- Botones de navegación a archivos de categoría
- Problema: botones duplicados para categorías
- Faltan: botones para archivos de persona

---

## 5. Funcionalidad Esperada por Entidad

### 5.1 Categorías

| Operación | Archivo | Descripción |
|-----------|---------|-------------|
| CREATE | guardar-categoria.php | Crear nueva categoría |
| READ (list) | listar-categoria.php | Ver todas las categorías |
| READ (one) | ficha-categoria.php | Ver una categoría específica |
| UPDATE | guardar-categoria.php | Modificar categoría |
| DELETE | eliminar-categoria.php | Eliminar categoría |

### 5.2 Personas

| Operación | Archivo Propuesto | Descripción |
|-----------|-------------------|-------------|
| CREATE | guardar-persona.php | Crear nuevo contacto |
| READ (list) | listar-persona.php | Ver todos los contactos |
| READ (one) | ficha-persona.php | Ver un contacto específico |
| UPDATE | guardar-persona.php | Modificar contacto |
| DELETE | eliminar-persona.php | Eliminar contacto |

---

## 6. Estado Actual del Proyecto

### Archivos Existentes

```
agenda/
├── index.php              ⚠ Necesita corrección
├── varios.php            ✓ Completo
├── listar-categoria.php  ✓ Completo
├── ficha-categoria.php    ✓ Completo
├── eliminar-categoria.php ✓ Completo
├── guardar-categoria.php ✓ Completo
├── editar.php            ? (no revisado)
└── requerimientos.md        (este archivo)
```

### Archivos Faltantes (Persona)

- `listar-persona.php`
- `ficha-persona.php`
- `eliminar-persona.php`
- `guardar-persona.php`

---

## 7. Notas de Implementación

### Conexión PDO
Todos los archivos usan:
```php
$conexion = conectarPDO("localhost", "3307", "root", "", "agenda");
```

### Seguridad
- Uso de prepared statements en todas las queries
- Validación de IDs antes de operaciones
- Confirmación en eliminaciones importantes

### UI/UX
- Estilos inline básicos en cada archivo
- Enlaces de navegación "Regresar al inicio"
- Tablas HTML generadas dinámicamente

---

## 8. Pendientes

- [ ] Crear archivos de persona (listar, ficha, guardar, eliminar)
- [ ] Corregir index.php (quitar duplicados, agregar persona)
- [ ] Revisar editar.php (funcionalidad no verificada)
- [ ] Testing de flujos completos CRUD