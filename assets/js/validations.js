// ===================================================
// 📘 VALIDACIONES DE FORMULARIOS - Biblioteca Personal
// ===================================================

document.addEventListener("DOMContentLoaded", () => {
  // Validar formulario de libros
  const formLibro = document.querySelector('form[action="procesar.php"][method="POST"]');
  if (formLibro) {
    formLibro.addEventListener("submit", (e) => {
      const titulo = formLibro.querySelector('input[name="titulo"]');
      const isbn = formLibro.querySelector('input[name="isbn"]');
      const autor = formLibro.querySelector('select[name="autor_id"]');
      const categoria = formLibro.querySelector('select[name="categoria_id"]');

      if (titulo.value.trim() === "") {
        alert("⚠️ El título del libro es obligatorio.");
        titulo.focus();
        e.preventDefault();
        return;
      }

      if (isbn.value.trim() === "" || isbn.value.length < 10) {
        alert("⚠️ El ISBN debe tener al menos 10 caracteres.");
        isbn.focus();
        e.preventDefault();
        return;
      }

      if (autor.value === "") {
        alert("⚠️ Debes seleccionar un autor.");
        autor.focus();
        e.preventDefault();
        return;
      }

      if (categoria.value === "") {
        alert("⚠️ Debes seleccionar una categoría.");
        categoria.focus();
        e.preventDefault();
        return;
      }
    });
  }

  // Validar formulario de categorías
  const formCategoria = document.querySelector('form[action="procesar.php"][method="POST"] input[name="nombre"]');
  if (formCategoria) {
    formCategoria.form.addEventListener("submit", (e) => {
      const nombre = formCategoria.value.trim();
      if (nombre === "") {
        alert("⚠️ El nombre de la categoría no puede estar vacío.");
        e.preventDefault();
      }
    });
  }

  // Validar formulario de autores
  const formAutor = document.querySelector('form[action="procesar.php"][method="POST"] input[name="nombre"]');
  if (formAutor) {
    formAutor.form.addEventListener("submit", (e) => {
      const nombre = formAutor.value.trim();
      if (nombre === "") {
        alert("⚠️ El nombre del autor no puede estar vacío.");
        e.preventDefault();
      }
    });
  }

  // Validar formulario de préstamos
  const formPrestamo = document.querySelector('form[action="procesar.php"][method="POST"] input[name="nombre_prestamista"]');
  if (formPrestamo) {
    formPrestamo.form.addEventListener("submit", (e) => {
      const nombre = formPrestamo.value.trim();
      const fechaPrestamo = formPrestamo.form.querySelector('input[name="fecha_prestamo"]').value;
      const fechaDev = formPrestamo.form.querySelector('input[name="fecha_devolucion_esperada"]').value;

      if (nombre === "") {
        alert("⚠️ Debes escribir el nombre del prestamista.");
        e.preventDefault();
        return;
      }

      if (fechaPrestamo === "" || fechaDev === "") {
        alert("⚠️ Debes completar las fechas del préstamo.");
        e.preventDefault();
        return;
      }

      if (new Date(fechaDev) < new Date(fechaPrestamo)) {
        alert("⚠️ La fecha de devolución no puede ser anterior a la fecha de préstamo.");
        e.preventDefault();
      }
    });
  }
});
