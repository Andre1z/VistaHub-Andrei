<?php require_once 'i18n.php'; ?>
<link rel="stylesheet" href="css/modal.css">

<div id="modalAgregarEmpleado" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Agregar empleado</h2>
            <span class="close" onclick="cerrarModalAgregarEmpleado()">&times;</span>
        </div>
        <form id="formAgregarEmpleado" onsubmit="insertarEmpleado(event)">
            <div class="form-group">
                <label for="empresa_agregar">Empresa *</label>
                <select id="empresa_agregar" name="id_empresa" required>
                    <option value="">Selecciona una empresa</option>
                    <?php if ($resultEmpresas && $resultEmpresas->num_rows > 0): ?>
                        <?php $resultEmpresas->data_seek(0); while ($empresa = $resultEmpresas->fetch_assoc()): ?>
                            <option value="<?php echo $empresa['id']; ?>"><?php echo htmlspecialchars($empresa['nombre']); ?></option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="">No hay empresas disponibles</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nombre_agregar">Nombre *</label>
                <input type="text" id="nombre_agregar" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellidos_agregar">Apellidos *</label>
                <input type="text" id="apellidos_agregar" name="apellidos" required>
            </div>

            <div class="form-group">
                <label for="dni_agregar">DNI</label>
                <input type="text" id="dni_agregar" name="dni">
            </div>

            <div class="form-group">
                <label for="telefono_agregar">Teléfono</label>
                <input type="text" id="telefono_agregar" name="telefono">
            </div>

            <div class="form-group">
                <label for="email_agregar">Email</label>
                <input type="email" id="email_agregar" name="email">
            </div>

            <div class="form-group">
                <label for="puesto_agregar">Puesto</label>
                <input type="text" id="puesto_agregar" name="puesto">
            </div>

            <div class="form-group">
                <label for="departamento_agregar">Departamento</label>
                <input type="text" id="departamento_agregar" name="departamento">
            </div>

            <div class="form-group">
                <label for="salario_agregar">Salario</label>
                <input type="number" id="salario_agregar" name="salario" min="0" step="0.01">
            </div>

            <div class="form-group">
                <label for="fecha_contratacion_agregar">Fecha de contratación</label>
                <input type="date" id="fecha_contratacion_agregar" name="fecha_contratacion">
            </div>

            <div class="form-group">
                <label for="estado_agregar">Estado *</label>
                <select id="estado_agregar" name="estado" required>
                    <option value="">Selecciona un estado</option>
                    <option value="Activo">Activo</option>
                    <option value="Vacaciones">Vacaciones</option>
                    <option value="Baja">Baja</option>
                    <option value="Despedido">Despedido</option>
                </select>
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

            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalAgregarEmpleado()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar empleado</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditarEmpleado" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar empleado</h2>
            <span class="close" onclick="cerrarModalEditarEmpleado()">&times;</span>
        </div>
        <form id="formEditarEmpleado" onsubmit="actualizarEmpleado(event)">
            <input type="hidden" id="id_editar" name="id">

            <div class="form-group">
                <label for="empresa_editar">Empresa *</label>
                <select id="empresa_editar" name="id_empresa" required>
                    <option value="">Selecciona una empresa</option>
                    <?php if ($resultEmpresas && $resultEmpresas->num_rows > 0): ?>
                        <?php $resultEmpresas->data_seek(0); while ($empresa = $resultEmpresas->fetch_assoc()): ?>
                            <option value="<?php echo $empresa['id']; ?>"><?php echo htmlspecialchars($empresa['nombre']); ?></option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="">No hay empresas disponibles</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nombre_editar">Nombre *</label>
                <input type="text" id="nombre_editar" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="apellidos_editar">Apellidos *</label>
                <input type="text" id="apellidos_editar" name="apellidos" required>
            </div>

            <div class="form-group">
                <label for="dni_editar">DNI</label>
                <input type="text" id="dni_editar" name="dni">
            </div>

            <div class="form-group">
                <label for="telefono_editar">Teléfono</label>
                <input type="text" id="telefono_editar" name="telefono">
            </div>

            <div class="form-group">
                <label for="email_editar">Email</label>
                <input type="email" id="email_editar" name="email">
            </div>

            <div class="form-group">
                <label for="puesto_editar">Puesto</label>
                <input type="text" id="puesto_editar" name="puesto">
            </div>

            <div class="form-group">
                <label for="departamento_editar">Departamento</label>
                <input type="text" id="departamento_editar" name="departamento">
            </div>

            <div class="form-group">
                <label for="salario_editar">Salario</label>
                <input type="number" id="salario_editar" name="salario" min="0" step="0.01">
            </div>

            <div class="form-group">
                <label for="fecha_contratacion_editar">Fecha de contratación</label>
                <input type="date" id="fecha_contratacion_editar" name="fecha_contratacion">
            </div>

            <div class="form-group">
                <label for="estado_editar">Estado *</label>
                <select id="estado_editar" name="estado" required>
                    <option value="">Selecciona un estado</option>
                    <option value="Activo">Activo</option>
                    <option value="Vacaciones">Vacaciones</option>
                    <option value="Baja">Baja</option>
                    <option value="Despedido">Despedido</option>
                </select>
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

            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalEditarEmpleado()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Actualizar empleado</button>
            </div>
        </form>
    </div>
</div>
