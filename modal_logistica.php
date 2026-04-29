<?php require_once 'i18n.php'; ?>
<link rel="stylesheet" href="css/modal.css">

<!-- Modal para editar registro de logística -->
<div id="modalEditarLogistica" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo __('edit_logistica'); ?></h2>
            <span class="close" onclick="cerrarModalEditarLogistica()">&times;</span>
        </div>
        <form id="formEditarLogistica" onsubmit="actualizarLogistica(event)">
            <input type="hidden" id="id_editar" name="id">
            
            <div class="form-group">
                <label for="pedido_editar"><?php echo __('pedido'); ?> *</label>
                <select id="pedido_editar" name="id_pedido" required>
                    <option value=""><?php echo __('select_pedido'); ?></option>
                    <?php 
                        $resultPedidos->data_seek(0);
                        while ($ped = $resultPedidos->fetch_assoc()): ?>
                            <option value="<?php echo $ped['id']; ?>">
                                Pedido #<?php echo $ped['id']; ?> - <?php echo $ped['fecha_pedido']; ?> (<?php echo $ped['estado']; ?>)
                            </option>
                        <?php endwhile; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="empresa_editar"><?php echo __('empresa'); ?> *</label>
                <select id="empresa_editar" name="id_empresa" required>
                    <option value=""><?php echo __('select_empresa'); ?></option>
                    <?php 
                        $resultEmpresas->data_seek(0);
                        while ($emp = $resultEmpresas->fetch_assoc()): ?>
                            <option value="<?php echo $emp['id']; ?>">
                                <?php echo htmlspecialchars($emp['nombre']); ?> (ID: <?php echo $emp['id']; ?>)
                            </option>
                        <?php endwhile; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="nombre_empresa_editar"><?php echo __('nombre_empresa'); ?> *</label>
                <input type="text" id="nombre_empresa_editar" name="nombre_empresa" required>
            </div>
            
            <div class="form-group">
                <label for="fecha_salida_editar"><?php echo __('fecha_salida'); ?> *</label>
                <input type="date" id="fecha_salida_editar" name="fecha_salida" required>
            </div>
            
            <div class="form-group">
                <label for="fecha_entrega_prevista_editar"><?php echo __('fecha_entrega_prevista'); ?> *</label>
                <input type="date" id="fecha_entrega_prevista_editar" name="fecha_entrega_prevista" required>
            </div>
            
            <div class="form-group">
                <label for="estado_editar"><?php echo __('estado'); ?> *</label>
                <input type="text" id="estado_editar" name="estado" required>
            </div>
            
            <div class="form-group">
                <label for="numero_seguimiento_editar"><?php echo __('numero_seguimiento'); ?></label>
                <input type="text" id="numero_seguimiento_editar" name="numero_seguimiento">
            </div>
            
            <div class="form-group">
                <label for="origen_editar"><?php echo __('origen'); ?></label>
                <input type="text" id="origen_editar" name="origen">
            </div>
            
            <div class="form-group">
                <label for="destino_editar"><?php echo __('destino'); ?></label>
                <input type="text" id="destino_editar" name="destino">
            </div>
            
            <div class="form-group">
                <label for="observaciones_editar"><?php echo __('observaciones'); ?></label>
                <textarea id="observaciones_editar" name="observaciones"></textarea>
            </div>
            
            <div class="form-group">
                <label for="incidencias_editar"><?php echo __('incidencias'); ?></label>
                <textarea id="incidencias_editar" name="incidencias"></textarea>
            </div>
            
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalEditarLogistica()"><?php echo __('cancel'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo __('update_record'); ?></button>
            </div>
        </form>
    </div>
</div>