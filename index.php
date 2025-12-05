<?php 
  include('includes/header.php');
  include('includes/navbar.php');
?>

<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">

<div class="container mt-4">
  <h1 class="text-center" style="color:#2c3e50; font-weight: bold;">
    Biblioteca Personal — Versión Mejorada
</h1>

  <center>Bienvenidos</center>

  <p style="text-align:center; color:gray;">
    Actualización realizada desde la rama alterna (mejora-interfaz).
</p>



  
  <div class="row mt-5">
    <div class="col-md-3">
      <a href="autores/index.php" class="btn btn-primary w-100 mb-3">Autores</a>
    </div>
    <div class="col-md-3">
      <a href="categorias/index.php" class="btn btn-success w-100 mb-3">Categorías</a>
    </div>
    <div class="col-md-3">
      <a href="libros/index.php" class="btn btn-warning w-100 mb-3">Libros</a>   
    </div>
    <div class="col-md-3">
      <a href="prestamos/index.php" class="btn btn-danger w-100 mb-3">Préstamos</a>
    </div>
  </div>

  <?php include('dashboard/dashboard_contenido.php'); ?>
</div>

<?php include('includes/footer.php'); ?>