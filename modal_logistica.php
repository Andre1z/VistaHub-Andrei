<?php require_once 'i18n.php'; ?>
<link rel="stylesheet" href="css/modal.css">

<!-- Modal para agregar registro de logística -->
<div id="modalAgregarLogistica" class="modal modal-logistica">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Agregar registro de logística</h2>
            <span class="close" onclick="cerrarModalAgregarLogistica()">&times;</span>
        </div>
        <form id="formAgregarLogistica" onsubmit="insertarLogistica(event)">
            <div class="form-group">
                <label for="pedido_agregar">Pedido *</label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <select id="pedido_agregar" name="id_pedido" required>
                        <option value="">Selecciona un pedido</option>
                        <?php 
                            $resultPedidos->data_seek(0);
                            while ($ped = $resultPedidos->fetch_assoc()): ?>
                                <option value="<?php echo $ped['id']; ?>">
                                    Pedido #<?php echo $ped['id']; ?> - <?php echo $ped['fecha_pedido']; ?> (<?php echo $ped['estado']; ?>)
                                </option>
                            <?php endwhile; ?>
                    </select>
                    <button type="button" class="btn btn-secondary" onclick="abrirModalCrearPedido()">Crear Pedido</button>
                </div>
            </div>
            
            <div class="form-group">
                <label for="empresa_agregar">Empresa *</label>
                <select id="empresa_agregar" name="id_empresa" required>
                    <option value="">Selecciona una empresa</option>
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
                <label for="nombre_empresa_agregar">Nombre empresa *</label>
                <input type="text" id="nombre_empresa_agregar" name="nombre_empresa" required>
            </div>
            
            <div class="form-group">
                <label for="fecha_salida_agregar">Fecha salida *</label>
                <input type="date" id="fecha_salida_agregar" name="fecha_salida" required>
            </div>
            
            <div class="form-group">
                <label for="fecha_entrega_prevista_agregar">Fecha entrega prevista *</label>
                <input type="date" id="fecha_entrega_prevista_agregar" name="fecha_entrega_prevista" required>
            </div>
            
            <div class="form-group">
                <label for="estado_agregar">Estado *</label>
                <input type="text" id="estado_agregar" name="estado" required>
            </div>
            
            <div class="form-group">
                <label for="numero_seguimiento_agregar">Número de seguimiento</label>
                <input type="text" id="numero_seguimiento_agregar" name="numero_seguimiento">
            </div>
            
            <div class="form-group">
                <label for="origen_agregar">Origen</label>
                <input type="text" id="origen_agregar" name="origen">
            </div>
            
            <div class="form-group">
                <label for="destino_agregar">Destino</label>
                <input type="text" id="destino_agregar" name="destino">
            </div>
            
            <div class="form-group">
                <label for="observaciones_agregar">Observaciones</label>
                <textarea id="observaciones_agregar" name="observaciones"></textarea>
            </div>
            
            <div class="form-group">
                <label for="incidencias_agregar">Incidencias</label>
                <textarea id="incidencias_agregar" name="incidencias"></textarea>
            </div>
            
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalAgregarLogistica()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar registro</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal para editar registro de logística -->
<div id="modalEditarLogistica" class="modal modal-logistica">
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

<!-- Modal para crear pedido -->
<div id="modalCrearPedido" class="modal modal-logistica">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Crear Pedido</h2>
            <span class="close" onclick="cerrarModalCrearPedido()">&times;</span>
        </div>
        <form id="formCrearPedido" onsubmit="crearPedido(event)">
            <div class="form-group">
                <label for="id_empresa_pedido">Empresa *</label>
                <select id="id_empresa_pedido" name="id_empresa" required>
                    <option value="">Selecciona una empresa</option>
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
                <label for="fecha_pedido">Fecha Pedido *</label>
                <input type="date" id="fecha_pedido" name="fecha_pedido" required>
            </div>
            
            <div class="form-group">
                <label for="estado_pedido">Estado *</label>
                <select id="estado_pedido" name="estado" required>
                    <option value="">Selecciona un estado</option>
                    <option value="borrador">Borrador</option>
                    <option value="confirmado">Confirmado</option>
                    <option value="enviado">Enviado</option>
                    <option value="completado">Completado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="total_bruto">Total Bruto *</label>
                <input type="number" step="0.01" id="total_bruto" name="total_bruto" required>
            </div>
            
            <div class="form-group">
                <label for="total_iva">Total IVA *</label>
                <input type="number" step="0.01" id="total_iva" name="total_iva" required>
            </div>
            
            <div class="form-group">
                <label for="total_neto">Total Neto *</label>
                <input type="number" step="0.01" id="total_neto" name="total_neto" required>
            </div>
            
            <div class="form-group">
                <label for="metodo_pago">Método de Pago</label>
                <input type="text" id="metodo_pago" name="metodo_pago">
            </div>
            
            <div class="form-group">
                <label for="observaciones_pedido">Observaciones</label>
                <textarea id="observaciones_pedido" name="observaciones"></textarea>
            </div>
            
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalCrearPedido()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Crear Pedido</button>
            </div>
        </form>
    </div>
</div>