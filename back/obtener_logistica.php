<?php
require 'conexion.php';

header('Content-Type: application/json');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
    exit;
}

$id = intval($_GET['id']);

$sql = "SELECT id, id_pedido, id_empresa, nombre_empresa, fecha_salida, fecha_entrega_prevista, estado, numero_seguimiento, origen, destino, observaciones, incidencias FROM logistica WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(['success' => true, 'logistica' => $row]);
} else {
    echo json_encode(['success' => false, 'message' => 'Registro no encontrado']);
}

$stmt->close();
$conexion->close();