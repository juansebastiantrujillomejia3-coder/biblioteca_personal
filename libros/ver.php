<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

if (!isset($_GET['id'])) {
  echo "<div class='container mt-5'><div class='alert alert-danger'>❌ ID del libro no especificado.</div></div>";
  include('../includes/footer.php');
  exit();
}

$id = intval($_GET['id']);
$query = "
  SELECT libros.*, autores.nombre AS autor_nombre, autores.apellido AS autor_apellido, categorias.nombre AS categoria_nombre
  FROM libros
  LEFT JOIN autores ON libros.autor_id = autores.id
  LEFT JOIN categorias ON libros.categoria_id = categorias.id
  WHERE libros.id = $id
";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
  echo "<div class='container mt-5'><div class='alert alert-warning'>⚠️ Libro no encontrado.</div></div>";
  include('../includes/footer.php');
  exit();
}

$libro = mysqli_fetch_assoc($result);
?>

<div class="container mt-4">
  <h2>📖 Detalle del Libro</h2>
  <hr>

  <div class="row">
    <div class="col-md-4">
      <?php if ($libro['portada_url']) { ?>
        <img src="/biblioteca_personal/<?= $libro['portada_url'] ?>" alt="Portada" class="img-fluid rounded shadow-sm">
      <?php } else { ?>
        <div class="alert alert-secondary text-center">Sin imagen</div>
      <?php } ?>
    </div>

    <div class="col-md-8">
      <h4><?= htmlspecialchars($libro['titulo']) ?></h4>
      <p><strong>Autor:</strong> <?= htmlspecialchars($libro['autor_nombre'] . ' ' . $libro['autor_apellido']) ?></p>
      <p><strong>Categoría:</strong> <?= htmlspecialchars($libro['categoria_nombre']) ?></p>
      <p><strong>ISBN:</strong> <?= htmlspecialchars($libro['isbn']) ?></p>
      <p><strong>Año:</strong> <?= htmlspecialchars($libro['año_publicacion']) ?></p>
      <p><strong>Estado:</strong> <?= htmlspecialchars($libro['estado']) ?></p>
      <p><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($libro['descripcion'])) ?></p>
    </div>
  </div>

  <a href="index.php" class="btn btn-secondary mt-4">👈 Volver a la lista</a>
</div>

<?php include('../includes/footer.php'); ?>
