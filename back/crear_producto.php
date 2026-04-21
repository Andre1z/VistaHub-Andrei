<?php
require 'conexion.php';

// Header para respuesta JSON
header('Content-Type: application/json');

// Validar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Manejar peticiones GET para obtener el próximo código
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener el máximo ID actual de la tabla productos
    $sqlMaxId = "SELECT MAX(id) as max_id FROM productos";
    $resultMaxId = $conexion->query($sqlMaxId);
    $rowMaxId = $resultMaxId->fetch_assoc();
    
    // El próximo ID será el máximo + 1
    $proximoId = ($rowMaxId['max_id'] !== null ? $rowMaxId['max_id'] : 0) + 1;
    
    // Generar código con formato 00000000X
    $codigoProximo = str_pad($proximoId, 8, '0', STR_PAD_LEFT) . 'X';
    
    echo json_encode([
        'success' => true,
        'codigo' => $codigoProximo,
        'proximoId' => $proximoId
    ]);
    exit;
}

// Obtener y validar datos
$codigo = isset($_POST['codigo']) ? trim($_POST['codigo']) : '';
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
$precio = isset($_POST['precio']) ? floatval($_POST['precio']) : null;
$iva = isset($_POST['iva']) ? floatval($_POST['iva']) : 0;

// Si no viene código, generar uno automáticamente
if (empty($codigo)) {
    // Obtener el máximo ID actual de la tabla productos
    $sqlMaxId = "SELECT MAX(id) as max_id FROM productos";
    $resultMaxId = $conexion->query($sqlMaxId);
    $rowMaxId = $resultMaxId->fetch_assoc();
    
    // El próximo ID será el máximo + 1
    $proximoId = ($rowMaxId['max_id'] !== null ? $rowMaxId['max_id'] : 0) + 1;
    
    // Generar código con formato 00000000X
    $codigo = str_pad($proximoId, 8, '0', STR_PAD_LEFT) . 'X';
}

// Validaciones
if (empty($nombre)) {
    echo json_encode(['success' => false, 'message' => 'El nombre del producto es requerido']);
    exit;
}

if ($precio === null || $precio < 0) {
    echo json_encode(['success' => false, 'message' => 'El precio debe ser un número válido y no negativo']);
    exit;
}

if ($iva < 0 || $iva > 100) {
    echo json_encode(['success' => false, 'message' => 'El IVA debe estar entre 0 y 100']);
    exit;
}

// Insertar nuevo producto
$sqlInsertar = "INSERT INTO productos (codigo, nombre, descripcion, precio, iva) VALUES (?, ?, ?, ?, ?)";
$stmtInsertar = $conexion->prepare($sqlInsertar);

if (!$stmtInsertar) {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la inserción: ' . $conexion->error]);
    exit;
}

$stmtInsertar->bind_param('sssdd', $codigo, $nombre, $descripcion, $precio, $iva);

if ($stmtInsertar->execute()) {
    $nuevoId = $stmtInsertar->insert_id;
    echo json_encode([
        'success' => true, 
        'message' => 'Producto creado exitosamente',
        'id' => $nuevoId,
        'nombre' => $nombre,
        'codigo' => $codigo
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al insertar el producto: ' . $stmtInsertar->error]);
}

$stmtInsertar->close();
$conexion->close();
?>
