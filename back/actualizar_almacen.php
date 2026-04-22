<?php
require 'conexion.php';

// Header para respuesta JSON
header('Content-Type: application/json');

// Validar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Obtener y validar datos
$id = isset($_POST['id']) ? intval($_POST['id']) : null;
$id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : null;
$stock = isset($_POST['stock']) ? intval($_POST['stock']) : null;
$ubicacion = isset($_POST['ubicacion']) ? trim($_POST['ubicacion']) : '';
$observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : '';

// Validaciones
if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID de almacén no válido']);
    exit;
}

if (!$id_producto) {
    echo json_encode(['success' => false, 'message' => 'ID de producto no válido']);
    exit;
}

if ($stock === null || $stock < 0) {
    echo json_encode(['success' => false, 'message' => 'El stock debe ser un número válido y no negativo']);
    exit;
}

if (empty($ubicacion)) {
    echo json_encode(['success' => false, 'message' => 'La ubicación es requerida']);
    exit;
}

// Preparar y ejecutar la actualización
$sql = "UPDATE almacen SET id_producto = ?, stock = ?, ubicacion = ?, observaciones = ?, fecha_actualizacion = NOW() WHERE id = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
    exit;
}

$stmt->bind_param('iissi', $id_producto, $stock, $ubicacion, $observaciones, $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Registro actualizado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se realizaron cambios']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el registro: ' . $stmt->error]);
}

$stmt->close();
