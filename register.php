<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h1>Registro de Usuarios</h1>
    <form method="POST" action="back/register_user.php">
        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <!-- Campo de contraseña removido, se generará al aceptar -->
        
        <button type="submit">Enviar Solicitud de Registro</button>
    </form>
</body>
</html>