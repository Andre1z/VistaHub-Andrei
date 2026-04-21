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
    <link rel="stylesheet" type="text/css" href="css/modal.css">
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
                        <button class="editar-btn" onclick="editarAlmacen(<?php echo $row['id']; ?>)"><img src="assets/editar.svg" alt="<?php echo __('edit'); ?>"></button>
                        <button class="eliminar-btn" onclick="return confirm('<?php echo __('warehouse_delete_confirm'); ?>') && eliminarAlmacen(<?php echo $row['id']; ?>)"><img src="assets/eliminar.svg" alt="<?php echo __('delete'); ?>"></button>
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>
    <?php else: ?>
        <p><?php echo __('warehouse_maintenance_notice'); ?></p>
    <?php endif; ?>
    
    <!-- Modal para agregar registro -->
    <div id="modalAgregar" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Agregar Nuevo Registro al Almacén</h2>
                <span class="close" onclick="cerrarModalAgregar()">&times;</span>
            </div>
            <form id="formAgregar" onsubmit="insertarAlmacen(event)">
                <div class="form-group">
                    <label for="id_producto">Producto *</label>
                    <select id="id_producto" name="id_producto" required>
                        <option value="">-- Seleccionar Producto --</option>
                        <?php while ($prod = $resultProductos->fetch_assoc()): ?>
                            <option value="<?php echo $prod['id']; ?>">
                                <?php echo htmlspecialchars($prod['nombre']); ?> (ID: <?php echo $prod['id']; ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="stock">Stock *</label>
                    <input type="number" id="stock" name="stock" required min="0" step="1">
                </div>
                
                <div class="form-group">
                    <label for="ubicacion">Ubicación *</label>
                    <input type="text" id="ubicacion" name="ubicacion" required placeholder="Ej: Pasillo A, Estante 3">
                </div>
                
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea id="observaciones" name="observaciones" placeholder="Notas adicionales..."></textarea>
                </div>
                
                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="cerrarModalAgregar()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Registro</button>
                </div>
            </form>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
    
    <script>
        function abrirModalAgregar() {
            document.getElementById('modalAgregar').style.display = 'block';
        }
        
        function cerrarModalAgregar() {
            document.getElementById('modalAgregar').style.display = 'none';
            document.getElementById('formAgregar').reset();
        }
        
        function insertarAlmacen(event) {
            event.preventDefault();
            
            const formData = new FormData(document.getElementById('formAgregar'));
            
            fetch('back/agregar_almacen.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cerrarModalAgregar();
                    window.location.href = 'almacen.php?status=success';
                } else {
                    window.location.href = 'almacen.php?status=error&message=' + encodeURIComponent(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                window.location.href = 'almacen.php?status=error&message=Error en la comunicación con el servidor';
            });
        }
        
        window.onclick = function(event) {
            const modal = document.getElementById('modalAgregar');
            if (event.target == modal) {
                cerrarModalAgregar();
            }
        }
    </script>
</body>
</html>