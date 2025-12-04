<?php
// functions/functions.php

// Conectar la base de datos (usa tu config existente)
require_once __DIR__ . '/../config/database.php';

/**
 * Mostrar alertas Bootstrap dinámicamente.
 */
function mostrarAlerta($mensaje, $tipo = 'success') {
  echo "<div class='alert alert-$tipo alert-dismissible fade show' role='alert'>
          $mensaje
          <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>";
}

/**
 * Contar registros de una tabla (para dashboard u otras estadísticas)
 */
function contarRegistros($tabla) {
  global $conn;
  $query = "SELECT COUNT(*) AS total FROM $tabla";
  $resultado = mysqli_query($conn, $query);
  $fila = mysqli_fetch_assoc($resultado);
  return $fila['total'] ?? 0;
}

/**
 * Formatear fecha a formato legible (ejemplo: 2025-11-09 → 09/11/2025)
 */
function formatearFecha($fecha) {
  return date("d/m/Y", strtotime($fecha));
}
?>
