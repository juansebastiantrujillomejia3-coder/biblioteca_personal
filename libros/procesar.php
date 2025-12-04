<?php
include('../config/database.php');

// Crear libro
if (isset($_POST['guardar'])) {
  $titulo = $_POST['titulo'];
  $isbn = $_POST['isbn'];
  $autor_id = $_POST['autor_id'];
  $categoria_id = $_POST['categoria_id'];
  $año = $_POST['año_publicacion'];
  $estado = $_POST['estado'];
  $condicion = $_POST['condicion'];   // <-- AQUI VA
  $descripcion = $_POST['descripcion'];
  $portada_url = null;


  // Subir imagen
  if (!empty($_FILES['portada']['name'])) {
    $nombreArchivo = time() . '_' . basename($_FILES['portada']['name']);
    $rutaDestino = '../assets/images/' . $nombreArchivo;
    move_uploaded_file($_FILES['portada']['tmp_name'], $rutaDestino);
    $portada_url = '../assets/images/' . $nombreArchivo;
  }

  // ✅ Verificar categoría (puede ser NULL)
  if (empty($categoria_id)) {
    $categoria_id = "NULL"; // sin comillas para MySQL
  } else {
    $categoria_id = "'$categoria_id'";
  }

  // Insertar libro
  $query = "INSERT INTO libros (titulo, isbn, autor_id, categoria_id, año_publicacion, estado, descripcion, portada_url, created_at)
            VALUES ('$titulo', '$isbn', '$autor_id', $categoria_id, '$año', '$estado', '$descripcion', '$portada_url', NOW())";

  if (mysqli_query($conn, $query)) {
    header("Location: index.php");
    exit();
  } else {
    echo "❌ Error al guardar el libro: " . mysqli_error($conn);
  }
}

// Actualizar libro
if (isset($_POST['actualizar'])) {
  $id = $_POST['id'];
  $titulo = $_POST['titulo'];
  $isbn = $_POST['isbn'];
  $autor_id = $_POST['autor_id'];
  $categoria_id = $_POST['categoria_id'];
  $año = $_POST['año_publicacion'];
  $estado = $_POST['estado'];
  $condicion = $_POST['condicion'];  // <-- AQUI VA
  $descripcion = $_POST['descripcion'];


  $setPortada = "";
  if (!empty($_FILES['portada']['name'])) {
    $nombreArchivo = time() . '_' . basename($_FILES['portada']['name']);
    $rutaDestino = '../assets/images/' . $nombreArchivo;
    move_uploaded_file($_FILES['portada']['tmp_name'], $rutaDestino);
    $setPortada = ", portada_url='assets/images/$nombreArchivo'";
  }

  $query = "UPDATE libros SET 
              titulo='$titulo',
              isbn='$isbn',
              autor_id='$autor_id',
              categoria_id='$categoria_id',
              año_publicacion='$año',
              estado='$estado',
              condicion='$condicion',     -- ⬅️ AQUI VA
              descripcion='$descripcion'
              $setPortada
            WHERE id=$id";


  if (mysqli_query($conn, $query)) {
    header("Location: index.php");
    exit();
  } else {
    echo "❌ Error al actualizar el libro: " . mysqli_error($conn);
  }
}
?>
