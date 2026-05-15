<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

require 'conexion.php';
header('Content-Type: application/json');

try {
    if (!$conexion) {
        throw new Exception('Error de conexión a la base de datos');
    }

    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        throw new Exception('ID no válido');
    }

    $id = intval($_POST['id']);
    $sql = "DELETE FROM clientes WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception('Error en la consulta: ' . $conexion->error);
    }

    $stmt->bind_param('i', $id);
    if (!$stmt->execute()) {
        throw new Exception('Error al eliminar cliente: ' . $stmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Cliente eliminado correctamente']);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();
