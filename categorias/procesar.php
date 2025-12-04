<?php
include('../config/database.php');

// Crear categoría
if (isset($_POST['guardar'])) {
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $color = $_POST['color_hex'];

  $query = "INSERT INTO categorias (nombre, descripcion, color_hex, created_at)
            VALUES ('$nombre', '$descripcion', '$color', NOW())";
  mysqli_query($conn, $query);

  header("Location: index.php");
  exit();
}

// Actualizar categoría
if (isset($_POST['actualizar'])) {
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];
  $color = $_POST['color_hex'];

  $query = "UPDATE categorias SET 
              nombre='$nombre', 
              descripcion='$descripcion', 
              color_hex='$color'
            WHERE id=$id";
  mysqli_query($conn, $query);

  header("Location: index.php");
  exit();
}
?>
