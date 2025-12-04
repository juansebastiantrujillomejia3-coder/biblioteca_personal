<?php 
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

// Consultar todos los autores
$query = "SELECT * FROM autores ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>👨‍💻 Lista de Autores</h2>
    <a href="crear.php" class="btn btn-primary">+ Agregar Autor</a>
  </div>

  <table class="table table-striped align-middle text-center">
    <thead class="table-dark">
      <tr>
        <th>Foto</th>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Nacionalidad</th>
        <th>Fecha Nacimiento</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while($autor = mysqli_fetch_assoc($result)) { ?>
      <tr>

        <!-- Mostrar foto -->
        <td>
          <?php if (!empty($autor['foto_url'])) { ?>
            <img src="../uploads/autores/<?= $autor['foto_url'] ?>" 
                 width="55" height="55" 
                 style="border-radius: 50%; object-fit: cover;">
          <?php } else { ?>
            <span class="text-muted">Sin foto</span>
          <?php } ?>
        </td>

        <td><?= $autor['id'] ?></td>
        <td><?= htmlspecialchars($autor['nombre']) ?></td>
        <td><?= htmlspecialchars($autor['apellido']) ?></td>
        <td><?= htmlspecialchars($autor['nacionalidad']) ?></td>
        <td><?= htmlspecialchars($autor['fecha_nacimiento']) ?></td>

        <!-- Estado -->
        <td>
          <?php if ($autor['estado'] == 'activo') : ?>
            <span class="badge bg-success">Activo</span>
          <?php else : ?>
            <span class="badge bg-secondary">Inactivo</span>
          <?php endif; ?>
        </td>

        <!-- Acciones -->
        <td>
          <div class="btn-group">
            <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
              Opciones
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-info" href="ver.php?id=<?= $autor['id'] ?>">👁 Ver</a></li>
              <li><a class="dropdown-item text-warning" href="editar.php?id=<?= $autor['id'] ?>">✏ Editar</a></li>

              <?php if ($autor['estado'] == 'activo') : ?>
                <li><a class="dropdown-item text-danger" href="procesar_estado.php?id=<?= $autor['id'] ?>&accion=inactivar">🚫 Inactivar</a></li>
              <?php else : ?>
                <li><a class="dropdown-item text-success" href="procesar_estado.php?id=<?= $autor['id'] ?>&accion=activar">✅ Activar</a></li>
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
