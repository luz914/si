<?php
// db_config.php

$servername = "localhost"; // Generalmente 'localhost' para XAMPP
$username = "root";        // El usuario por defecto de MySQL en XAMPP
$password = "";            // La contraseña por defecto de MySQL en XAMPP es vacía
$dbname = "karate_do_toyama"; // El nombre de la base de datos que creaste

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}
// Opcional: Para verificar que la conexión es exitosa al inicio
// echo "Conexión exitosa a la base de datos."; 
?>