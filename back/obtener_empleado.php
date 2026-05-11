<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

require 'conexion.php';
header('Content-Type: application/json');

try {
    if (!$conexion) {
        throw new Exception('Error de conexión a la base de datos');
    }

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new Exception('ID no válido');
    }

    $id = intval($_GET['id']);
    $sql = "SELECT id, id_empresa, nombre, apellidos, dni, telefono, email, puesto, departamento, salario, fecha_contratacion, estado, direccion, ciudad, codigo_postal FROM empleados WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception('Error en la consulta: ' . $conexion->error);
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        throw new Exception('Empleado no encontrado');
    }

    $empleado = $result->fetch_assoc();
    echo json_encode(['success' => true, 'empleado' => $empleado]);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();
