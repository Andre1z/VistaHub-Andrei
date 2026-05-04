<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

require 'conexion.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception('ID no proporcionado');
    }

    $id = intval($_GET['id']);

    $sql = "SELECT id, id_pedido, id_empresa, nombre_empresa, fecha_salida, fecha_entrega_prevista, estado, numero_seguimiento, origen, destino, observaciones, incidencias FROM logistica WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception('Error en la consulta: ' . $conexion->error);
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        throw new Exception('Error al ejecutar consulta: ' . $stmt->error);
    }
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Formatear fechas para asegurar formato YYYY-MM-DD
        $row['fecha_salida'] = date('Y-m-d', strtotime($row['fecha_salida']));
        $row['fecha_entrega_prevista'] = date('Y-m-d', strtotime($row['fecha_entrega_prevista']));
        echo json_encode(['success' => true, 'logistica' => $row]);
    } else {
        throw new Exception('Registro no encontrado');
    }

    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();