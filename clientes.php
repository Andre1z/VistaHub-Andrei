<?php
    require 'back/conexion.php';
    require_once 'i18n.php';
    $sql = "SELECT id, nombre, apellidos, email, telefono, direccion, ciudad, codigo_postal, pais FROM clientes ORDER BY id";
    $result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Hub - Clientes</title>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/clientes.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <?php include 'header.php'; ?>    
    <h2>Clientes</h2>
    <button class="agregar-btn" onclick="abrirModalAgregarCliente()">Agregar cliente</button>
    <?php if ($result && $result->num_rows > 0): ?>
        <div class="tabla-clientes-contenedor">
            <table class="tabla-clientes">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Código postal</th>
                    <th>País</th>
                    <th>Acciones</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellidos']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($row['ciudad']); ?></td>
                        <td><?php echo htmlspecialchars($row['codigo_postal']); ?></td>
                        <td><?php echo htmlspecialchars($row['pais']); ?></td>
                        <td>
                            <button class="editar-btn" onclick="abrirModalEditarCliente(<?php echo $row['id']; ?>)"><img src="assets/editar.svg" alt="Editar"></button>
                            <button class="eliminar-btn" onclick="return confirm('¿Eliminar este cliente?') && eliminarCliente(<?php echo $row['id']; ?>)"><img src="assets/eliminar.svg" alt="Eliminar"></button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    <?php else: ?>
        <p>No hay registros de clientes disponibles.</p>
    <?php endif; ?>
    <?php include 'modal_clientes.php'; ?>
    <?php include 'footer.php'; ?>
    <script src="scr/clientes.js"></script>
</body>
</html>