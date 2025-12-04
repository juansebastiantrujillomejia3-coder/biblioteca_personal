<?php
include('../config/database.php');

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM autores WHERE id = $id";
  mysqli_query($conn, $query);
}

header("Location: index.php");
exit();
?>
