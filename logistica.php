<?php 
    require 'back/conexion.php';
    require_once 'i18n.php';
    $sql = "SELECT id, id_pedido, id_empresa, nombre_empresa, fecha_salida, fecha_entrega_prevista, estado, numero_seguimiento, origen, destino, observaciones, incidencias FROM logistica";
    $result = $conexion->query($sql);
    
    // Obtener lista de empresas para el formulario
    $sqlEmpresas = "SELECT id, nombre FROM empresas ORDER BY nombre";
    $resultEmpresas = $conexion->query($sqlEmpresas);
    
    // Obtener lista de pedidos para el formulario
    $sqlPedidos = "SELECT id, fecha_pedido, estado FROM pedidos ORDER BY id";
    $resultPedidos = $conexion->query($sqlPedidos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Hub - Logística</title>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/logistica.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <?php include 'header.php'; ?>
    <h2>Logística</h2>
    <?php if ($result->num_rows > 0): ?>
        <div class="tabla-logistica-contenedor">
            <table class="tabla-logistica">
                    <tr>
                        <th>id</th>
                        <th>id del pedido</th>
                        <th>id Empresa</th>
                        <th>Empresa</th>
                        <th>Salida</th>
                        <th>Entrega prevista</th>
                        <th>estado</th>
                        <th>nº seguimiento</th>
                        <th>origen</th>
                        <th>destino</th>
                        <th>observaciones</th>
                        <th>incidencias</th>
                        <th><?php echo __('actions'); ?></th>
                    </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['id_pedido']; ?></td>
                        <td><?php echo $row['id_empresa']; ?></td>
                        <td><?php echo $row['nombre_empresa']; ?></td>
                        <td><?php echo $row['fecha_salida']; ?></td>
                        <td><?php echo $row['fecha_entrega_prevista']; ?></td>
                        <td><?php echo $row['estado']; ?></td>
                        <td><?php echo $row['numero_seguimiento']; ?></td>
                        <td><?php echo $row['origen']; ?></td>
                        <td><?php echo $row['destino']; ?></td>
                        <td><?php echo $row['observaciones']; ?></td>
                        <td><?php echo $row['incidencias']; ?></td>
                        <td>
                            <button class="editar-btn" onclick="abrirModalEditarLogistica(<?php echo $row['id']; ?>)"><img src="assets/editar.svg" alt="<?php echo __('edit'); ?>"></button>
                            <button class="eliminar-btn" onclick="return confirm('<?php echo __('delete_confirm'); ?>') && eliminarLogistica(<?php echo $row['id']; ?>)"><img src="assets/eliminar.svg" alt="<?php echo __('delete'); ?>"></button>
                        </td>
                    </tr>
            <?php endwhile; ?>
            </table>
        </div>
    <?php else: ?>
        <p><?php echo __('maintenance_message'); ?></p>
    <?php endif; ?>
    
    <?php include 'modal_logistica.php'; ?>
    
    <?php include 'footer.php'; ?>
    
    <script src="scr/logistica.js"></script>
</body>
</html>