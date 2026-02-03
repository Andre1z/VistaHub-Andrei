<?php
// Conexión a la base de datos (ajusta según tu configuración)
$servername = "localhost";
$username = "prueba";
$password = "prueba123";
$dbname = "prueba"; // Cambia al nombre de tu DB

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Verificar si el email ya existe en solicitudes pendientes o usuarios
    $stmt = $conn->prepare("SELECT id FROM pending_registrations WHERE email = ? UNION SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "El email ya está registrado o en proceso.";
    } else {
        // Guardar solicitud pendiente
        $stmt = $conn->prepare("INSERT INTO pending_registrations (email) VALUES (?)");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            echo "Solicitud enviada. Espera aprobación.";
        } else {
            echo "Error al enviar solicitud.";
        }
    }
    $stmt->close();
}
$conn->close();
?>