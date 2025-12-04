<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

// Obtener libro por ID
$id = $_GET['id'];
$query = "SELECT * FROM libros WHERE id = $id";
$result = mysqli_query($conn, $query);
$libro = mysqli_fetch_assoc($result);

// Obtener autores y categorías
$autores = mysqli_query($conn, "SELECT * FROM autores ORDER BY nombre ASC");
$categorias = mysqli_query($conn, "SELECT * FROM categorias ORDER BY nombre ASC");
?>

<div class="container mt-4">
  <h2>✏️ Editar Libro</h2>

  <form action="procesar.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $libro['id'] ?>">

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($libro['titulo']) ?>" required>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">ISBN</label>
        <input type="text" name="isbn" class="form-control" maxlength="13" value="<?= htmlspecialchars($libro['isbn']) ?>" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Autor</label>
        <select name="autor_id" class="form-select" required>
          <?php while ($autor = mysqli_fetch_assoc($autores)) { ?>
            <option value="<?= $autor['id'] ?>" <?= $autor['id'] == $libro['autor_id'] ? 'selected' : '' ?>>
              <?= $autor['nombre'] . ' ' . $autor['apellido'] ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Categoría</label>
        <select name="categoria_id" class="form-select" required>
          <?php while ($cat = mysqli_fetch_assoc($categorias)) { ?>
            <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $libro['categoria_id'] ? 'selected' : '' ?>>
              <?= $cat['nombre'] ?>
            </option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Año de publicación</label>
      <input type="number" name="año_publicacion" class="form-control" value="<?= htmlspecialchars($libro['año_publicacion']) ?>" min="1800" max="2099">
    </div>

    <div class="mb-3">
      <label class="form-label">Condición del libro</label>
      <select name="condicion" class="form-select">
       <option value="nuevo" <?= $libro['condicion'] == 'nuevo' ? 'selected' : '' ?>>Nuevo</option>
       <option value="usado" <?= $libro['condicion'] == 'usado' ? 'selected' : '' ?>>Usado</option>
       <option value="dañado" <?= $libro['condicion'] == 'dañado' ? 'selected' : '' ?>>Dañado</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($libro['descripcion']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Portada actual:</label><br>
      <?php if ($libro['portada_url']) { ?>
        <img src="../<?= $libro['portada_url'] ?>" width="120" class="rounded shadow-sm mb-2">
      <?php } else { ?>
        <span class="text-muted">Sin portada</span>
      <?php } ?>
      <br>
      <label class="form-label mt-2">Nueva portada (opcional)</label>
      <input type="file" name="portada" class="form-control" accept="image/*">
    </div>

    <button type="submit" name="actualizar" class="btn btn-warning">Actualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include('../includes/footer.php'); ?>
