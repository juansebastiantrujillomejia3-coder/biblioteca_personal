<?php
include('../config/database.php');

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Marcar el préstamo como devuelto y guardar fecha de hoy
  $fechaHoy = date('Y-m-d');
  $query = "UPDATE prestamos 
            SET estado='devuelto', fecha_devolucion_real='$fechaHoy'
            WHERE id = $id";
  mysqli_query($conn, $query);
}

header("Location: index.php");
exit();
?>
