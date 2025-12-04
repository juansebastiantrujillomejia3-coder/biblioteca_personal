<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

// Traer autores y categorías
$autores = mysqli_query($conn, "SELECT * FROM autores ORDER BY nombre ASC");
$categorias = mysqli_query($conn, "SELECT * FROM categorias ORDER BY nombre ASC");
?>

<div class="container mt-4">
  <h2>➕ Agregar Libro</h2>

  <form action="procesar.php" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">ISBN</label>
        <input type="text" name="isbn" class="form-control" maxlength="13" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Autor</label>
        <select name="autor_id" class="form-select" required>
          <option value="">Seleccione...</option>
          <?php while($autor = mysqli_fetch_assoc($autores)) { ?>
            <option value="<?= $autor['id'] ?>"><?= $autor['nombre'] . ' ' . $autor['apellido'] ?></option>
          <?php } ?>
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Categoría</label>
        <select name="categoria_id" class="form-select" required>
          <option value="">Seleccione...</option>
          <?php while($cat = mysqli_fetch_assoc($categorias)) { ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['nombre'] ?></option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Año de publicación
      <input type="number" name="año_publicacion" class="form-control" min="1800" max="2099">
    </div>

    <div class="mb-3">
      <label class="form-label">Estado
      <select name="estado" class="form-select">
        <option value="nuevo">Nuevo</option>
        <option value="usado">Usado</option>
        <option value="dañado">Dañado</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Portada (imagen)</label>
      <input type="file" name="portada" class="form-control" accept="image/*">
    </div>

    <button type="submit" name="guardar" class="btn btn-success">Guardar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
