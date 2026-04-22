<?php
require 'conexion.php';

// Header para respuesta JSON
header('Content-Type: application/json');

// Validar método GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Obtener el máximo ID actual de la tabla productos
$sqlMaxId = "SELECT MAX(id) as max_id FROM productos";
$resultMaxId = $conexion->query($sqlMaxId);

if (!$resultMaxId) {
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos']);
    exit;
}

$rowMaxId = $resultMaxId->fetch_assoc();

// El próximo ID será el máximo + 1
$proximoId = ($rowMaxId['max_id'] !== null ? $rowMaxId['max_id'] : 0) + 1;

// Generar código con formato P-0000001 (9 caracteres totales)
$codigoProximo = 'P-' . str_pad($proximoId, 7, '0', STR_PAD_LEFT);

echo json_encode([
    'success' => true,
    'codigo' => $codigoProximo,
    'proximoId' => $proximoId
]);
