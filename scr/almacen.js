function abrirModalAgregar() {
    document.getElementById('modalAgregar').style.display = 'block';
}
        
function cerrarModalAgregar() {
    document.getElementById('modalAgregar').style.display = 'none';
    document.getElementById('formAgregar').reset();
}

function abrirModalEditarAlmacen(id) {
    document.getElementById('modalEditarAlmacen').style.display = 'block';
    
    // Cargar datos del almacén
    fetch('back/obtener_almacen.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('id_editar').value = data.almacen.id;
                document.getElementById('id_producto_editar').value = data.almacen.id_producto;
                document.getElementById('stock_editar').value = data.almacen.stock;
                document.getElementById('ubicacion_editar').value = data.almacen.ubicacion;
                document.getElementById('observaciones_editar').value = data.almacen.observaciones;
            } else {
                alert('Error al cargar el registro: ' + data.message);
                cerrarModalEditarAlmacen();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error en la comunicación con el servidor');
            cerrarModalEditarAlmacen();
        });
}

function cerrarModalEditarAlmacen() {
    document.getElementById('modalEditarAlmacen').style.display = 'none';
    document.getElementById('formEditarAlmacen').reset();
}

function abrirModalCrearProducto() {
    document.getElementById('modalCrearProducto').style.display = 'block';
    generarCodigoProducto();
}

function generarCodigoProducto() {
    // Obtener el próximo código del servidor
    fetch('back/generar_codigo_producto.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('codigo').value = data.codigo;
                document.getElementById('codigo_display').value = data.codigo;
            } else {
                console.error('Error al generar código:', data.message);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });
}

function cerrarModalCrearProducto() {
    document.getElementById('modalCrearProducto').style.display = 'none';
    document.getElementById('formCrearProducto').reset();
    document.getElementById('codigo').value = '';
    document.getElementById('codigo_display').value = '';
}
        
function insertarAlmacen(event) {
    event.preventDefault();
            
    const formData = new FormData(document.getElementById('formAgregar'));
            
    fetch('back/agregar_almacen.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalAgregar();
            window.location.href = 'almacen.php?status=success';
        } else {
            window.location.href = 'almacen.php?status=error&message=' + encodeURIComponent(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        window.location.href = 'almacen.php?status=error&message=Error en la comunicación con el servidor';
    });
}

function crearProducto(event) {
    event.preventDefault();
    
    const formData = new FormData(document.getElementById('formCrearProducto'));
    
    fetch('back/crear_producto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Cerrar modal de crear producto
            cerrarModalCrearProducto();
            
            // Agregar el nuevo producto al select
            const select = document.getElementById('id_producto');
            const option = document.createElement('option');
            option.value = data.id;
            option.text = data.nombre + ' (ID: ' + data.id + ')';
            option.selected = true;
            select.appendChild(option);
            
            // Mostrar mensaje de éxito
            alert('Producto creado exitosamente');
        } else {
            alert('Error al crear el producto: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

function actualizarAlmacen(event) {
    event.preventDefault();
    
    const formData = new FormData(document.getElementById('formEditarAlmacen'));
    
    fetch('back/actualizar_almacen.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            cerrarModalEditarAlmacen();
            window.location.href = 'almacen.php?status=success';
        } else {
            alert('Error al actualizar el registro: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}

function eliminarAlmacen(id) {
    fetch('back/eliminar_almacen.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'id=' + id
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'almacen.php?status=success';
        } else {
            alert('Error al eliminar el registro: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error en la comunicación con el servidor');
    });
}
        
window.onclick = function(event) {
    const modalAgregar = document.getElementById('modalAgregar');
    const modalCrearProducto = document.getElementById('modalCrearProducto');
    const modalEditarAlmacen = document.getElementById('modalEditarAlmacen');
    
    if (event.target == modalAgregar) {
        cerrarModalAgregar();
    }
    
    if (event.target == modalCrearProducto) {
        cerrarModalCrearProducto();
    }
    
    if (event.target == modalEditarAlmacen) {
        cerrarModalEditarAlmacen();
    }
}