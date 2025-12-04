<?php
include('../config/database.php');

// =============================
// 1. GUARDAR NUEVO AUTOR
// =============================
if (isset($_POST['guardar'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nacionalidad = $_POST['nacionalidad'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $biografia = $_POST['biografia'];

    // ---- Procesar imagen ----
    $foto_url = NULL;

    if (!empty($_FILES['foto_url']['name'])) {

        // Crear carpeta si no existe
        if (!is_dir("../uploads/autores")) {
            mkdir("../uploads/autores", 0777, true);
        }

        $nombreArchivo = time() . "_" . basename($_FILES['foto_url']['name']);
        $rutaDestino = "../uploads/autores/" . $nombreArchivo;

        if (move_uploaded_file($_FILES['foto_url']['tmp_name'], $rutaDestino)) {
            $foto_url = $nombreArchivo;
        }
    }

    // Insertar en la base de datos
    $query = "INSERT INTO autores 
              (nombre, apellido, nacionalidad, fecha_nacimiento, biografia, foto_url, created_at)
              VALUES 
              ('$nombre', '$apellido', '$nacionalidad', '$fecha_nacimiento', '$biografia', '$foto_url', NOW())";

    mysqli_query($conn, $query);
    header("Location: index.php");
    exit();
}



// =============================
// 2. ACTUALIZAR AUTOR
// =============================
if (isset($_POST['actualizar'])) {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nacionalidad = $_POST['nacionalidad'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $biografia = $_POST['biografia'];

    // Gestión de imagen (opcional actualizar)
    $setFoto = "";

    if (!empty($_FILES['foto_url']['name'])) {

        // Crear carpeta si no existe
        if (!is_dir("../uploads/autores")) {
            mkdir("../uploads/autores", 0777, true);
        }

        $nombreArchivo = time() . "_" . basename($_FILES['foto_url']['name']);
        $rutaDestino = "../uploads/autores/" . $nombreArchivo;

        if (move_uploaded_file($_FILES['foto_url']['tmp_name'], $rutaDestino)) {
            $setFoto = ", foto_url='$nombreArchivo'";
        }
    }

    // Actualizar registro
    $query = "UPDATE autores SET 
                nombre='$nombre',
                apellido='$apellido',
                nacionalidad='$nacionalidad',
                fecha_nacimiento='$fecha_nacimiento',
                biografia='$biografia'
                $setFoto
              WHERE id=$id";

    mysqli_query($conn, $query);

    header("Location: index.php");
    exit();
}

?>
