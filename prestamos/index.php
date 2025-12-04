<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

// Consultar préstamos con JOIN para mostrar el título del libro
$query = "
  SELECT prestamos.*, libros.titulo AS libro_titulo
  FROM prestamos
  LEFT JOIN libros ON prestamos.libro_id = libros.id
  ORDER BY prestamos.id DESC
";
$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>🔄 Préstamos de Libros</h2>
    <a href="crear.php" class="btn btn-primary">+ Nuevo Préstamo</a>
  </div>

  <table class="table table-striped">
    <thead>
     <tr>
       <th>ID</th>
       <th>Libro</th>
       <th>Prestamista</th>
       <th>Fecha préstamo</th>
       <th>Fecha devolución esperada</th>
       <th>Fecha devolución real</th>
       <th>Estado préstamo</th>
       <th>Acciones</th>
     </tr> 
    </thead>

      <?php while($p = mysqli_fetch_assoc($result)) { ?>
     <tr>
  <td><?= $p['id'] ?></td>
  <td><?= htmlspecialchars($p['libro_titulo']) ?></td>
  <td><?= htmlspecialchars($p['nombre_prestamista']) ?></td>
  <td><?= htmlspecialchars($p['fecha_prestamo']) ?></td>
  <td><?= htmlspecialchars($p['fecha_devolucion_esperada']) ?></td>

  <!-- Fecha devolución REAL -->
  <td>
    <?= $p['fecha_devolucion_real'] ? htmlspecialchars($p['fecha_devolucion_real']) : '—' ?>
  </td>

  <!-- Estado -->
  <td>
    <?php if ($p['estado'] == 'activo') : ?>
      <span class="badge bg-success">Activo</span>
    <?php elseif ($p['estado'] == 'devuelto') : ?>
      <span class="badge bg-primary">Devuelto</span>
    <?php else : ?>
      <span class="badge bg-danger">Vencido</span>
    <?php endif; ?>
  </td>

  <!-- Acciones -->
  <td>
    <a href="ver.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-info">Ver</a>
    <a href="editar.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>

    <div class="btn-group">
      <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
        ⚙️ Opciones
      </button>
      <ul class="dropdown-menu">
        <?php if ($p['estado'] == 'activo') : ?>
          <li><a class="dropdown-item text-warning" href="procesar_estado.php?id=<?= $p['id'] ?>&accion=inactivar">🚫 Marcar vencido</a></li>
        <?php else : ?>
          <li><a class="dropdown-item text-success" href="procesar_estado.php?id=<?= $p['id'] ?>&accion=activar">✅ Reactivar</a></li>
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
