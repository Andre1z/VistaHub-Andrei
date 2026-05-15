function abrirModalAgregarCliente() {
    document.getElementById('modalAgregarCliente').style.display = 'block';
}

function cerrarModalAgregarCliente() {
    document.getElementById('modalAgregarCliente').style.display = 'none';
    document.getElementById('formAgregarCliente').reset();
}

function abrirModalEditarCliente(id) {
    document.getElementById('modalEditarCliente').style.display = 'block';

    fetch('back/obtener_cliente.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cliente = data.cliente;
                document.getElementById('id_editar').value = cliente.id;
                document.getElementById('nombre_editar').value = cliente.nombre;
                document.getElementById('apellidos_editar').value = cliente.apellidos;
                document.getElementById('email_editar').value = cliente.email;
                document.getElementById('telefono_editar').value = cliente.telefono;
                document.getElementById('direccion_editar').value = cliente.direccion;
                document.getElementById('ciudad_editar').value = cliente.ciudad;
                document.getElementById('codigo_postal_editar').value = cliente.codigo_postal;
                document.getElementById('pais_editar').value = cliente.pais;
            } else {
                alert('Error al cargar el cliente: ' + data.message);
                cerrarModalEditarCliente();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error en la comunicación con el servidor');
            cerrarModalEditarCliente();
        });
}

function cerrarModalEditarCliente() {
    document.getElementById('modalEditarCliente').style.display = 'none';
    document.getElementById('formEditarCliente').reset();
}

function insertarCliente(event) {
    event.preventDefault();

    const formData = new FormData(document.getElementById('formAgregarCliente'));

    fetch('back/crear_cliente.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalAgregarCliente();
            window.location.href = 'clientes.php?status=success';
        } else {
            alert('Error al guardar el cliente: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

function actualizarCliente(event) {
    event.preventDefault();

    const formData = new FormData(document.getElementById('formEditarCliente'));

    fetch('back/actualizar_cliente.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalEditarCliente();
            window.location.href = 'clientes.php?status=success';
        } else {
            alert('Error al actualizar el cliente: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

function eliminarCliente(id) {
    fetch('back/eliminar_cliente.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + id
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'clientes.php?status=success';
        } else {
            alert('Error al eliminar el cliente: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

window.onclick = function(event) {
    const modalAgregar = document.getElementById('modalAgregarCliente');
    const modalEditar = document.getElementById('modalEditarCliente');

    if (event.target == modalAgregar) {
        cerrarModalAgregarCliente();
    }
    if (event.target == modalEditar) {
        cerrarModalEditarCliente();
    }
};
