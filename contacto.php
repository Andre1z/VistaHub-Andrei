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
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3461.565052654528!2d-3.6912047905093273!3d40.42990609448063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42288da0e82c27%3A0xeb1c1e744f61fd3f!2sC.%20de%20Caracas%2C%2021%2C%20Chamber%C3%AD%2C%2028010%20Madrid!5e1!3m2!1ses!2ses!4v1774854629621!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
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