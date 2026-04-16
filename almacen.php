<?php 
    require 'back/conexion.php';
    $sql = "SELECT id, id_producto, stock, ubicacion, observaciones, fecha_actualizacion FROM almacen";
    $result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Hub - Almacén</title>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/almacen.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h2>Almacén</h2>
    <?php if ($result->num_rows > 0): ?>
        <div class="tabla-almacen-contenedor">
            <table class="tabla-almacen">
                <tr>
                    <th>ID</th>
                    <th>ID del Producto</th>
                    <th>Stock</th>
                    <th>Ubicación</th>
                    <th>Observaciones</th>
                    <th>Fecha de Actualización</th>
                    <th>Acciones</th>
                </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['id_producto']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td><?php echo $row['ubicacion']; ?></td>
                    <td><?php echo $row['observaciones']; ?></td>
                    <td><?php echo $row['fecha_actualizacion']; ?></td>
                    <td>
                        <button class="editar-btn" onclick="editarAlmacen(<?php echo $row['id']; ?>)"><img src="assets/editar.svg" alt="Editar"></button>
                        <button class="eliminar-btn" onclick="eliminarAlmacen(<?php echo $row['id']; ?>)" onclick="return confirm('¿Eliminar esta columna?')"><img src="assets/eliminar.svg" alt="Eliminar"></button>
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>
    <?php else: ?>
        <p>⚠️EN MANTENIMIENTO⚠️</p>
    <?php endif; ?>
    <?php include 'footer.php'; ?>
</body>
</html>