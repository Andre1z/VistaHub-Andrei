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
                    <div style="display: flex; gap: 10px;">
                        <select id="id_producto" name="id_producto" required style="flex: 1;">
                            <option value="">-- Seleccionar Producto --</option>
                            <?php 
                            // Reiniciar el cursor de resultados
                            $resultProductos->data_seek(0);
                            while ($prod = $resultProductos->fetch_assoc()): ?>
                                <option value="<?php echo $prod['id']; ?>">
                                    <?php echo htmlspecialchars($prod['nombre']); ?> (ID: <?php echo $prod['id']; ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <button type="button" class="btn btn-secondary" onclick="abrirModalCrearProducto()" style="padding: 8px 12px;">+ Crear Producto</button>
                    </div>
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
    
    <!-- Modal para crear nuevo producto -->
    <div id="modalCrearProducto" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Crear Nuevo Producto</h2>
                <span class="close" onclick="cerrarModalCrearProducto()">&times;</span>
            </div>
            <form id="formCrearProducto" onsubmit="crearProducto(event)">
                <input type="hidden" id="codigo" name="codigo">
                
                <div class="form-group">
                    <label for="nombre">Nombre del Producto *</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Ej: Laptop Dell">
                </div>
                
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción del producto..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="precio">Precio *</label>
                    <input type="number" id="precio" name="precio" required min="0" step="0.01" placeholder="0.00">
                </div>
                
                <div class="form-group">
                    <label for="iva">IVA (%) *</label>
                    <input type="number" id="iva" name="iva" required min="0" max="100" step="0.01" value="21" placeholder="21">
                </div>
                
                <div class="button-group">
                    <button type="button" class="btn btn-secondary" onclick="cerrarModalCrearProducto()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
    
    <script src="scr/almacen.js"></script>
</body>
</html>