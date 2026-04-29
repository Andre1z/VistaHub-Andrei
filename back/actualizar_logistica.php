<?php
require 'conexion.php';

header('Content-Type: application/json');

if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
    exit;
}

$id = intval($_POST['id']);
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

$sql = "UPDATE logistica SET id_pedido = ?, id_empresa = ?, nombre_empresa = ?, fecha_salida = ?, fecha_entrega_prevista = ?, estado = ?, numero_seguimiento = ?, origen = ?, destino = ?, observaciones = ?, incidencias = ? WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sisssssssssi", $id_pedido, $id_empresa, $nombre_empresa, $fecha_salida, $fecha_entrega_prevista, $estado, $numero_seguimiento, $origen, $destino, $observaciones, $incidencias, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Registro actualizado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar: ' . $conexion->error]);
}

$stmt->close();
$conexion->close();