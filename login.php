<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'i18n.php';
require 'back/conexion.php';

$error = '';
$currentLang = $_SESSION['language'] ?? ($_COOKIE['language'] ?? 'es');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $language = validarIdioma($_POST['language'] ?? 'es');
    setcookie('language', $language, time() + 60 * 60 * 24 * 30, '/');
    $_COOKIE['language'] = $language;
    $_SESSION['language'] = $language;
    $currentLang = $language;

    if (!$email || empty($password)) {
        $error = 'Debes ingresar un email y una contraseña válidos.';
    } else {
        $stmt = $conexion->prepare('SELECT id, password FROM users WHERE email = ? LIMIT 1');

        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $row = $result->fetch_assoc()) {
                $storedPassword = $row['password'];
                $isValidPassword = password_verify($password, $storedPassword) || $password === $storedPassword;

                if ($isValidPassword) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_email'] = $email;
                    header('Location: index.php');
                    exit();
                }
            }

            $error = 'Email o contraseña incorrectos.';
            $stmt->close();
        } else {
            $error = 'Error interno. Por favor inténtalo de nuevo más tarde.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($currentLang, ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo __('login'); ?></title>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <div class="form-container">
        <img src="assets/vistahub.png" alt="50x50" height="100" width="250">
        <h2><?php echo __('login'); ?></h2>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="email" name="username" placeholder="<?php echo __('email'); ?>" required>
            <input type="password" name="password" placeholder="<?php echo __('password'); ?>" required>
            <label for="lenguages"><?php echo __('language_selection'); ?></label>
            <select id="lenguages" name="language" required>
                <option value="en"<?php echo $currentLang === 'en' ? ' selected' : ''; ?>>English</option>
                <option value="es"<?php echo $currentLang === 'es' ? ' selected' : ''; ?>>Español</option>
                <option value="fr"<?php echo $currentLang === 'fr' ? ' selected' : ''; ?>>Français</option>
                <option value="de"<?php echo $currentLang === 'de' ? ' selected' : ''; ?>>Deutsch</option>
                <option value="ru"<?php echo $currentLang === 'ru' ? ' selected' : ''; ?>>Русский</option>
                <option value="pt"<?php echo $currentLang === 'pt' ? ' selected' : ''; ?>>Português</option>
                <option value="it"<?php echo $currentLang === 'it' ? ' selected' : ''; ?>>Italiano</option>
                <option value="pl"<?php echo $currentLang === 'pl' ? ' selected' : ''; ?>>Polski</option>
                <option value="el"<?php echo $currentLang === 'el' ? ' selected' : ''; ?>>Ελληνικά</option>
                <option value="ar"<?php echo $currentLang === 'ar' ? ' selected' : ''; ?>>العربية</option>
            </select>
            <button type="submit"><?php echo __('enter'); ?></button>
        </form>
        <p><?php echo __('no_account'); ?> <a href="register.php"><?php echo __('register_here'); ?></a></p>
    </div>
</body>
</html>