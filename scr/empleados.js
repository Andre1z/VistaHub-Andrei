function abrirModalAgregarEmpleado() {
    document.getElementById('modalAgregarEmpleado').style.display = 'block';
}

function cerrarModalAgregarEmpleado() {
    document.getElementById('modalAgregarEmpleado').style.display = 'none';
    document.getElementById('formAgregarEmpleado').reset();
}

function abrirModalEditarEmpleado(id) {
    document.getElementById('modalEditarEmpleado').style.display = 'block';

    fetch('back/obtener_empleado.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const empleado = data.empleado;
                document.getElementById('id_editar').value = empleado.id;
                document.getElementById('empresa_editar').value = empleado.id_empresa;
                document.getElementById('nombre_editar').value = empleado.nombre;
                document.getElementById('apellidos_editar').value = empleado.apellidos;
                document.getElementById('dni_editar').value = empleado.dni;
                document.getElementById('telefono_editar').value = empleado.telefono;
                document.getElementById('email_editar').value = empleado.email;
                document.getElementById('puesto_editar').value = empleado.puesto;
                document.getElementById('departamento_editar').value = empleado.departamento;
                document.getElementById('salario_editar').value = empleado.salario;
                document.getElementById('fecha_contratacion_editar').value = empleado.fecha_contratacion;
                document.getElementById('estado_editar').value = empleado.estado;
                document.getElementById('direccion_editar').value = empleado.direccion;
                document.getElementById('ciudad_editar').value = empleado.ciudad;
                document.getElementById('codigo_postal_editar').value = empleado.codigo_postal;
            } else {
                alert('Error al cargar el empleado: ' + data.message);
                cerrarModalEditarEmpleado();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error en la comunicación con el servidor');
            cerrarModalEditarEmpleado();
        });
}

function cerrarModalEditarEmpleado() {
    document.getElementById('modalEditarEmpleado').style.display = 'none';
    document.getElementById('formEditarEmpleado').reset();
}

function insertarEmpleado(event) {
    event.preventDefault();

    const formData = new FormData(document.getElementById('formAgregarEmpleado'));

    fetch('back/crear_empleado.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalAgregarEmpleado();
            window.location.href = 'empleados.php?status=success';
        } else {
            alert('Error al guardar el empleado: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

function actualizarEmpleado(event) {
    event.preventDefault();

    const formData = new FormData(document.getElementById('formEditarEmpleado'));

    fetch('back/actualizar_empleado.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalEditarEmpleado();
            window.location.href = 'empleados.php?status=success';
        } else {
            alert('Error al actualizar el empleado: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

function eliminarEmpleado(id) {
    fetch('back/eliminar_empleado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + id
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'empleados.php?status=success';
        } else {
            alert('Error al eliminar el empleado: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

window.onclick = function(event) {
    const modalAgregar = document.getElementById('modalAgregarEmpleado');
    const modalEditar = document.getElementById('modalEditarEmpleado');

    if (event.target == modalAgregar) {
        cerrarModalAgregarEmpleado();
    }
    if (event.target == modalEditar) {
        cerrarModalEditarEmpleado();
    }
};
