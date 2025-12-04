<?php
include('../config/database.php');

$id = $_GET['id'] ?? null;
$accion = $_GET['accion'] ?? '';

if ($id && in_array($accion, ['activar', 'inactivar'])) {
  // Determinar nuevo estado
  $nuevoEstado = ($accion == 'activar') ? 'activo' : 'inactivo';

  // Actualizar en la base de datos
  $query = "UPDATE prestamos SET estado = '$nuevoEstado' WHERE id = $id";

  if (mysqli_query($conn, $query)) {
    header("Location: index.php?msg=ok");
    exit;
  } else {
    echo "<script>alert('❌ Error al actualizar el estado.'); window.history.back();</script>";
  }
} else {
  echo "<script>alert('⚠️ Parámetros inválidos.'); window.history.back();</script>";
}
?>
