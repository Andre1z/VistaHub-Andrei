<?php require_once 'i18n.php'; ?>
<link rel="stylesheet" href="css/modal.css">
<!-- Modal para agregar registro -->
<div id="modalAgregar" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo __('add_new_warehouse_entry'); ?></h2>
            <span class="close" onclick="cerrarModalAgregar()">&times;</span>
        </div>
        <form id="formAgregar" onsubmit="insertarAlmacen(event)">
            <div class="form-group">
                <label for="id_producto"><?php echo __('product_label'); ?> *</label>
                <div style="display: flex; gap: 10px;">
                    <select id="id_producto" name="id_producto" required style="flex: 1;">
                        <option value=""><?php echo __('select_product'); ?></option>
                    <?php 
                        // Reiniciar el cursor de resultados
                        $resultProductos->data_seek(0);
                        while ($prod = $resultProductos->fetch_assoc()): ?>
                            <option value="<?php echo $prod['id']; ?>">
                                <?php echo htmlspecialchars($prod['nombre']); ?> (ID: <?php echo $prod['id']; ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <button type="button" class="btn btn-secondary" onclick="abrirModalCrearProducto()" style="padding: 8px 12px;"><?php echo __('create_product'); ?></button>
                </div>
            </div>
                
            <div class="form-group">
                <label for="stock"><?php echo __('stock_label'); ?> *</label>
                <input type="number" id="stock" name="stock" required min="0" step="1">
            </div>
                
            <div class="form-group">
                <label for="ubicacion"><?php echo __('location_label'); ?> *</label>
                <input type="text" id="ubicacion" name="ubicacion" required placeholder="<?php echo __('example_locations'); ?>">
            </div>
                
            <div class="form-group">
                <label for="observaciones"><?php echo __('observations_label'); ?></label>
                <textarea id="observaciones" name="observaciones" placeholder="<?php echo __('additional_notes'); ?>"></textarea>
            </div>
                
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalAgregar()"><?php echo __('cancel'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo __('save_record'); ?></button>
            </div>
        </form>
    </div>
</div>

<!-- Modal para editar registro del almacén -->
<div id="modalEditarAlmacen" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo __('edit_warehouse_entry'); ?></h2>
            <span class="close" onclick="cerrarModalEditarAlmacen()">&times;</span>
        </div>
        <form id="formEditarAlmacen" onsubmit="actualizarAlmacen(event)">
            <input type="hidden" id="id_editar" name="id">
            
            <div class="form-group">
                <label for="id_producto_editar"><?php echo __('product_label'); ?> *</label>
                <div style="display: flex; gap: 10px;">
                    <select id="id_producto_editar" name="id_producto" required style="flex: 1;" disabled>
                        <option value=""><?php echo __('select_product'); ?></option>
                    <?php 
                        // Reiniciar el cursor de resultados
                        $resultProductos->data_seek(0);
                        while ($prod = $resultProductos->fetch_assoc()): ?>
                            <option value="<?php echo $prod['id']; ?>">
                                <?php echo htmlspecialchars($prod['nombre']); ?> (ID: <?php echo $prod['id']; ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
                
            <div class="form-group">
                <label for="stock_editar"><?php echo __('stock_label'); ?> *</label>
                <input type="number" id="stock_editar" name="stock" required min="0" step="1">
            </div>
                
            <div class="form-group">
                <label for="ubicacion_editar"><?php echo __('location_label'); ?> *</label>
                <input type="text" id="ubicacion_editar" name="ubicacion" required placeholder="<?php echo __('example_locations'); ?>">
            </div>
                
            <div class="form-group">
                <label for="observaciones_editar"><?php echo __('observations_label'); ?></label>
                <textarea id="observaciones_editar" name="observaciones" placeholder="<?php echo __('additional_notes'); ?>"></textarea>
            </div>
                
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalEditarAlmacen()"><?php echo __('cancel'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo __('update_record'); ?></button>
            </div>
        </form>
    </div>
</div>
    
<?php include 'modal_almacen_producto.php'; ?>