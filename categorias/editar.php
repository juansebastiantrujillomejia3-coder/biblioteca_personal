<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

$id = $_GET['id'];
$query = "SELECT * FROM categorias WHERE id=$id";
$result = mysqli_query($conn, $query);
$categoria = mysqli_fetch_assoc($result);
?>

<div class="container mt-4">
  <h2>✏️ Editar Categoría</h2>

  <form action="procesar.php" method="POST">
    <input type="hidden" name="id" value="<?= $categoria['id'] ?>">

    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($categoria['nombre']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($categoria['descripcion']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Color</label>
      <input type="color" name="color_hex" class="form-control form-control-color" value="<?= htmlspecialchars($categoria['color_hex']) ?>">
    </div>

    <button type="submit" name="actualizar" class="btn btn-warning">Actualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
