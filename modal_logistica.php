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
                <div style="display: flex; gap: 10px; align-items: center;">
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
                    <button type="button" class="btn btn-secondary" onclick="abrirModalCrearEmpresa()">Crear Empresa</button>
                </div>
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
                <select id="estado_agregar" name="estado" required>
                    <option value="">Selecciona un estado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="En transito">En tránsito</option>
                    <option value="entregado">Entregado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
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
            <h2><?php echo __('Editar Logística'); ?></h2>
            <span class="close" onclick="cerrarModalEditarLogistica()">&times;</span>
        </div>
        <form id="formEditarLogistica" onsubmit="actualizarLogistica(event)">
            <input type="hidden" id="id_editar" name="id">
            
            <div class="form-group">
                <label for="pedido_editar"><?php echo __('Pedido'); ?> *</label>
                <select id="pedido_editar" name="id_pedido" required>
                    <option value=""><?php echo __('Seleccionar Pedido'); ?></option>
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
                <label for="empresa_editar"><?php echo __('Empresa'); ?> *</label>
                <select id="empresa_editar" name="id_empresa" required>
                    <option value=""><?php echo __('Seleccionar Empresa'); ?></option>
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
                <label for="fecha_salida_editar"><?php echo __('Fecha de Salida'); ?> *</label>
                <input type="date" id="fecha_salida_editar" name="fecha_salida" required>
            </div>
            
            <div class="form-group">
                <label for="fecha_entrega_prevista_editar"><?php echo __('Fecha de Entrega Prevista'); ?> *</label>
                <input type="date" id="fecha_entrega_prevista_editar" name="fecha_entrega_prevista" required>
            </div>
            
            <div class="form-group">
                <label for="estado_editar"><?php echo __('Estado'); ?> *</label>
                <select id="estado_editar" name="estado" required>
                    <option value="">Selecciona un estado</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="En transito">En tránsito</option>
                    <option value="entregado">Entregado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="origen_editar"><?php echo __('Origen'); ?></label>
                <input type="text" id="origen_editar" name="origen">
            </div>
            
            <div class="form-group">
                <label for="destino_editar"><?php echo __('Destino'); ?></label>
                <input type="text" id="destino_editar" name="destino">
            </div>
            
            <div class="form-group">
                <label for="observaciones_editar"><?php echo __('Observaciones'); ?></label>
                <textarea id="observaciones_editar" name="observaciones"></textarea>
            </div>
            
            <div class="form-group">
                <label for="incidencias_editar"><?php echo __('Incidencias'); ?></label>
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

<!-- Modal para crear empresa -->
<div id="modalCrearEmpresa" class="modal modal-logistica">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Crear Empresa</h2>
            <span class="close" onclick="cerrarModalCrearEmpresa()">&times;</span>
        </div>
        <form id="formCrearEmpresa" onsubmit="crearEmpresa(event)">
            <div class="form-group">
                <label for="cif_nif_nie">CIF/NIF/NIE *</label>
                <input type="text" id="cif_nif_nie" name="cif_nif_nie" required>
            </div>
            
            <div class="form-group">
                <label for="nombre_empresa">Nombre *</label>
                <input type="text" id="nombre_empresa" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label for="domicilio">Domicilio *</label>
                <input type="text" id="domicilio" name="domicilio" required>
            </div>
            
            <div class="form-group">
                <label for="municipio">Municipio *</label>
                <input type="text" id="municipio" name="municipio" required>
            </div>
            
            <div class="form-group">
                <label for="codigo_postal">Código Postal *</label>
                <input type="text" id="codigo_postal" name="codigo_postal" required>
            </div>
            
            <div class="form-group">
                <label for="pais">País *</label>
                <select id="pais" name="pais" required>
                    <option value="">Selecciona un país</option>
                    <option value="Afganistán">Afganistán</option>
                    <option value="Albania">Albania</option>
                    <option value="Alemania">Alemania</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Antigua y Barbuda">Antigua y Barbuda</option>
                    <option value="Arabia Saudita">Arabia Saudita</option>
                    <option value="Argelia">Argelia</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaiyán">Azerbaiyán</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bangladés">Bangladés</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Baréin">Baréin</option>
                    <option value="Bélgica">Bélgica</option>
                    <option value="Belice">Belice</option>
                    <option value="Benín">Benín</option>
                    <option value="Bielorrusia">Bielorrusia</option>
                    <option value="Birmania">Birmania</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
                    <option value="Botsuana">Botsuana</option>
                    <option value="Brasil">Brasil</option>
                    <option value="Brunéi">Brunéi</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cabo Verde">Cabo Verde</option>
                    <option value="Camboya">Camboya</option>
                    <option value="Camerún">Camerún</option>
                    <option value="Canadá">Canadá</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Chipre">Chipre</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoras">Comoras</option>
                    <option value="Corea del Norte">Corea del Norte</option>
                    <option value="Corea del Sur">Corea del Sur</option>
                    <option value="Costa de Marfil">Costa de Marfil</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Croacia">Croacia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Dinamarca">Dinamarca</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egipto">Egipto</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Eslovaquia">Eslovaquia</option>
                    <option value="Eslovenia">Eslovenia</option>
                    <option value="España">España</option>
                    <option value="Estados Unidos">Estados Unidos</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Esuatini">Esuatini</option>
                    <option value="Etiopía">Etiopía</option>
                    <option value="Filipinas">Filipinas</option>
                    <option value="Finlandia">Finlandia</option>
                    <option value="Fiyi">Fiyi</option>
                    <option value="Francia">Francia</option>
                    <option value="Gabón">Gabón</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Granada">Granada</option>
                    <option value="Grecia">Grecia</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bisáu">Guinea-Bisáu</option>
                    <option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haití">Haití</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hungría">Hungría</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Irak">Irak</option>
                    <option value="Irán">Irán</option>
                    <option value="Irlanda">Irlanda</option>
                    <option value="Islandia">Islandia</option>
                    <option value="Islas Marshall">Islas Marshall</option>
                    <option value="Islas Salomón">Islas Salomón</option>
                    <option value="Israel">Israel</option>
                    <option value="Italia">Italia</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japón">Japón</option>
                    <option value="Jordania">Jordania</option>
                    <option value="Kazajistán">Kazajistán</option>
                    <option value="Kenia">Kenia</option>
                    <option value="Kirguistán">Kirguistán</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Laos">Laos</option>
                    <option value="Lesoto">Lesoto</option>
                    <option value="Letonia">Letonia</option>
                    <option value="Líbano">Líbano</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libia">Libia</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lituania">Lituania</option>
                    <option value="Luxemburgo">Luxemburgo</option>
                    <option value="Macedonia del Norte">Macedonia del Norte</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malasia">Malasia</option>
                    <option value="Malaui">Malaui</option>
                    <option value="Maldivas">Maldivas</option>
                    <option value="Malta">Malta</option>
                    <option value="Marruecos">Marruecos</option>
                    <option value="Mauricio">Mauricio</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="México">México</option>
                    <option value="Micronesia">Micronesia</option>
                    <option value="Moldavia">Moldavia</option>
                    <option value="Mónaco">Mónaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Níger">Níger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Noruega">Noruega</option>
                    <option value="Nueva Zelanda">Nueva Zelanda</option>
                    <option value="Omán">Omán</option>
                    <option value="Países Bajos">Países Bajos</option>
                    <option value="Pakistán">Pakistán</option>
                    <option value="Palaos">Palaos</option>
                    <option value="Panamá">Panamá</option>
                    <option value="Papúa Nueva Guinea">Papúa Nueva Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Perú">Perú</option>
                    <option value="Polonia">Polonia</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Reino Unido">Reino Unido</option>
                    <option value="República Centroafricana">República Centroafricana</option>
                    <option value="República Checa">República Checa</option>
                    <option value="República del Congo">República del Congo</option>
                    <option value="República Democrática del Congo">República Democrática del Congo</option>
                    <option value="República Dominicana">República Dominicana</option>
                    <option value="Ruanda">Ruanda</option>
                    <option value="Rumanía">Rumanía</option>
                    <option value="Rusia">Rusia</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Cristóbal y Nieves">San Cristóbal y Nieves</option>
                    <option value="San Marino">San Marino</option>
                    <option value="San Vicente y las Granadinas">San Vicente y las Granadinas</option>
                    <option value="Santa Lucía">Santa Lucía</option>
                    <option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leona">Sierra Leona</option>
                    <option value="Singapur">Singapur</option>
                    <option value="Siria">Siria</option>
                    <option value="Somalia">Somalia</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Suazilandia">Suazilandia</option>
                    <option value="Sudáfrica">Sudáfrica</option>
                    <option value="Sudán">Sudán</option>
                    <option value="Sudán del Sur">Sudán del Sur</option>
                    <option value="Suecia">Suecia</option>
                    <option value="Suiza">Suiza</option>
                    <option value="Surinam">Surinam</option>
                    <option value="Tailandia">Tailandia</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Tayikistán">Tayikistán</option>
                    <option value="Timor Oriental">Timor Oriental</option>
                    <option value="Togo">Togo</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad y Tobago">Trinidad y Tobago</option>
                    <option value="Túnez">Túnez</option>
                    <option value="Turkmenistán">Turkmenistán</option>
                    <option value="Turquía">Turquía</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Ucrania">Ucrania</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistán">Uzbekistán</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Yibuti">Yibuti</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabue">Zimbabue</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="telefono">Teléfono *</label>
                <input type="number" id="telefono" name="telefono" required>
            </div>
            
            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="cerrarModalCrearEmpresa()">Cancelar</button>
                <button type="submit" class="btn btn-primary">Crear Empresa</button>
            </div>
        </form>
    </div>
</div>