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