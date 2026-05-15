<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

require 'conexion.php';
header('Content-Type: application/json');

try {
    if (!$conexion) {
        throw new Exception('Error de conexión a la base de datos');
    }

    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
    $ciudad = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '';
    $codigo_postal = isset($_POST['codigo_postal']) ? trim($_POST['codigo_postal']) : '';
    $pais = isset($_POST['pais']) ? trim($_POST['pais']) : '';

    if ($id <= 0 || empty($nombre) || empty($apellidos)) {
        throw new Exception('Faltan datos obligatorios');
    }

    $sql = "UPDATE clientes SET nombre = ?, apellidos = ?, email = ?, telefono = ?, direccion = ?, ciudad = ?, codigo_postal = ?, pais = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception('Error en la consulta: ' . $conexion->error);
    }

    $stmt->bind_param('ssssssssi', $nombre, $apellidos, $email, $telefono, $direccion, $ciudad, $codigo_postal, $pais, $id);

    if (!$stmt->execute()) {
        throw new Exception('Error al actualizar cliente: ' . $stmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Cliente actualizado correctamente']);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();
