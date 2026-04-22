<?php
require 'conexion.php';

// Header para respuesta JSON
header('Content-Type: application/json');

// Validar método GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Validar ID
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID de almacén no válido']);
    exit;
}

// Obtener datos del almacén
$sql = "SELECT id, id_producto, stock, ubicacion, observaciones FROM almacen WHERE id = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
    exit;
}

$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Registro no encontrado']);
    exit;
}

$almacen = $result->fetch_assoc();

echo json_encode([
    'success' => true,
    'almacen' => $almacen
]);

$stmt->close();
