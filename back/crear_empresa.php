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

    $cif_nif_nie = isset($_POST['cif_nif_nie']) ? trim($_POST['cif_nif_nie']) : '';
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $domicilio = isset($_POST['domicilio']) ? trim($_POST['domicilio']) : '';
    $municipio = isset($_POST['municipio']) ? trim($_POST['municipio']) : '';
    $codigo_postal = isset($_POST['codigo_postal']) ? trim($_POST['codigo_postal']) : '';
    $pais = isset($_POST['pais']) ? trim($_POST['pais']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';

    if (empty($cif_nif_nie) || empty($nombre) || empty($domicilio) || empty($municipio) || empty($codigo_postal) || empty($pais) || empty($email) || empty($telefono)) {
        throw new Exception('Faltan datos obligatorios');
    }

    $sql = "INSERT INTO empresas (`cif/nif/nie`, nombre, domicilio, municipio, `codigo postal`, pais, email, telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        throw new Exception('Error en la consulta: ' . $conexion->error);
    }

    $stmt->bind_param("sssssssi", $cif_nif_nie, $nombre, $domicilio, $municipio, $codigo_postal, $pais, $email, $telefono);

    if (!$stmt->execute()) {
        throw new Exception('Error al crear empresa: ' . $stmt->error);
    }

    echo json_encode(['success' => true, 'message' => 'Empresa creada correctamente']);
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conexion->close();