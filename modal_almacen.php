<link rel="stylesheet" href="css/modal.css">
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
                <input type="text" id="ubicacion" name="ubicacion" required placeholder="Ej: Barcelona, Madrid, Valencia...">
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

<!-- Modal para editar registro del almacén -->
<div id="modalEditarAlmacen" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Registro del Almacén</h2>
            <span class="close" onclick="cerrarModalEditarAlmacen()">&times;</span>
        </div>
        <form id="formEditarAlmacen" onsubmit="actualizarAlmacen(event)">
            <input type="hidden" id="id_editar" name="id">
            
            <div class="form-group">
                <label for="id_producto_editar">Producto *</label>
                <div style="display: flex; gap: 10px;">
                    <select id="id_producto_editar" name="id_producto" required style="flex: 1;" disabled>
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
                </div>
            </div>
                
            <div class="form-group">
                <label for="stock_editar">Stock *</label>
                <input type="number" id="stock_editar" name="stock" required min="0" step="1">
            </div>
                
            <div class="form-group">
                <label for="ubicacion_editar">Ubicación *</label>
                <input type="text" id="ubicacion_editar" name="ubicacion" required placeholder="Ej: Barcelona, Madrid, Valencia...">
            </div>
                
            <div class="form-group">
                <label for="observaciones_editar">Observaciones</label>
                <textarea id="observaciones_editar" name="observaciones" placeholder="Notas adicionales..."></textarea>
            </div>
                
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalEditarAlmacen()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Actualizar Registro</button>
            </div>
        </form>
    </div>
</div>
    
<?php include 'modal_almacen_producto.php'; ?>