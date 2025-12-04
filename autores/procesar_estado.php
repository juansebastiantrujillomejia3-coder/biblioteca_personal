<?php
include('../config/database.php');

$id = $_GET['id'] ?? null;
$accion = $_GET['accion'] ?? '';

if ($id && in_array($accion, ['activar', 'inactivar'])) {
  $nuevoEstado = ($accion == 'activar') ? 'activo' : 'inactivo';
  $query = "UPDATE autores SET estado = '$nuevoEstado' WHERE id = $id";

  if (mysqli_query($conn, $query)) {
    header("Location: index.php?msg=ok");
  } else {
    echo "<script>alert('❌ Error al actualizar el estado.'); window.history.back();</script>";
  }
} else {
  echo "<script>alert('⚠️ Parámetros inválidos.'); window.history.back();</script>";
}
?>
