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
            <p class="error-message"></p>
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