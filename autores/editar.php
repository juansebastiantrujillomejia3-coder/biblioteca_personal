<?php 
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

// Obtener ID
$id = $_GET['id'];
$query = "SELECT * FROM autores WHERE id = $id";
$result = mysqli_query($conn, $query);
$autor = mysqli_fetch_assoc($result);
?>

<div class="container mt-4">
  <h2>✏ Editar Autor</h2>

  <form action="procesar.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $autor['id'] ?>">

    <!-- Mostrar foto actual -->
    <div class="mb-3">
      <label class="form-label">Foto actual:</label><br>

      <?php if (!empty($autor['foto_url'])) { ?>
        <img src="../uploads/autores/<?= $autor['foto_url'] ?>" 
             width="120" height="120" 
             style="border-radius:10px; object-fit:cover;">
      <?php } else { ?>
        <p class="text-muted">Sin foto</p>
      <?php } ?>
    </div>

    <!-- Subir nueva foto -->
    <div class="mb-3">
      <label class="form-label">Cambiar foto del autor</label>
      <input type="file" name="foto_url" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre" value="<?= $autor['nombre'] ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Apellido</label>
      <input type="text" name="apellido" value="<?= $autor['apellido'] ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Nacionalidad</label>
      <input type="text" name="nacionalidad" value="<?= $autor['nacionalidad'] ?>" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Fecha de Nacimiento</label>
      <input type="date" name="fecha_nacimiento" value="<?= $autor['fecha_nacimiento'] ?>" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Biografía</label>
      <textarea name="biografia" rows="3" class="form-control"><?= $autor['biografia'] ?></textarea>
    </div>

    <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>

  </form>
</div>

<?php include('../includes/footer.php'); ?>
