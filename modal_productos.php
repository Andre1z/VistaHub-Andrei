<link rel="stylesheet" href="css/modal.css">

<!-- Modal para agregar nuevo producto -->
<div id="modalAgregarProducto" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Agregar Nuevo Producto</h2>
            <span class="close" onclick="cerrarModalAgregarProducto()">&times;</span>
        </div>
        <form id="formAgregarProducto" onsubmit="insertarProducto(event)">
            <div class="form-group">
                <label for="codigo">Código del Producto *</label>
                <input type="text" id="codigo" name="codigo" required placeholder="Ej: PROD-001" readonly style="background-color: #f0f0f0; cursor: not-allowed;">
            </div>
            
            <div class="form-group">
                <label for="nombre">Nombre del Producto *</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Ej: Laptop Dell">
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" placeholder="Descripción detallada del producto..."></textarea>
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
                <button type="button" class="btn btn-secondary" onclick="cerrarModalAgregarProducto()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Producto</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal para editar producto -->
<div id="modalEditarProducto" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Producto</h2>
            <span class="close" onclick="cerrarModalEditarProducto()">&times;</span>
        </div>
        <form id="formEditarProducto" onsubmit="actualizarProducto(event)">
            <input type="hidden" id="id_editar" name="id">
            
            <div class="form-group">
                <label for="codigo_editar">Código del Producto *</label>
                <input type="text" id="codigo_editar" name="codigo" required placeholder="Ej: PROD-001" readonly style="background-color: #f0f0f0; cursor: not-allowed;">
            </div>
            
            <div class="form-group">
                <label for="nombre_editar">Nombre del Producto *</label>
                <input type="text" id="nombre_editar" name="nombre" required placeholder="Ej: Laptop Dell">
            </div>
            
            <div class="form-group">
                <label for="descripcion_editar">Descripción</label>
                <textarea id="descripcion_editar" name="descripcion" placeholder="Descripción detallada del producto..."></textarea>
            </div>
            
            <div class="form-group">
                <label for="precio_editar">Precio *</label>
                <input type="number" id="precio_editar" name="precio" required min="0" step="0.01" placeholder="0.00">
            </div>
            
            <div class="form-group">
                <label for="iva_editar">IVA (%) *</label>
                <input type="number" id="iva_editar" name="iva" required min="0" max="100" step="0.01" placeholder="21">
            </div>
            
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalEditarProducto()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Actualizar Producto</button>
            </div>
        </form>
    </div>
</div>
