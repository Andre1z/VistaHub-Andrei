<?php
// Conexión a la DB (igual que arriba)
$conn = new mysqli("localhost", "prueba", "prueba123", "prueba");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) { // ID de la solicitud pendiente
    $id = $_GET['id'];
    
    // Obtener email de la solicitud
    $stmt = $conn->prepare("SELECT email FROM pending_registrations WHERE id = ? AND status = 'pending'");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        
        // Generar contraseña aleatoria (12 caracteres)
        $password = bin2hex(random_bytes(6)); // Ajusta la longitud si es necesario
        
        // Registrar usuario (asume tabla users con email y password hash)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashed_password);
        if ($stmt->execute()) {
            // Actualizar solicitud a approved
            $stmt = $conn->prepare("UPDATE pending_registrations SET status = 'approved' WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            // Enviar correo con la contraseña
            $subject = "Registro Aprobado - Tu Contraseña";
            $message = "Tu registro ha sido aprobado. Tu contraseña es: $password\nInicia sesión con tu email y esta contraseña.";
            $headers = "From: bugaandrei1@gmail.com"; // Cambia a tu dominio
            
            if (mail($email, $subject, $message, $headers)) {
                echo "Usuario registrado y correo enviado.";
            } else {
                echo "Usuario registrado, pero error al enviar correo.";
            }
        } else {
            echo "Error al registrar usuario.";
        }
    } else {
        echo "Solicitud no encontrada o ya aprobada.";
    }
    $stmt->close();
}
$conn->close();
?>