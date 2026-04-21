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
$id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : null;
$stock = isset($_POST['stock']) ? intval($_POST['stock']) : null;
$ubicacion = isset($_POST['ubicacion']) ? trim($_POST['ubicacion']) : '';
$observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : '';

// Validaciones
if (!$id_producto) {
    echo json_encode(['success' => false, 'message' => 'El producto es requerido']);
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

// Validar que el producto exista
$sqlVerificar = "SELECT id FROM productos WHERE id = ?";
$stmt = $conexion->prepare($sqlVerificar);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta: ' . $conexion->error]);
    exit;
}

$stmt->bind_param('i', $id_producto);
$stmt->execute();
$resultVerificar = $stmt->get_result();

if ($resultVerificar->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'El producto seleccionado no existe en la base de datos']);
    exit;
}

$stmt->close();

// Validar que no exista un registro duplicado para el mismo producto en la misma ubicación
$sqlDuplicado = "SELECT id FROM almacen WHERE id_producto = ? AND ubicacion = ?";
$stmtDuplicado = $conexion->prepare($sqlDuplicado);

if (!$stmtDuplicado) {
    echo json_encode(['success' => false, 'message' => 'Error en la validación: ' . $conexion->error]);
    exit;
}

$stmtDuplicado->bind_param('is', $id_producto, $ubicacion);
$stmtDuplicado->execute();
$resultDuplicado = $stmtDuplicado->get_result();

if ($resultDuplicado->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Ya existe un registro para este producto en la ubicación especificada']);
    exit;
}

$stmtDuplicado->close();

// Insertar en la tabla almacen
$sqlInsertar = "INSERT INTO almacen (id_producto, stock, ubicacion, observaciones, fecha_actualizacion) 
                VALUES (?, ?, ?, ?, NOW())";

$stmtInsertar = $conexion->prepare($sqlInsertar);

if (!$stmtInsertar) {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la inserción: ' . $conexion->error]);
    exit;
}

$stmtInsertar->bind_param('iiss', $id_producto, $stock, $ubicacion, $observaciones);

if ($stmtInsertar->execute()) {
    $nuevoId = $stmtInsertar->insert_id;
    echo json_encode([
        'success' => true, 
        'message' => 'Registro agregado exitosamente',
        'id' => $nuevoId
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al insertar el registro: ' . $stmtInsertar->error]);
}

$stmtInsertar->close();
$conexion->close();
?>
