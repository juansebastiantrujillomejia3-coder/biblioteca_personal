<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

if (!isset($_GET['id'])) {
  echo "<div class='container mt-5'><div class='alert alert-danger'>❌ ID del préstamo no especificado.</div></div>";
  include('../includes/footer.php');
  exit();
}

$id = intval($_GET['id']);
$query = "
  SELECT prestamos.*, libros.titulo AS libro_titulo
  FROM prestamos
  LEFT JOIN libros ON prestamos.libro_id = libros.id
  WHERE prestamos.id = $id
";
$result = mysqli_query($conn, $query);
$prestamo = mysqli_fetch_assoc($result);
?>

<div class="container mt-4">
  <h2>📄 Detalle del Préstamo</h2>
  <hr>

  <p><strong>Libro:</strong> <?= htmlspecialchars($prestamo['libro_titulo']) ?></p>
  <p><strong>Prestamista:</strong> <?= htmlspecialchars($prestamo['nombre_prestamista']) ?></p>
  <p><strong>Email:</strong> <?= htmlspecialchars($prestamo['email_prestamista']) ?></p>
  <p><strong>Fecha de préstamo:</strong> <?= htmlspecialchars($prestamo['fecha_prestamo']) ?></p>
  <p><strong>Fecha esperada de devolución:</strong> <?= htmlspecialchars($prestamo['fecha_devolucion_esperada']) ?></p>
  <p><strong>Fecha real de devolución:</strong> <?= htmlspecialchars($prestamo['fecha_devolucion_real'] ?? '—') ?></p>
  <p><strong>Estado:</strong> <?= htmlspecialchars($prestamo['estado']) ?></p>
  <p><strong>Notas:</strong><br><?= nl2br(htmlspecialchars($prestamo['notas'])) ?></p>

  <a href="index.php" class="btn btn-secondary mt-3">⬅ Volver a la lista</a>
</div>

<?php include('../includes/footer.php'); ?>
