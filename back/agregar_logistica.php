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

    $id_pedido = isset($_POST['id_pedido']) ? trim($_POST['id_pedido']) : '';
    $id_empresa = isset($_POST['id_empresa']) ? trim($_POST['id_empresa']) : '';
    $fecha_salida = isset($_POST['fecha_salida']) ? trim($_POST['fecha_salida']) : '';
    $fecha_entrega_prevista = isset($_POST['fecha_entrega_prevista']) ? trim($_POST['fecha_entrega_prevista']) : '';
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';
    $origen = isset($_POST['origen']) ? trim($_POST['origen']) : '';
    $destino = isset($_POST['destino']) ? trim($_POST['destino']) : '';
    $observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : '';
    $incidencias = isset($_POST['incidencias']) ? trim($_POST['incidencias']) : '';

    if (empty($id_pedido) || empty($id_empresa) || empty($fecha_salida) || empty($fecha_entrega_prevista) || empty($estado)) {
        throw new Exception('Faltan datos obligatorios');
    }

    // Obtener el nombre de la empresa desde la base de datos
    $sqlEmpresa = "SELECT nombre FROM empresas WHERE id = ?";
    $stmtEmpresa = $conexion->prepare($sqlEmpresa);
    if (!$stmtEmpresa) {
        throw new Exception('Error en la consulta de empresa: ' . $conexion->error);
    }
    $stmtEmpresa->bind_param("i", $id_empresa);
    $stmtEmpresa->execute();
    $resultEmpresa = $stmtEmpresa->get_result();
    if ($resultEmpresa->num_rows == 0) {
        throw new Exception('Empresa no encontrada');
    }
    $empresa = $resultEmpresa->fetch_assoc();
    $nombre_empresa = $empresa['nombre'];
    $stmtEmpresa->close();

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

    $numero_seguimiento = 'NS' . str_pad($nuevoNumero, 9, '0', STR_PAD_LEFT);

    $sql = "INSERT INTO logistica (id_pedido, id_empresa, nombre_empresa, fecha_salida, fecha_entrega_prevista, estado, numero_seguimiento, origen, destino, observaciones, incidencias) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        throw new Exception('Error en la consulta: ' . $conexion->error);
    }

    $stmt->bind_param("iisssssssss", $id_pedido, $id_empresa, $nombre_empresa, $fecha_salida, $fecha_entrega_prevista, $estado, $numero_seguimiento, $origen, $destino, $observaciones, $incidencias);

    if (!$stmt->execute()) {
        throw new Exception('Error al agregar: ' . $stmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Registro agregado correctamente']);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();