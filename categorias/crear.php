<?php
include('../includes/header.php');
include('../includes/navbar.php');
?>

<div class="container mt-4">
  <h2>➕ Agregar Categoría</h2>

  <form action="procesar.php" method="POST">
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Color (hexadecimal)</label>
      <input type="color" name="color_hex" class="form-control form-control-color" value="#007bff">
    </div>

    <button type="submit" name="guardar" class="btn btn-success">Guardar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
