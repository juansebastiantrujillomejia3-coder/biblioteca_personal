<?php
$servername = "localhost"; // Significa que la base de datos está en tu computadora (XAMPP)
$username = "root";  // Usuario adm de mysql en el XAMPP 
$password = "";      // Contraseña (vacía por defecto)
$database = "biblioteca_personal"; // Nombre de tu base de datos 

$conn = mysqli_connect($servername, $username, $password, $database); // Aquí PHP intenta 
// conectarse a MySQL con esos datos.

if (!$conn) {
  die("Error de conexión: " . mysqli_connect_error()); // Si la conexión falló
  //  (por ejemplo si MySQL está apagado),la página se detiene y muestra el error.
}
?> 
