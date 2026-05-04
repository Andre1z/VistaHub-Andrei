<?php
require 'conexion.php';

header('Content-Type: application/json');

$id_pedido = $_POST['id_pedido'] ?? '';
$id_empresa = $_POST['id_empresa'] ?? '';
$nombre_empresa = $_POST['nombre_empresa'] ?? '';
$fecha_salida = $_POST['fecha_salida'] ?? '';
$fecha_entrega_prevista = $_POST['fecha_entrega_prevista'] ?? '';
$estado = $_POST['estado'] ?? '';
$numero_seguimiento = $_POST['numero_seguimiento'] ?? '';
$origen = $_POST['origen'] ?? '';
$destino = $_POST['destino'] ?? '';
$observaciones = $_POST['observaciones'] ?? '';
$incidencias = $_POST['incidencias'] ?? '';

if (empty($id_pedido) || empty($id_empresa) || empty($nombre_empresa) || empty($fecha_salida) || empty($fecha_entrega_prevista) || empty($estado)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
    exit;
}

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