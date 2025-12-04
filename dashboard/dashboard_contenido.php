<?php
include(__DIR__ . '/../config/database.php');

// Totales simples
$totalAutores     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM autores"))['total'];
$totalLibros      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM libros"))['total'];
$totalCategorias  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM categorias"))['total'];
$totalPrestamos   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM prestamos"))['total'];

// Libros activos / inactivos
$librosActivos    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM libros WHERE estado='activo'"))['total'];
$librosInactivos  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM libros WHERE estado='inactivo'"))['total'];

// Préstamos activos / devueltos / vencidos
$prestamosActivos   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM prestamos WHERE estado='activo'"))['total'];
$prestamosDevueltos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM prestamos WHERE estado='devuelto'"))['total'];
$prestamosVencidos  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM prestamos WHERE estado='vencido'"))['total'];

// Libros por categoría
$categoriasQuery = mysqli_query($conn, "
  SELECT categorias.nombre AS categoria, COUNT(libros.id) AS total
  FROM categorias
  LEFT JOIN libros ON libros.categoria_id = categorias.id
  GROUP BY categorias.nombre
");
?>

<div class="container mt-5">

  <h2 class="text-center mb-4">📊 Estadísticas Generales</h2>

  <!-- Fila 1 -->
  <div class="row g-4">
    <div class="col-md-3">
      <div class="dashboard-card bg-dashboard-blue">
        <h3>Autores</h3>
        <p><?= $totalAutores ?> registrados</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="dashboard-card bg-dashboard-green">
        <h3>Libros</h3>
        <p><?= $totalLibros ?> registrados</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="dashboard-card bg-dashboard-purple">
        <h3>Categorías</h3>
        <p><?= $totalCategorias ?> registradas</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="dashboard-card bg-dashboard-blue">
        <h3>Préstamos</h3>
        <p><?= $totalPrestamos ?> totales</p>
      </div>
    </div>
  </div> <!-- ← AQUÍ SE CIERRA LA FILA -->

  <!-- Fila 2 -->
  <div class="row g-4 mt-4">
    <div class="col-md-6">
      <div class="dashboard-card">
        <h4>📙 Libros por Estado</h4>
        <p><strong>Activos:</strong> <?= $librosActivos ?></p>
        <p><strong>Inactivos:</strong> <?= $librosInactivos ?></p>
      </div>
    </div>

    <div class="col-md-6">
      <div class="dashboard-card">
        <h4>🔁 Préstamos por Estado</h4>
        <p><strong>Activos:</strong> <?= $prestamosActivos ?></p>
        <p><strong>Devueltos:</strong> <?= $prestamosDevueltos ?></p>
        <p><strong>Vencidos:</strong> <?= $prestamosVencidos ?></p>
      </div>
    </div>
  </div>

  <!-- Fila 3 -->
  <div class="row g-4 mt-4">
    <div class="col-md-12">
      <div class="dashboard-card">
        <h4>📂 Libros por Categoría</h4>
        <ul>
          <?php while ($c = mysqli_fetch_assoc($categoriasQuery)) { ?>
            <li><strong><?= $c['categoria'] ?>:</strong> <?= $c['total'] ?> libros</li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>

</div>
