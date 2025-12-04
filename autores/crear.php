<?php 
include('../includes/header.php');
include('../includes/navbar.php');
?>

<div class="container mt-4">
  <h2> 👩👨Agregar Autor</h2>

  <form action="procesar.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Foto del Autor</label>
      <input type="file" name="foto_url" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Apellido</label>
      <input type="text" name="apellido" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Nacionalidad</label>
      <input type="text" name="nacionalidad" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Fecha de Nacimiento</label>
      <input type="date" name="fecha_nacimiento" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Biografía</label>
      <textarea name="biografia" rows="3" class="form-control"></textarea>
    </div>

    <button type="submit" name="guardar" class="btn btn-success">Guardar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
