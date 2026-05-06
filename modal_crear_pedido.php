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
