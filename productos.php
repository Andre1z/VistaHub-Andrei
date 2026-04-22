<?php 
    require_once 'i18n.php';
    require 'back/conexion.php';
    $sql = "SELECT id, codigo, nombre, descripcion, precio, iva FROM productos";
    $result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Hub - Productos</title>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/productos.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <?php include 'header.php'; ?>    
    <h2>Productos</h2>
    <button class="btn btn-primary" onclick="abrirModalAgregarProducto()" style="margin-bottom: 20px;">+ Agregar Producto</button>
    <?php if ($result->num_rows > 0): ?>
        <div class="tabla-productos-contenedor">
            <table class="tabla-productos">
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>IVA</th>
                        <th>Acciones</th>
                    </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['codigo']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['precio']; ?>€</td>
                        <td><?php echo $row['iva']; ?>%</td>
                        <td>
                            <button class="editar-btn" onclick="abrirModalEditarProducto(<?php echo $row['id']; ?>)"><img src="assets/editar.svg" alt="<?php echo __('edit'); ?>"></button>
                            <button class="eliminar-btn" onclick="return confirm('<?php echo __('delete_confirm'); ?>') && eliminarProducto(<?php echo $row['id']; ?>)"><img src="assets/eliminar.svg" alt="<?php echo __('delete'); ?>"></button>
                        </td>
                    </tr>
            <?php endwhile; ?>
            </table>
        </div>
    <?php else: ?>
        <p>⚠️EN MANTENIMIENTO⚠️</p>
    <?php endif; ?>
    <?php include 'modal_productos.php'; ?>
    <?php include 'footer.php'; ?>
    <script src="scr/productos.js"></script>
</body>
</html>