<?php
include('../config/database.php');


// ===============================
//  CREAR PRÉSTAMO
// ===============================
if (isset($_POST['guardar'])) {

  $libro_id = $_POST['libro_id'];
  $nombre = $_POST['nombre_prestamista'];
  $email = $_POST['email_prestamista'];
  $fecha_prestamo = $_POST['fecha_prestamo'];
  $fecha_dev_esp = $_POST['fecha_devolucion_esperada'];
  $notas = $_POST['notas'];

  $query = "INSERT INTO prestamos (
              libro_id, 
              nombre_prestamista, 
              email_prestamista, 
              fecha_prestamo, 
              fecha_devolucion_esperada, 
              estado, 
              notas
            )
            VALUES (
              '$libro_id', 
              '$nombre', 
              '$email', 
              '$fecha_prestamo', 
              '$fecha_dev_esp',
              'activo',
              '$notas'
            )";

  mysqli_query($conn, $query);
  header("Location: index.php");
  exit();
}



// ===============================
//  ACTUALIZAR PRÉSTAMO
// ===============================
if (isset($_POST['actualizar'])) {

  $id = $_POST['id'];
  $libro_id = $_POST['libro_id'];
  $nombre = $_POST['nombre_prestamista'];
  $email = $_POST['email_prestamista'];
  $fecha_prestamo = $_POST['fecha_prestamo'];
  $fecha_dev_esp = $_POST['fecha_devolucion_esperada'];

  // Si no ponen fecha real, debe quedar en NULL
  $fecha_real = !empty($_POST['fecha_devolucion_real']) 
                ? "'" . $_POST['fecha_devolucion_real'] . "'" 
                : "NULL";

  $estado = $_POST['estado'];
  $notas = $_POST['notas'];

  $query = "UPDATE prestamos SET
              libro_id = '$libro_id',
              nombre_prestamista = '$nombre',
              email_prestamista = '$email',
              fecha_prestamo = '$fecha_prestamo',
              fecha_devolucion_esperada = '$fecha_dev_esp',
              fecha_devolucion_real = $fecha_real,
              estado = '$estado',
              notas = '$notas'
            WHERE id = $id";

  mysqli_query($conn, $query);
  header("Location: index.php");
  exit();
}

?>
