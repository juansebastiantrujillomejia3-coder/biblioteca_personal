<?php
// includes/navbar.php
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../index.php">
      <i class="fa-solid fa-book"></i> Biblioteca
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/biblioteca_personal/dashboard/index.php">Estadísticas</a></li>
        <li class="nav-item"><a class="nav-link" href="/biblioteca_personal/autores/index.php">Autores</a></li>
        <li class="nav-item"><a class="nav-link" href="/biblioteca_personal/categorias/index.php">Categorías</a></li>
        <li class="nav-item"><a class="nav-link" href="/biblioteca_personal/libros/index.php">Libros</a></li>
        <li class="nav-item"><a class="nav-link" href="/biblioteca_personal/prestamos/index.php">Préstamos</a></li>
      </ul>
    </div>
  </div>
</nav>
