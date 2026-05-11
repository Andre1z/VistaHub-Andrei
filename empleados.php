<?php
    require 'back/conexion.php';
    require_once 'i18n.php';
    $sql = "SELECT e.id, e.id_empresa, emp.nombre AS empresa_nombre, e.nombre, e.apellidos, e.dni, e.telefono, e.email, e.puesto, e.departamento, e.salario, e.fecha_contratacion, e.estado, e.direccion, e.ciudad, e.codigo_postal, e.created_at FROM empleados e LEFT JOIN empresas emp ON e.id_empresa = emp.id ORDER BY e.id";
    $result = $conexion->query($sql);
    $sqlEmpresas = "SELECT id, nombre FROM empresas ORDER BY nombre";
    $resultEmpresas = $conexion->query($sqlEmpresas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Hub - Empleados</title>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/empleados.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <?php include 'header.php'; ?>
    <h2>Empleados</h2>
    <button class="agregar-btn" onclick="abrirModalAgregarEmpleado()">Agregar empleado</button>
    <?php if ($result && $result->num_rows > 0): ?>
        <div class="tabla-empleados-contenedor">
            <table class="tabla-empleados">
                <tr>
                    <th>id</th>
                    <th>id Empresa</th>
                    <th>Empresa</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Puesto</th>
                    <th>Departamento</th>
                    <th>Salario</th>
                    <th>Fecha contratación</th>
                    <th>Estado</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Código postal</th>
                    <th>Acciones</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['id_empresa']); ?></td>
                        <td><?php echo htmlspecialchars($row['empresa_nombre'] ?: 'Sin empresa'); ?></td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['apellidos']); ?></td>
                        <td><?php echo htmlspecialchars($row['dni']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['puesto']); ?></td>
                        <td><?php echo htmlspecialchars($row['departamento']); ?></td>
                        <td><?php echo htmlspecialchars($row['salario']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_contratacion']); ?></td>
                        <td><?php echo htmlspecialchars($row['estado']); ?></td>
                        <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($row['ciudad']); ?></td>
                        <td><?php echo htmlspecialchars($row['codigo_postal']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td>
                            <button class="editar-btn" onclick="abrirModalEditarEmpleado(<?php echo $row['id']; ?>)"><img src="assets/editar.svg" alt="Editar"></button>
                            <button class="eliminar-btn" onclick="return confirm('¿Eliminar este empleado?') && eliminarEmpleado(<?php echo $row['id']; ?>)"><img src="assets/eliminar.svg" alt="Eliminar"></button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    <?php else: ?>
        <p>No hay registros de empleados disponibles.</p>
    <?php endif; ?>
    <?php include 'modal_empleados.php'; ?>
    <?php include 'footer.php'; ?>
    <script src="scr/empleados.js"></script>
</body>
</html>