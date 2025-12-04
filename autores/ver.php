<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

// Verificar si viene el ID del autor
if (!isset($_GET['id'])) {
  echo "<div class='container mt-5'><div class='alert alert-danger'>❌ ID de autor no especificado.</div></div>";
  include('../includes/footer.php');
  exit();
}

$id = intval($_GET['id']); // Limpieza de variable por seguridad

// Consultar autor
$query = "SELECT * FROM autores WHERE id = $id";
$result = mysqli_query($conn, $query);

// Verificar si existe el autor
if (!$result || mysqli_num_rows($result) == 0) {
  echo "<div class='container mt-5'><div class='alert alert-warning'>⚠️ No se encontró el autor solicitado.</div></div>";
  include('../includes/footer.php');
  exit();
}

$autor = mysqli_fetch_assoc($result);
?>

<div class="container mt-4">
  <h2>👤 Detalle del Autor</h2>
  <hr>

  <div class="row">
    <div class="col-md-4">
      <?php if ($autor['foto_url']) { ?>
        <img src="/biblioteca_personal/<?= $autor['foto_url'] ?>" alt="foto_url">
      <?php } else { ?>
        <div class="alert alert-secondary text-center">Sin imagen</div>
      <?php } ?>
    </div>



  <div class="card p-4 shadow-sm">
    <h4><?= htmlspecialchars($autor['nombre'] . ' ' . $autor['apellido']) ?></h4>
    <p><strong>Nacionalidad:</strong> <?= htmlspecialchars($autor['nacionalidad']) ?></p>
    <p><strong>Fecha de nacimiento:</strong> <?= htmlspecialchars($autor['fecha_nacimiento']) ?></p>
    <p><strong>Biografía:</strong><br> <?= nl2br(htmlspecialchars($autor['biografia'])) ?></p>
  </div>

  <a href="index.php" class="btn btn-secondary mt-3">⬅ Volver</a>
</div>

<?php include('../includes/footer.php'); ?>