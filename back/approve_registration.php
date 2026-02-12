<?php
/* 
  1. Declaraciones y conexión a la base de datos
  - Crea la conexión MySQLi con host, usuario, contraseña y base de datos.
  - Verifica si la conexión falló y detiene la ejecución en caso de error.
*/
$conn = new mysqli("localhost", "prueba", "prueba123", "prueba");
if ($conn->connect_error) {
    // Si la conexión falla, se muestra el error y se detiene el script.
    die("Conexión fallida: " . $conn->connect_error);
}

/* 
  2. Comprobación de parámetro de entrada
  - Comprueba que el parámetro 'id' viene por GET (identificador de la solicitud pendiente).
  - Si no existe, no se realiza ninguna acción.
*/
if (isset($_GET['id'])) {
    // Guardar el id recibido (se enlaza como entero más abajo).
    $id = $_GET['id'];
    
    /* 
      3. Preparar y ejecutar SELECT para obtener el email
      - Consulta parametrizada para evitar inyección SQL.
      - Busca la fila con el id dado y estado 'pending'.
    */
    $stmt = $conn->prepare("SELECT email FROM pending_registrations WHERE id = ? AND status = 'pending'");
    $stmt->bind_param("i", $id); // 'i' indica entero
    $stmt->execute();
    $result = $stmt->get_result();
    
    /* 
      4. Comprobación del resultado
      - Si existe la fila (num_rows > 0) se continúa; si no, se informa que no existe o ya fue aprobada.
    */
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email']; // Email recuperado de la solicitud pendiente
        
        /* 
          5. Generación de contraseña aleatoria
          - Se genera una contraseña temporal con bin2hex(random_bytes(6)) → 12 caracteres hex.
          - Nota: los caracteres son hexadecimales (0-9, a-f).
        */
        $password = bin2hex(random_bytes(6)); // 12 caracteres hexadecimales
        
        /* 
          6. Hash de la contraseña y registro del usuario
          - Se hashea la contraseña con password_hash() antes de almacenarla.
          - Inserta un nuevo registro en la tabla 'users' con email y contraseña hasheada.
        */
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashed_password); // 'ss' = dos strings
        
        if ($stmt->execute()) {
            /* 
              7. Actualizar el estado de la solicitud
              - Marca la solicitud como 'approved' para evitar reprocesos.
              - Se usa otra consulta preparada con el mismo $id.
            */
            $stmt = $conn->prepare("UPDATE pending_registrations SET status = 'approved' WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            /* 
              8. Envío de correo con la contraseña
              - Construye asunto, mensaje y cabeceras básicas.
              - Usa mail() para enviar el correo; en producción conviene usar PHPMailer u otra librería.
              - IMPORTANTE: enviar contraseñas en texto plano es inseguro (ver sección de mejoras).
            */
            $subject = "Registro Aprobado - Tu Contraseña";
            $message = "Tu registro ha sido aprobado. Tu contraseña es: $password\nInicia sesión con tu email y esta contraseña.";
            $headers = "From: bugaandrei1@gmail.com"; // Cambiar por un remitente del dominio
            
            if (mail($email, $subject, $message, $headers)) {
                // Éxito: usuario creado y correo enviado
                echo "Usuario registrado y correo enviado.";
            } else {
                // Usuario creado pero fallo al enviar correo
                echo "Usuario registrado, pero error al enviar correo.";
            }
        } else {
            // Error al insertar el usuario en la tabla users (p. ej. duplicado)
            echo "Error al registrar usuario.";
        }
    } else {
        // No existe la solicitud con ese id y estado 'pending'
        echo "Solicitud no encontrada o ya aprobada.";
    }
    
    /* 
      9. Cierre de recursos
      - Cierra el statement activo.
      - Si se hubieran usado varios statements, conviene cerrarlos individualmente.
    */
    $stmt->close();
}

/* 
  10. Cierre de la conexión
  - Cierra la conexión a la base de datos al finalizar.
*/
$conn->close();
?>