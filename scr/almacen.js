function abrirModalAgregar() {
    document.getElementById('modalAgregar').style.display = 'block';
}
        
function cerrarModalAgregar() {
    document.getElementById('modalAgregar').style.display = 'none';
    document.getElementById('formAgregar').reset();
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
        
window.onclick = function(event) {
    const modal = document.getElementById('modalAgregar');
    if (event.target == modal) {
        cerrarModalAgregar();
    }
}