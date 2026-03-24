<?php 
    // Verificamos si la sesión ya está iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verificamos si el usuario ha iniciado sesión
    /*if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Hub</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.3.2/css/flag-icons.min.css" />
</head>
<body>
    <h1>Te damos la Bienvenida a Vista Hub</h1>
    <h2>Menú Principal</h2>
    <div class="flex">
        <?php include 'main.php'; ?>
        <?php include 'footer.php'; ?>
    </div>
    <script src="scr/main.js"></script>
    <script src="scr/footer.js"></script>
</body>
</html>