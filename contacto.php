<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Hub - Contacto</title>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/contacto.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <?php include 'header.php'; ?>
    <h2>Contacto</h2>
    <p>Nos puede contactar a traves de este telefono movil: <a href="tel:+34911234567">+34 911 23 45 67</a> o mediante este formulario:</p>
    <form action="contacto_procesar.php" method="post" class="contact-form">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" required></textarea>
        <button type="submit">Enviar</button>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>