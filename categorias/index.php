<?php 
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

// Consultar todas las categorías
$query = "SELECT * FROM categorias ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📂 Lista de Categorías</h2>
    <a href="crear.php" class="btn btn-primary">+ Agregar Categoría</a>
  </div>

  <table class="table table-striped align-middle text-center">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Color</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while($cat = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= $cat['id'] ?></td>
        <td><?= htmlspecialchars($cat['nombre']) ?></td>
        <td><?= htmlspecialchars($cat['descripcion']) ?></td>
        <td>
          <span class="badge rounded-pill" style="background-color: <?= $cat['color_hex'] ?>;">&nbsp;</span>
        </td>

        <!-- Estado -->
        <td>
          <?php if ($cat['estado'] == 'activo') : ?>
            <span class="badge bg-success">Activo</span>
          <?php else : ?>
            <span class="badge bg-secondary">Inactivo</span>
          <?php endif; ?>
        </td>

        <!-- Menú de opciones -->
        <td>
          <div class="btn-group">
            <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
              ⚙️ Opciones
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-warning" href="editar.php?id=<?= $cat['id'] ?>">✏️ Editar</a></li>
              
              <?php if ($cat['estado'] == 'activo') : ?>
                <li><a class="dropdown-item text-danger" href="procesar_estado.php?id=<?= $cat['id'] ?>&accion=inactivar">🚫 Inactivar</a></li>
              <?php else : ?>
                <li><a class="dropdown-item text-success" href="procesar_estado.php?id=<?= $cat['id'] ?>&accion=activar">✅ Activar</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include('../includes/footer.php'); ?>
