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
$codigo = isset($_POST['codigo']) ? trim($_POST['codigo']) : '';
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
$precio = isset($_POST['precio']) ? floatval($_POST['precio']) : null;
$iva = isset($_POST['iva']) ? floatval($_POST['iva']) : 0;

// Validaciones
if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID de producto no válido']);
    exit;
}

if (empty($nombre)) {
    echo json_encode(['success' => false, 'message' => 'El nombre del producto es requerido']);
    exit;
}

if ($precio === null || $precio < 0) {
    echo json_encode(['success' => false, 'message' => 'El precio debe ser un número válido']);
    exit;
}

if ($iva < 0 || $iva > 100) {
    echo json_encode(['success' => false, 'message' => 'El IVA debe estar entre 0 y 100']);
    exit;
}

// Preparar y ejecutar la actualización
$sql = "UPDATE productos SET codigo = ?, nombre = ?, descripcion = ?, precio = ?, iva = ? WHERE id = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
    exit;
}

$stmt->bind_param('sssddi', $codigo, $nombre, $descripcion, $precio, $iva, $id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Producto actualizado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se realizaron cambios']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el producto: ' . $stmt->error]);
}

$stmt->close();
