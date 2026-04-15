<?php 
    // Verificamos si la sesión ya está iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verificamos si el usuario ha iniciado sesión
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    require_once 'i18n.php';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($GLOBALS['idiomaActivo'], ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Hub</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <h1><?php echo __('welcome'); ?></h1>
    <h2><?php echo __('main_menu'); ?></h2>
    <div class="flex">
        <?php include 'main.php'; ?>
        <?php include 'footer.php'; ?>
    </div>
    <script src="scr/main.js"></script>
</body>
</html>