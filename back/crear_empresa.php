<?php
require 'conexion.php';

header('Content-Type: application/json');

$cif_nif_nie = $_POST['cif_nif_nie'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$domicilio = $_POST['domicilio'] ?? '';
$municipio = $_POST['municipio'] ?? '';
$codigo_postal = $_POST['codigo_postal'] ?? '';
$pais = $_POST['pais'] ?? '';
$email = $_POST['email'] ?? '';
$telefono = $_POST['telefono'] ?? '';

if (empty($cif_nif_nie) || empty($nombre) || empty($domicilio) || empty($municipio) || empty($codigo_postal) || empty($pais) || empty($email) || empty($telefono)) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
    exit;
}

$sql = "INSERT INTO empresas (cif_nif_nie, nombre, domicilio, municipio, codigo_postal, pais, email, telefono) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssssssi", $cif_nif_nie, $nombre, $domicilio, $municipio, $codigo_postal, $pais, $email, $telefono);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Empresa creada correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al crear empresa: ' . $conexion->error]);
}

$stmt->close();
$conexion->close();