// Funciones para el modal de agregar producto
function abrirModalAgregarProducto() {
    document.getElementById('modalAgregarProducto').style.display = 'block';
    generarCodigoProducto();
}

function cerrarModalAgregarProducto() {
    document.getElementById('modalAgregarProducto').style.display = 'none';
    document.getElementById('formAgregarProducto').reset();
}

// Funciones para el modal de editar producto
function abrirModalEditarProducto(id) {
    document.getElementById('modalEditarProducto').style.display = 'block';
    
    // Cargar datos del producto
    fetch('back/obtener_producto.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('id_editar').value = data.producto.id;
                document.getElementById('codigo_editar').value = data.producto.codigo;
                document.getElementById('nombre_editar').value = data.producto.nombre;
                document.getElementById('descripcion_editar').value = data.producto.descripcion;
                document.getElementById('precio_editar').value = data.producto.precio;
                document.getElementById('iva_editar').value = data.producto.iva;
            } else {
                alert('Error al cargar el producto: ' + data.message);
                cerrarModalEditarProducto();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error en la comunicación con el servidor');
            cerrarModalEditarProducto();
        });
}

function cerrarModalEditarProducto() {
    document.getElementById('modalEditarProducto').style.display = 'none';
    document.getElementById('formEditarProducto').reset();
}

// Generar código de producto
function generarCodigoProducto() {
    fetch('back/generar_codigo_producto.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('codigo').value = data.codigo;
            } else {
                console.error('Error al generar código:', data.message);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });
}

// Insertar nuevo producto
function insertarProducto(event) {
    event.preventDefault();
    
    const formData = new FormData(document.getElementById('formAgregarProducto'));
    
    fetch('back/crear_producto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalAgregarProducto();
            window.location.href = 'productos.php?status=success';
        } else {
            alert('Error al guardar el producto: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

// Actualizar producto
function actualizarProducto(event) {
    event.preventDefault();
    
    const formData = new FormData(document.getElementById('formEditarProducto'));
    
    fetch('back/actualizar_producto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalEditarProducto();
            window.location.href = 'productos.php?status=success';
        } else {
            alert('Error al actualizar el producto: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

// Eliminar producto
function eliminarProducto(id) {
    fetch('back/eliminar_producto.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + id
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'productos.php?status=success';
        } else {
            alert('Error al eliminar el producto: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

// Cerrar modales al hacer click fuera de ellos
window.onclick = function(event) {
    const modalAgregar = document.getElementById('modalAgregarProducto');
    const modalEditar = document.getElementById('modalEditarProducto');
    
    if (event.target == modalAgregar) {
        cerrarModalAgregarProducto();
    }
    if (event.target == modalEditar) {
        cerrarModalEditarProducto();
    }
};
