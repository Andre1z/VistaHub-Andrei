<?php
require 'conexion.php';

header('Content-Type: application/json');

$id_empresa = $_POST['id_empresa'] ?? '';
$fecha_pedido = $_POST['fecha_pedido'] ?? '';
$estado = $_POST['estado'] ?? '';
$total_bruto = $_POST['total_bruto'] ?? '';
$total_iva = $_POST['total_iva'] ?? '';
$total_neto = $_POST['total_neto'] ?? '';
$metodo_pago = $_POST['metodo_pago'] ?? '';
$observaciones = $_POST['observaciones'] ?? '';

if (empty($id_empresa) || empty($fecha_pedido) || empty($estado) || empty($total_bruto) || empty($total_iva) || empty($total_neto)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
    exit;
}

$sql = "INSERT INTO pedidos (id_empresa, fecha_pedido, estado, total_bruto, total_iva, total_neto, metodo_pago, observaciones, fecha_creacion, fecha_actualizacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("issdddss", $id_empresa, $fecha_pedido, $estado, $total_bruto, $total_iva, $total_neto, $metodo_pago, $observaciones);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Pedido creado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al crear pedido: ' . $conexion->error]);
}

$stmt->close();
$conexion->close();