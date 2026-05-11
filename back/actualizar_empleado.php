<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

require 'conexion.php';
header('Content-Type: application/json');

try {
    if (!$conexion) {
        throw new Exception('Error de conexión a la base de datos');
    }

    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $id_empresa = isset($_POST['id_empresa']) ? trim($_POST['id_empresa']) : '';
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
    $dni = isset($_POST['dni']) ? trim($_POST['dni']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $puesto = isset($_POST['puesto']) ? trim($_POST['puesto']) : '';
    $departamento = isset($_POST['departamento']) ? trim($_POST['departamento']) : '';
    $salario = isset($_POST['salario']) ? trim($_POST['salario']) : '';
    $fecha_contratacion = isset($_POST['fecha_contratacion']) ? trim($_POST['fecha_contratacion']) : '';
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';
    $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
    $ciudad = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '';
    $codigo_postal = isset($_POST['codigo_postal']) ? trim($_POST['codigo_postal']) : '';

    if ($id <= 0 || empty($id_empresa) || empty($nombre) || empty($apellidos) || empty($estado)) {
        throw new Exception('Faltan datos obligatorios');
    }

    $salario = $salario === '' ? null : floatval($salario);
    $fecha_contratacion = $fecha_contratacion === '' ? null : $fecha_contratacion;

    $sql = "UPDATE empleados SET id_empresa = ?, nombre = ?, apellidos = ?, dni = ?, telefono = ?, email = ?, puesto = ?, departamento = ?, salario = ?, fecha_contratacion = ?, estado = ?, direccion = ?, ciudad = ?, codigo_postal = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception('Error en la consulta: ' . $conexion->error);
    }

    $stmt->bind_param(
        'isssssssdsssssi',
        $id_empresa,
        $nombre,
        $apellidos,
        $dni,
        $telefono,
        $email,
        $puesto,
        $departamento,
        $salario,
        $fecha_contratacion,
        $estado,
        $direccion,
        $ciudad,
        $codigo_postal,
        $id
    );

    if (!$stmt->execute()) {
        throw new Exception('Error al actualizar empleado: ' . $stmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Empleado actualizado correctamente']);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();
