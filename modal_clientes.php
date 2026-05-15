<?php require_once 'i18n.php'; ?>
<link rel="stylesheet" href="css/modal.css">

<div id="modalAgregarCliente" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Agregar cliente</h2>
            <span class="close" onclick="cerrarModalAgregarCliente()">&times;</span>
        </div>
        <form id="formAgregarCliente" onsubmit="insertarCliente(event)">
            <div class="form-group">
                <label for="nombre_agregar">Nombre *</label>
                <input type="text" id="nombre_agregar" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellidos_agregar">Apellidos *</label>
                <input type="text" id="apellidos_agregar" name="apellidos" required>
            </div>
            <div class="form-group">
                <label for="email_agregar">Email</label>
                <input type="email" id="email_agregar" name="email">
            </div>
            <div class="form-group">
                <label for="telefono_agregar">Teléfono</label>
                <input type="text" id="telefono_agregar" name="telefono">
            </div>
            <div class="form-group">
                <label for="direccion_agregar">Dirección</label>
                <input type="text" id="direccion_agregar" name="direccion">
            </div>
            <div class="form-group">
                <label for="ciudad_agregar">Ciudad</label>
                <input type="text" id="ciudad_agregar" name="ciudad">
            </div>
            <div class="form-group">
                <label for="codigo_postal_agregar">Código postal</label>
                <input type="text" id="codigo_postal_agregar" name="codigo_postal">
            </div>
            <div class="form-group">
                <label for="pais_agregar">País</label>
                <input type="text" id="pais_agregar" name="pais">
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalAgregarCliente()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cliente</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditarCliente" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar cliente</h2>
            <span class="close" onclick="cerrarModalEditarCliente()">&times;</span>
        </div>
        <form id="formEditarCliente" onsubmit="actualizarCliente(event)">
            <input type="hidden" id="id_editar" name="id">
            <div class="form-group">
                <label for="nombre_editar">Nombre *</label>
                <input type="text" id="nombre_editar" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellidos_editar">Apellidos *</label>
                <input type="text" id="apellidos_editar" name="apellidos" required>
            </div>
            <div class="form-group">
                <label for="email_editar">Email</label>
                <input type="email" id="email_editar" name="email">
            </div>
            <div class="form-group">
                <label for="telefono_editar">Teléfono</label>
                <input type="text" id="telefono_editar" name="telefono">
            </div>
            <div class="form-group">
                <label for="direccion_editar">Dirección</label>
                <input type="text" id="direccion_editar" name="direccion">
            </div>
            <div class="form-group">
                <label for="ciudad_editar">Ciudad</label>
                <input type="text" id="ciudad_editar" name="ciudad">
            </div>
            <div class="form-group">
                <label for="codigo_postal_editar">Código postal</label>
                <input type="text" id="codigo_postal_editar" name="codigo_postal">
            </div>
            <div class="form-group">
                <label for="pais_editar">País</label>
                <input type="text" id="pais_editar" name="pais">
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalEditarCliente()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Actualizar cliente</button>
            </div>
        </form>
    </div>
</div>
