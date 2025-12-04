<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

$id = $_GET['id'];
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
  <h2>✏️ Editar Préstamo</h2>

  <form action="procesar.php" method="POST">
    <input type="hidden" name="id" value="<?= $prestamo['id'] ?>">

    <div class="mb-3">
      <label class="form-label">Libro:</label>
      <input type="text" class="form-control" value="<?= htmlspecialchars($prestamo['libro_titulo']) ?>" readonly>
    </div>

    <div class="mb-3">
      <label class="form-label">Prestamista:</label>
      <input type="text" class="form-control" value="<?= htmlspecialchars($prestamo['nombre_prestamista']) ?>" readonly>
    </div>

    <div class="mb-3">
      <label class="form-label">Estado</label>
      <select name="estado" class="form-select">
        <option value="activo" <?= $prestamo['estado'] == 'activo' ? 'selected' : '' ?>>Activo</option>
        <option value="devuelto" <?= $prestamo['estado'] == 'devuelto' ? 'selected' : '' ?>>Devuelto</option>
        <option value="vencido" <?= $prestamo['estado'] == 'vencido' ? 'selected' : '' ?>>Vencido</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Fecha de Devolución Real</label>
      <input type="date" name="fecha_devolucion_real" class="form-control" value="<?= $prestamo['fecha_devolucion_real'] ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Notas</label>
      <textarea name="notas" class="form-control" rows="3"><?= htmlspecialchars($prestamo['notas']) ?></textarea>
    </div>

    <button type="submit" name="actualizar" class="btn btn-warning">Actualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
