<link rel="stylesheet" href="css/modal.css">

<!-- Modal para agregar nuevo producto -->
<div id="modalAgregarProducto" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo __('add_new_product'); ?></h2>
            <span class="close" onclick="cerrarModalAgregarProducto()">&times;</span>
        </div>
        <form id="formAgregarProducto" onsubmit="insertarProducto(event)">
            <div class="form-group">
                <label for="codigo"><?php echo __('product_code'); ?> *</label>
                <input type="text" id="codigo" name="codigo" required placeholder="<?php echo __('example_code'); ?>" readonly style="background-color: #f0f0f0; cursor: not-allowed;">
            </div>
            
            <div class="form-group">
                <label for="nombre"><?php echo __('product_name'); ?> *</label>
                <input type="text" id="nombre" name="nombre" required placeholder="<?php echo __('example_name'); ?>">
            </div>
            
            <div class="form-group">
                <label for="descripcion"><?php echo __('description_label'); ?></label>
                <textarea id="descripcion" name="descripcion" placeholder="<?php echo __('description_placeholder'); ?>"></textarea>
            </div>
            
            <div class="form-group">
                <label for="precio"><?php echo __('price_label'); ?> *</label>
                <input type="number" id="precio" name="precio" required min="0" step="0.01" placeholder="0.00">
            </div>
            
            <div class="form-group">
                <label for="iva"><?php echo __('iva_label'); ?> *</label>
                <input type="number" id="iva" name="iva" required min="0" max="100" step="0.01" value="21" placeholder="21">
            </div>
            
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalAgregarProducto()"><?php echo __('cancel'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo __('save_product'); ?></button>
            </div>
        </form>
    </div>
</div>

<!-- Modal para editar producto -->
<div id="modalEditarProducto" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo __('edit_product'); ?></h2>
            <span class="close" onclick="cerrarModalEditarProducto()">&times;</span>
        </div>
        <form id="formEditarProducto" onsubmit="actualizarProducto(event)">
            <input type="hidden" id="id_editar" name="id">
            
            <div class="form-group">
                <label for="codigo_editar"><?php echo __('product_code'); ?> *</label>
                <input type="text" id="codigo_editar" name="codigo" required placeholder="<?php echo __('example_code'); ?>" readonly style="background-color: #f0f0f0; cursor: not-allowed;">
            </div>
            
            <div class="form-group">
                <label for="nombre_editar"><?php echo __('product_name'); ?> *</label>
                <input type="text" id="nombre_editar" name="nombre" required placeholder="<?php echo __('example_name'); ?>">
            </div>
            
            <div class="form-group">
                <label for="descripcion_editar"><?php echo __('description_label'); ?></label>
                <textarea id="descripcion_editar" name="descripcion" placeholder="<?php echo __('description_placeholder'); ?>"></textarea>
            </div>
            
            <div class="form-group">
                <label for="precio_editar"><?php echo __('price_label'); ?> *</label>
                <input type="number" id="precio_editar" name="precio" required min="0" step="0.01" placeholder="0.00">
            </div>
            
            <div class="form-group">
                <label for="iva_editar"><?php echo __('iva_label'); ?> *</label>
                <input type="number" id="iva_editar" name="iva" required min="0" max="100" step="0.01" placeholder="21">
            </div>
            
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalEditarProducto()"><?php echo __('cancel'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo __('update_product'); ?></button>
            </div>
        </form>
    </div>
</div>
