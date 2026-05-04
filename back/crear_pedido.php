<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

require 'conexion.php';

header('Content-Type: application/json');

try {
    // Verificar si la conexión fue exitosa
    if (!$conexion) {
        throw new Exception('Error de conexión a la base de datos');
    }

    $id_empresa = isset($_POST['id_empresa']) ? trim($_POST['id_empresa']) : '';
    $fecha_pedido = isset($_POST['fecha_pedido']) ? trim($_POST['fecha_pedido']) : '';
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';
    $total_bruto = isset($_POST['total_bruto']) ? trim($_POST['total_bruto']) : '';
    $total_iva = isset($_POST['total_iva']) ? trim($_POST['total_iva']) : '';
    $total_neto = isset($_POST['total_neto']) ? trim($_POST['total_neto']) : '';
    $metodo_pago = isset($_POST['metodo_pago']) ? trim($_POST['metodo_pago']) : '';
    $observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : '';

    if (empty($id_empresa) || empty($fecha_pedido) || empty($estado) || empty($total_bruto) || empty($total_iva) || empty($total_neto)) {
        throw new Exception('Faltan datos obligatorios');
    }

    $sql = "INSERT INTO pedidos (id_empresa, fecha_pedido, estado, total_bruto, total_iva, total_neto, metodo_pago, observaciones, fecha_creacion, fecha_actualizacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        throw new Exception('Error en la consulta: ' . $conexion->error);
    }

    $stmt->bind_param("issdddss", $id_empresa, $fecha_pedido, $estado, $total_bruto, $total_iva, $total_neto, $metodo_pago, $observaciones);

    if (!$stmt->execute()) {
        throw new Exception('Error al crear pedido: ' . $stmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Pedido creado correctamente']);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();