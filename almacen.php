<?php 
    require_once 'i18n.php';
    require 'back/conexion.php';
    $sql = "SELECT id, id_producto, stock, ubicacion, observaciones, fecha_actualizacion FROM almacen";
    $result = $conexion->query($sql);
    
    // Obtener lista de productos para el formulario
    $sqlProductos = "SELECT id, nombre FROM productos ORDER BY nombre";
    $resultProductos = $conexion->query($sqlProductos);
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($GLOBALS['idiomaActivo'], ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo __('warehouse_page_title'); ?></title>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/almacen.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h2><?php echo __('warehouse'); ?></h2>
    
    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] === 'success'): ?>
            <div class="alert alert-success">
                Producto agregado al almacén exitosamente.
            </div>
        <?php elseif ($_GET['status'] === 'error'): ?>
            <div class="alert alert-error">
                Error al agregar el producto: <?php echo htmlspecialchars($_GET['message'] ?? 'Error desconocido'); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    
    <button class="agregar-btn" onclick="abrirModalAgregar()">+ Agregar Nuevo Registro</button>
    <?php if ($result->num_rows > 0): ?>
        <div class="tabla-almacen-contenedor">
            <table class="tabla-almacen">
                <tr>
                    <th><?php echo __('warehouse_id'); ?></th>
                    <th><?php echo __('warehouse_product_id'); ?></th>
                    <th><?php echo __('stock'); ?></th>
                    <th><?php echo __('warehouse_location'); ?></th>
                    <th><?php echo __('observations'); ?></th>
                    <th><?php echo __('last_updated'); ?></th>
                    <th><?php echo __('actions'); ?></th>
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
                        <button class="editar-btn" onclick="abrirModalEditarAlmacen(<?php echo $row['id']; ?>)"><img src="assets/editar.svg" alt="<?php echo __('edit'); ?>"></button>
                        <button class="eliminar-btn" onclick="return confirm('<?php echo __('warehouse_delete_confirm'); ?>') && eliminarAlmacen(<?php echo $row['id']; ?>)"><img src="assets/eliminar.svg" alt="<?php echo __('delete'); ?>"></button>
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>
    <?php else: ?>
        <p><?php echo __('warehouse_maintenance_notice'); ?></p>
    <?php endif; ?>
    
    <?php include 'modal_almacen.php'; ?>
    
    <?php include 'footer.php'; ?>
    
    <script src="scr/almacen.js"></script>
</body>
</html>