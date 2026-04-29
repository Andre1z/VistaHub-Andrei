<?php
require 'conexion.php';

header('Content-Type: application/json');

if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
    exit;
}

$id = intval($_POST['id']);

$sql = "DELETE FROM logistica WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Registro eliminado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar: ' . $conexion->error]);
}

$stmt->close();
$conexion->close();