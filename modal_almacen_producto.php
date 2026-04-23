<?php require_once 'i18n.php'; ?>
<!-- Modal para crear nuevo producto -->
<div id="modalCrearProducto" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo __('add_new_product'); ?></h2>
            <span class="close" onclick="cerrarModalCrearProducto()">&times;</span>
        </div>
        <form id="formCrearProducto" onsubmit="crearProducto(event)">
            <input type="hidden" id="codigo" name="codigo">
            
            <div class="form-group">
                <label for="codigo_display"><?php echo __('product_code'); ?> *</label>
                <input type="text" id="codigo_display" name="codigo_display" required placeholder="<?php echo __('example_code'); ?>" readonly style="background-color: #f0f0f0; cursor: not-allowed;">
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
                <button type="button" class="btn btn-secondary" onclick="cerrarModalCrearProducto()"><?php echo __('cancel'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo __('save_product'); ?></button>
            </div>
        </form>
    </div>
</div>