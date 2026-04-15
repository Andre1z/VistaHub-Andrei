<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'back/conexion.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Hub</title>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <div class="form-container">
        <img src="assets/vistahub.png" alt="50x50" height="100" width="250">
        <h2>Iniciar sesión</h2>
        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="email" name="username" placeholder="Email" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <label for="lenguages">Idiomas</label>
            <select id="lenguages" name="language" required>
                <option value="en">English</option>
                <option value="es">Español</option>
                <option value="fr">Français</option>
                <option value="de">Deutsch</option>
                <option value="ru">Русский</option>
                <option value="pt">Português</option>
                <option value="it">Italiano</option>
                <option value="pl">Polski</option>
                <option value="el">Ελληνικά</option>
                <option value="ar">العربية</option>
            </select>
            <button type="submit">Entrar</button>
        </form>
        <p>¿No tiene cuenta? <a href="register.php">Regístrate aquí</a></p>
    </div>
</body>
</html>