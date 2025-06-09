<?php
// Incluye el archivo de configuración de la base de datos
include_once 'db_config.php';

$mensaje = ""; // Variable para almacenar mensajes de éxito o error

// Verifica si el formulario ha sido enviado (cuando el método es POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario de forma segura
    // mysqli_real_escape_string ayuda a prevenir inyecciones SQL
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $cinturon = $conn->real_escape_string($_POST['cinturon']);
    $fecha_nacimiento = $conn->real_escape_string($_POST['fecha_nacimiento']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $email = $conn->real_escape_string($_POST['email']);

    // Prepara la consulta SQL para insertar datos
    // Usamos sentencias preparadas para mayor seguridad (recomendado)
    $stmt = $conn->prepare("INSERT INTO estudiantes (nombre, apellido, cinturon, fecha_nacimiento, telefono, email) VALUES (?, ?, ?, ?, ?, ?)");
    
    // 'ssssss' indica que todos los parámetros son strings
    $stmt->bind_param("ssssss", $nombre, $apellido, $cinturon, $fecha_nacimiento, $telefono, $email);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        $mensaje = "<div style='color: green; text-align: center; margin-top: 20px;'>¡Estudiante agregado exitosamente!</div>";
    } else {
        $mensaje = "<div style='color: red; text-align: center; margin-top: 20px;'>Error al agregar estudiante: " . $stmt->error . "</div>";
    }

    // Cierra la sentencia preparada
    $stmt->close();
}

// Cierra la conexión a la base de datos al final del script
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Estudiante - Karate Do Toyama</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .container-form {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box; /* Asegura que padding no aumente el ancho */
        }
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container-form">
        <h2>Registro de Estudiante de Karate Do</h2>

        <?php echo $mensaje; // Muestra el mensaje de éxito o error ?>

        <form action="agregar_estudiante.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="cinturon">Cinturón:</label>
                <input type="text" id="cinturon" name="cinturon" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>

            <input type="submit" value="Agregar Estudiante">
        </form>
        <a href="index.html" class="back-link">Volver al Inicio</a>
    </div>
</body>
</html>