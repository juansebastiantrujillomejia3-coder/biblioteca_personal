<?php
include('../includes/header.php');
include('../includes/navbar.php');
include('../config/database.php');

// Consulta con JOIN para mostrar autor y categoría (CORREGIDA)
$query = "
  SELECT libros.*, autores.nombre AS autor_nombre, autores.apellido AS autor_apellido, 
         categorias.nombre AS categoria_nombre
  FROM libros
  LEFT JOIN autores ON libros.autor_id = autores.id
  LEFT JOIN categorias ON libros.categoria_id = categorias.id
  ORDER BY libros.id DESC
";

$result = mysqli_query($conn, $query);
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>📚 Lista de Libros</h2>
    <a href="crear.php" class="btn btn-primary">+ Agregar Libro</a>
  </div>

  <table class="table table-striped">
    <div class="mb-3 mt-3">
      <input type="text" id="buscarLibro" class="form-control" placeholder="🔍 Buscar libro o autor...">
    </div>

    <ul id="resultados" class="list-group mb-4" style="display:none;"></ul>

   <thead>
    <tr>
      <th>ID</th>
      <th>Título</th>
      <th>Autor</th>
      <th>Categoría</th>
      <th>ISBN</th>
      <th><center>Condición</center></th>
      <th>Estado</th>
      <th class="text-center">Acciones</th>
    </tr>
  </thead>

  <tbody>
    <?php while($libro = mysqli_fetch_assoc($result)) { ?>
      <tr>

        <td><?= $libro['id'] ?></td>

        <td><?= htmlspecialchars($libro['titulo']) ?></td>
        <td><?= htmlspecialchars($libro['autor_nombre'] . ' ' . $libro['autor_apellido']) ?></td>
        <td><?= htmlspecialchars($libro['categoria_nombre']) ?></td>
        <td><?= htmlspecialchars($libro['isbn']) ?></td>

        <td><center><?= htmlspecialchars($libro['condicion']) ?></center></td>

        <td>
          <span class="badge <?= $libro['estado'] == 'activo' ? 'bg-success' : 'bg-secondary' ?>">
            <?= htmlspecialchars($libro['estado']) ?>
          </span>
        </td>

        <td class="text-center">
          <a href="ver.php?id=<?= $libro['id'] ?>" class="btn btn-sm btn-info">Ver</a>
          <a href="editar.php?id=<?= $libro['id'] ?>" class="btn btn-sm btn-warning">Editar</a>

          <div class="btn-group">
            <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
              ⚙️ Opciones
            </button>
            <ul class="dropdown-menu">
              <?php if ($libro['estado'] == 'activo') : ?>
                <li><a class="dropdown-item text-warning" href="procesar_estado.php?id=<?= $libro['id'] ?>&accion=inactivar">🚫 Inactivar</a></li>
              <?php else : ?>
                <li><a class="dropdown-item text-success" href="procesar_estado.php?id=<?= $libro['id'] ?>&accion=activar">✅ Activar</a></li>
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

