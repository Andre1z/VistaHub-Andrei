<?php
// Incluir el archivo de conexión a la base de datos
require 'conexion.php';

// Consultar solicitudes pendientes
$sql = "SELECT id, id_empresa, email, created_at FROM pending_registrations WHERE status = 'pending'";
$result = $conexion->query($sql);
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel ="stylesheet" type="text/css" href="css/general.css">
    <link rel="icon" type="image/png" href="../assets/logo.png">
</head>
<body>
    <h1>Solicitudes de Registro Pendientes</h1>
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Email</th>
                <th>Fecha de Solicitud</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['id_empresa']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <a href="approve_registration.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Aprobar esta solicitud?')">Aprobar</a>
                        <a href="reject_registration.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Rechazar esta solicitud?')">Rechazar</a>
                    </td>
                    
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No hay solicitudes pendientes.</p>
    <?php endif; ?>
    <?php $conexion->close(); ?>
</body>
</html>