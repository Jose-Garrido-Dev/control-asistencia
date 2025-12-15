# 📋 Sistema de Control de Asistencia

<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
<a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-11.x-red.svg" alt="Laravel Version"></a>
<a href="https://www.php.net"><img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version"></a>
<a href="https://jetstream.laravel.com"><img src="https://img.shields.io/badge/Jetstream-5.x-purple.svg" alt="Jetstream"></a>
<a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind-3.x-38B2AC.svg" alt="Tailwind CSS"></a>
</p>

## 📖 Descripción

Sistema completo de control de asistencia para empresas, desarrollado con **Laravel 11**, **Jetstream (Livewire)**, **Tailwind CSS** y **Alpine.js**. Permite gestionar empleados, horarios, cargos y registros de asistencia con funcionalidades avanzadas como turnos nocturnos, colación opcional y reportes exportables.

---

## ✨ Características Principales

### 👤 Portal del Empleado
- ✅ Login con RUT del empleado
- ✅ Registro de entrada y salida de jornada
- ✅ Registro opcional de inicio y término de colación
- ✅ Visualización de historial de asistencia personal
- ✅ Interfaz intuitiva con reloj en tiempo real

### 🔐 Panel de Administración
- ✅ Login seguro con autenticación Jetstream
- ✅ Gestión completa de empleados (CRUD)
- ✅ Gestión de horarios con soporte para turnos nocturnos
- ✅ Gestión de cargos/posiciones
- ✅ Control de colación opcional por horario
- ✅ Visualización de asistencias con filtros
- ✅ Exportación de reportes a Excel
- ✅ Dashboard con estadísticas en tiempo real

### 📊 Sistema de Registro
- ✅ Detección automática de atrasos
- ✅ Cálculo automático de horas trabajadas
- ✅ Soporte para turnos nocturnos (ej: 19:00 - 07:00)
- ✅ Validaciones de integridad de registros
- ✅ Estados: A tiempo / Atrasado

---

## 🛠️ Tecnologías Utilizadas

- **Backend:** Laravel 11
- **Autenticación:** Laravel Jetstream + Fortify
- **Frontend:** Livewire, Alpine.js, Tailwind CSS
- **Base de Datos:** MySQL / MariaDB
- **Exportación:** Maatwebsite Excel
- **Iconos:** Font Awesome
- **Idioma:** Español (Laravel Lang)

---

## 📦 Instalación

### Requisitos Previos
- PHP >= 8.2
- Composer
- Node.js y NPM
- MySQL / MariaDB
- Servidor web (Apache / Nginx) o Laravel Valet / Herd

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/Jose-Garrido-Dev/control-asistencia.git
cd control-asistencia
```

2. **Instalar dependencias de PHP**
```bash
composer install
```

3. **Instalar dependencias de Node.js**
```bash
npm install
```

4. **Configurar archivo de entorno**
```bash
cp .env.example .env
```

Editar `.env` y configurar la conexión a la base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=control_asistencia
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

5. **Generar clave de aplicación**
```bash
php artisan key:generate
```

6. **Ejecutar migraciones**
```bash
php artisan migrate
```

7. **Crear enlace simbólico para almacenamiento**
```bash
php artisan storage:link
```

8. **Compilar assets**
```bash
npm run build
# o para desarrollo:
npm run dev
```

9. **Iniciar servidor de desarrollo**
```bash
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

---

## 🚀 Uso del Sistema

### Acceso al Portal del Empleado
1. Ir a: `http://localhost:8000/`
2. Ingresar RUT del empleado
3. Registrar asistencia (Entrada, Salida, Colación)
4. Ver historial en "Reporte Asistencia"

### Acceso al Panel de Administración
1. Ir a: `http://localhost:8000/admin/login`
2. Ingresar credenciales de administrador
3. Gestionar empleados, horarios y asistencias

### Crear Primer Usuario Administrador
```bash
php artisan tinker
```
```php
$user = new App\Models\User();
$user->name = 'Administrador';
$user->email = 'admin@ejemplo.com';
$user->password = bcrypt('password');
$user->save();
```

---

## 📱 Estructura del Sistema

### Módulos Principales

#### 1. **Empleados**
- Registro con RUT único
- Nombre, apellido, dirección, fecha de nacimiento
- Asignación de cargo y horario
- Foto de perfil opcional

#### 2. **Horarios**
- Hora de entrada y salida
- Configuración de colación (habilitada/deshabilitada)
- Soporte para turnos nocturnos

#### 3. **Cargos/Posiciones**
- Nombre del cargo
- Relación con empleados

#### 4. **Asistencias**
- Fecha y hora de entrada
- Fecha y hora de salida
- Inicio y término de colación (opcional)
- Estado (A tiempo / Atrasado)
- Cálculo automático de horas trabajadas

---

## 🎯 Funcionalidades Especiales

### Colación Opcional
Los administradores pueden habilitar o deshabilitar el registro de colación por cada horario:
- **Habilitada:** Empleados deben registrar inicio y término de colación
- **Deshabilitada:** Solo se registra entrada y salida

### Turnos Nocturnos
El sistema detecta automáticamente turnos que cruzan la medianoche:
- Ejemplo: Entrada 19:00, Salida 07:00 = 12 horas trabajadas

### Detección de Atrasos
Compara la hora de entrada real vs. hora programada:
- Llegada antes o a la hora = "A tiempo"
- Llegada después = "Atrasado"

### Exportación de Reportes
Los administradores pueden exportar asistencias a Excel con un clic.

---

## 🔒 Seguridad

- Autenticación robusta con Laravel Fortify
- Middleware personalizado para empleados
- Protección CSRF en todos los formularios
- Validación de datos en backend y frontend
- Separación de permisos (Admin vs. Empleado)

---

## 🗂️ Estructura de Rutas

### Rutas Públicas
- `GET /` - Login empleados
- `POST /employee/login` - Autenticación empleados

### Rutas de Empleados (autenticadas)
- `GET /employee/dashboard` - Dashboard del empleado
- `GET /employee/attendance` - Historial de asistencia
- `POST /employee/store` - Registrar asistencia
- `POST /employee/logout` - Cerrar sesión

### Rutas de Administración (autenticadas)
- `GET /admin/login` - Login administrador
- `GET /dashboard` - Dashboard administrativo
- Resource `/admin/employees` - CRUD Empleados
- Resource `/admin/schedules` - CRUD Horarios
- Resource `/admin/positions` - CRUD Cargos
- Resource `/admin/attendances` - Gestión Asistencias
- `GET /descargar-asistencias` - Exportar a Excel

---

## 📚 Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Ver rutas registradas
php artisan route:list

# Crear nuevo controlador
php artisan make:controller NombreController

# Crear nueva migración
php artisan make:migration nombre_de_migracion

# Refrescar base de datos (¡cuidado en producción!)
php artisan migrate:fresh --seed
```

---

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:
1. Haz fork del proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

---

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver archivo `LICENSE` para más detalles.

---

## 👨‍💻 Autor

**Jose Garrido**
- GitHub: [@Jose-Garrido-Dev](https://github.com/Jose-Garrido-Dev)

---

## 📞 Soporte

Si encuentras algún problema o tienes sugerencias, por favor abre un [issue](https://github.com/Jose-Garrido-Dev/control-asistencia/issues) en GitHub.

---

<p align="center">Hecho con ❤️ usando Laravel 11</p>