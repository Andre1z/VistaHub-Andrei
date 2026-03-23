<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <h1>Registro de Usuarios</h1>
    <form method="POST" action="back/register_user.php">
        <label for="CIF">CIF/NIF/NIE:</label><br>
        <input type="text" id="CIF" name="CIF" required><br>
        <label for="SOCIAL">Nombre o Razón Social:</label><br>
        <input type="text" id="SOCIAL" name="SOCIAL" required><br>
        <label for="DOMICILIO">Domicilio:</label><br>
        <input type="text" id="DOMICILIO" name="DOMICILIO" required><br>
        <label for="MUNICIPIO">Municipio:</label><br>
        <input type="text" id="MUNICIPIO" name="MUNICIPIO" required><br>
        <label for="CP">Codigo Postal:</label><br>
        <input type="text" id="CP" name="CP" required><br>
        <label for="PAIS">Pais:</label><br>
        <input type="text" id="PAIS" name="PAIS" required><br>
        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="phone">Teléfono:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>
        <label for="privacity">Acuerdo de Privacidad:</label><br>
        <input type="checkbox" id="privacity" name="privacity" required>He leído y acepto la <span><a href="privacidad.html" target="_blank">política de privacidad</a></span>.<br><br>
        <button type="submit">Enviar Solicitud de Registro</button>
    </form>
</body>
</html>