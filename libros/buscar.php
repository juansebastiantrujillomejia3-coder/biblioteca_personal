<?php
include('../config/database.php');

$texto = $_POST['texto'] ?? '';

if ($texto != '') {
  $sql = "SELECT libros.titulo, autores.nombre AS autor
          FROM libros
          LEFT JOIN autores ON libros.autor_id = autores.id
          WHERE libros.titulo LIKE '%$texto%'
          OR autores.nombre LIKE '%$texto%'
          LIMIT 10";
  $res = mysqli_query($conn, $sql);

  if (mysqli_num_rows($res) > 0) {
    while ($fila = mysqli_fetch_assoc($res)) {
      echo "<li class='list-group-item'>
              <b>{$fila['titulo']}</b> — {$fila['autor']}
            </li>";
    }
  } else {
    echo "<li class='list-group-item text-muted'>Sin resultados</li>";
  }
}
?>
