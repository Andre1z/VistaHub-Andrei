<?php
require 'conexion.php';

header('Content-Type: application/json');

$id_pedido = $_POST['id_pedido'] ?? '';
$id_empresa = $_POST['id_empresa'] ?? '';
$nombre_empresa = $_POST['nombre_empresa'] ?? '';
$fecha_salida = $_POST['fecha_salida'] ?? '';
$fecha_entrega_prevista = $_POST['fecha_entrega_prevista'] ?? '';
$estado = $_POST['estado'] ?? '';
$origen = $_POST['origen'] ?? '';
$destino = $_POST['destino'] ?? '';
$observaciones = $_POST['observaciones'] ?? '';
$incidencias = $_POST['incidencias'] ?? '';

if (empty($id_pedido) || empty($id_empresa) || empty($nombre_empresa) || empty($fecha_salida) || empty($fecha_entrega_prevista) || empty($estado)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
    exit;
}

// Generar número de seguimiento automáticamente
$sqlMaxNumero = "SELECT numero_seguimiento FROM logistica ORDER BY id DESC LIMIT 1";
$resultMaxNumero = $conexion->query($sqlMaxNumero);

if ($resultMaxNumero && $resultMaxNumero->num_rows > 0) {
    $row = $resultMaxNumero->fetch_assoc();
    $lastNumero = $row['numero_seguimiento'];
    // Extraer el número del formato NS00000000X
    $numeroExtraido = (int)substr($lastNumero, 2);
    $nuevoNumero = $numeroExtraido + 1;
} else {
    $nuevoNumero = 1;
}

$numero_seguimiento = 'NS' . str_pad($nuevoNumero, 8, '0', STR_PAD_LEFT);

$sql = "INSERT INTO logistica (id_pedido, id_empresa, nombre_empresa, fecha_salida, fecha_entrega_prevista, estado, numero_seguimiento, origen, destino, observaciones, incidencias) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iisssssssss", $id_pedido, $id_empresa, $nombre_empresa, $fecha_salida, $fecha_entrega_prevista, $estado, $numero_seguimiento, $origen, $destino, $observaciones, $incidencias);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Registro agregado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al agregar: ' . $conexion->error]);
}

$stmt->close();
$conexion->close();