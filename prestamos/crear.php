<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

// Obtener lista de libros
$libros = mysqli_query($conn, "SELECT id, titulo FROM libros ORDER BY titulo ASC");
?>

<div class="container mt-4">
  <h2>➕ Registrar Préstamo</h2>

  <form action="procesar.php" method="POST">
    <div class="mb-3">
      <label class="form-label">Libro</label>
      <select name="libro_id" class="form-select" required>
        <option value="">Seleccione un libro...</option>
        <?php while($libro = mysqli_fetch_assoc($libros)) { ?>
          <option value="<?= $libro['id'] ?>"><?= $libro['titulo'] ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Nombre del Prestamista</label>
      <input type="text" name="nombre_prestamista" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email del Prestamista</label>
      <input type="email" name="email_prestamista" class="form-control" required>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Fecha de Préstamo</label>
        <input type="date" name="fecha_prestamo" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Fecha Esperada de Devolución</label>
        <input type="date" name="fecha_devolucion_esperada" class="form-control" required>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Notas</label>
      <textarea name="notas" class="form-control" rows="3"></textarea>
    </div>

    <button type="submit" name="guardar" class="btn btn-success">Guardar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
