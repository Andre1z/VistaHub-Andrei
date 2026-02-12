<?php
/* 
  1. Declaraciones y conexión a la base de datos
  - Define las credenciales y crea la conexión MySQLi.
  - Si la conexión falla, detiene la ejecución mostrando el error.
*/
$servername = "localhost";
$username = "prueba";
$password = "prueba123";
$dbname = "prueba"; // Cambia al nombre de tu DB

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    // Si la conexión falla, se muestra el error y se detiene el script.
    die("Conexión fallida: " . $conn->connect_error);
}

/* 
  2. Comprobación del método HTTP
  - Verifica que la petición sea POST antes de procesar datos enviados por formulario.
  - Evita procesar datos si la petición no es la esperada.
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera el email enviado desde el formulario
    $email = $_POST['email'];
    
    /* 
      3. Verificación de existencia previa
      - Prepara una consulta que busca el email tanto en pending_registrations como en users.
      - Usa UNION para combinar resultados y evitar duplicados.
      - Se usan consultas preparadas para mitigar inyección SQL.
    */
    $stmt = $conn->prepare("SELECT id FROM pending_registrations WHERE email = ? UNION SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("ss", $email, $email); // 'ss' = dos strings
    $stmt->execute();
    $result = $stmt->get_result();
    
    /* 
      4. Comprobación del resultado de la verificación
      - Si hay filas, significa que el email ya está en proceso o ya registrado.
      - Se informa al usuario y no se inserta una nueva solicitud.
    */
    if ($result->num_rows > 0) {
        echo "El email ya está registrado o en proceso.";
    } else {
        /* 
          5. Inserción de la solicitud pendiente
          - Prepara e inserta el email en la tabla pending_registrations.
          - Informa del éxito o fallo de la operación.
        */
        $stmt = $conn->prepare("INSERT INTO pending_registrations (email) VALUES (?)");
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            echo "Solicitud enviada. Espera aprobación.";
        } else {
            echo "Error al enviar solicitud.";
        }
    }
    /* 
      6. Cierre del statement
      - Cierra el statement activo para liberar recursos.
      - Si se hubieran usado varios statements, conviene cerrarlos individualmente.
    */
    $stmt->close();
}

/* 
  7. Cierre de la conexión
  - Cierra la conexión a la base de datos al finalizar el script.
*/
$conn->close();
?>