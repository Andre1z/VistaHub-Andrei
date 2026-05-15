<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

require 'conexion.php';
header('Content-Type: application/json');

try {
    if (!$conexion) {
        throw new Exception('Error de conexión a la base de datos');
    }

    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
    $ciudad = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '';
    $codigo_postal = isset($_POST['codigo_postal']) ? trim($_POST['codigo_postal']) : '';
    $pais = isset($_POST['pais']) ? trim($_POST['pais']) : '';

    if (empty($nombre) || empty($apellidos)) {
        throw new Exception('Faltan datos obligatorios');
    }

    $sql = "INSERT INTO clientes (nombre, apellidos, email, telefono, direccion, ciudad, codigo_postal, pais) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception('Error en la consulta: ' . $conexion->error);
    }

    $stmt->bind_param('ssssssss', $nombre, $apellidos, $email, $telefono, $direccion, $ciudad, $codigo_postal, $pais);

    if (!$stmt->execute()) {
        throw new Exception('Error al agregar cliente: ' . $stmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Cliente agregado correctamente']);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();
