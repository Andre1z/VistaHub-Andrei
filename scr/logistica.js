function abrirModalEditarLogistica(id) {
    document.getElementById('modalEditarLogistica').style.display = 'block';
    
    // Cargar datos del registro de logística
    fetch('back/obtener_logistica.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('id_editar').value = data.logistica.id;
                document.getElementById('pedido_editar').value = data.logistica.id_pedido;
                document.getElementById('empresa_editar').value = data.logistica.id_empresa;
                document.getElementById('nombre_empresa_editar').value = data.logistica.nombre_empresa;
                document.getElementById('fecha_salida_editar').value = data.logistica.fecha_salida;
                document.getElementById('fecha_entrega_prevista_editar').value = data.logistica.fecha_entrega_prevista;
                document.getElementById('estado_editar').value = data.logistica.estado;
                document.getElementById('numero_seguimiento_editar').value = data.logistica.numero_seguimiento;
                document.getElementById('origen_editar').value = data.logistica.origen;
                document.getElementById('destino_editar').value = data.logistica.destino;
                document.getElementById('observaciones_editar').value = data.logistica.observaciones;
                document.getElementById('incidencias_editar').value = data.logistica.incidencias;
            } else {
                alert('Error al cargar el registro: ' + data.message);
                cerrarModalEditarLogistica();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error en la comunicación con el servidor');
            cerrarModalEditarLogistica();
        });
}

function cerrarModalAgregarLogistica() {
    document.getElementById('modalAgregarLogistica').style.display = 'none';
    document.getElementById('formAgregarLogistica').reset();
}

function cerrarModalEditarLogistica() {
    document.getElementById('modalEditarLogistica').style.display = 'none';
    document.getElementById('formEditarLogistica').reset();
}

function abrirModalAgregarLogistica() {
    document.getElementById('modalAgregarLogistica').style.display = 'block';
}

function insertarLogistica(event) {
    event.preventDefault();
    
    const formData = new FormData(document.getElementById('formAgregarLogistica'));
    
    fetch('back/agregar_logistica.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalAgregarLogistica();
            window.location.href = 'logistica.php?status=success';
        } else {
            alert('Error al guardar el registro: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

function actualizarLogistica(event) {
    event.preventDefault();
    
    const formData = new FormData(document.getElementById('formEditarLogistica'));
    
    fetch('back/actualizar_logistica.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalEditarLogistica();
            window.location.href = 'logistica.php?status=success';
        } else {
            alert('Error al actualizar el registro: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

function eliminarLogistica(id) {
    fetch('back/eliminar_logistica.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + id
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'logistica.php?status=success';
        } else {
            alert('Error al eliminar el registro: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

// Cerrar modal al hacer click fuera de él
window.onclick = function(event) {
    const modalAgregar = document.getElementById('modalAgregarLogistica');
    const modalEditar = document.getElementById('modalEditarLogistica');
    
    if (event.target == modalAgregar) {
        cerrarModalAgregarLogistica();
    }
    if (event.target == modalEditar) {
        cerrarModalEditarLogistica();
    }
};