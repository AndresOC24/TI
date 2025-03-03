# Sistema de control de asistencia para el área de TI

### Paso 1
Ejecutar el comando de:
`git clone https://github.com/AndresOC24/Sistema_TI.git`

### Paso 2
Luego ejecutar el comando de:
`composer install`

### Paso 3
Luego configurar el archivo `env`, debes de agregar lo siguiente si quieres que salga en hora boliviana, `APP_TIMEZONE=America/La_Paz`.

### Paso 4
Luego debes de generar su key con el comando:
`php artisan key:generate`

### Paso 5
Luego puedes ejecutar tus migraciones y los seeders, con el comando:
`php artisan migrate:fresh --seed`

Los usuario por defecto que viene son:
Correo: `mflores@unifranz.edu.bo`
Password: `admin`
