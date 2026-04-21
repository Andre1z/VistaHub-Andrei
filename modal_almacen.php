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