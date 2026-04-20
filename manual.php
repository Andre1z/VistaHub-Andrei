<?php require_once 'i18n.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($GLOBALS['idiomaActivo'], ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo __('manual_page_title'); ?></title>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/manual.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <?php include 'header.php'; ?>
    <main class="manual-content">
        <h2><?php echo __('user_manual'); ?></h2>
        <p><?php echo __('manual_welcome_text'); ?></p>
        <?php include 'manual_contenido.php'; ?>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>