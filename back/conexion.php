<?php
// Configuración de la base de datos
$host = 'localhost'; // Cambia si es necesario
$usuario = 'prueba'; // Usuario de la base de datos
$contraseña = 'prueba123'; // Contraseña de la base de datos (vacía por defecto en XAMPP)
$base_datos = 'prueba'; // Nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($host, $usuario, $contraseña, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Opcional: Establecer charset
$conexion->set_charset("utf8");

// Aquí puedes agregar consultas o funciones relacionadas con la base de datos

// Cerrar conexión al final del script (opcional, PHP lo hace automáticamente)
// $conexion->close();
?>