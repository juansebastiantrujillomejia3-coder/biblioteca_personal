// ========================================
// 🧠 main.js — Funciones generales del sitio
// ========================================

document.addEventListener("DOMContentLoaded", () => {

  // ============================
  // 🔍 BÚSQUEDA DE LIBROS (AJAX)
  // ============================

  const inputBusqueda = document.getElementById('buscarLibro');
  const listaResultados = document.getElementById('resultados');

  // Solo ejecuta si el buscador existe (para evitar errores en otras páginas)
  if (inputBusqueda && listaResultados) {
    inputBusqueda.addEventListener('keyup', () => {
      const texto = inputBusqueda.value.trim();

      if (texto.length > 0) {
        // Llamada AJAX con fetch()
        fetch('buscar.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'texto=' + encodeURIComponent(texto)
        })
          .then(res => res.text())
          .then(data => {
            listaResultados.style.display = 'block';
            listaResultados.innerHTML = data;
          })
          .catch(err => {
            console.error('Error en búsqueda AJAX:', err);
          });
      } else {
        listaResultados.style.display = 'none';
      }
    });
  }

  // ================================
  // 🗑️ ELIMINAR REGISTROS CON ALERTA
  // ================================

  const botonesEliminar = document.querySelectorAll('.btn-eliminar');
  botonesEliminar.forEach(boton => {
    boton.addEventListener('click', (e) => {
      e.preventDefault();
      const url = boton.getAttribute('href');

      if (confirm('¿Seguro que quieres eliminar este registro?')) {
        fetch(url)
          .then(res => res.text())
          .then(() => {
            alert('✅ Registro eliminado correctamente.');
            location.reload(); // Recarga la página después de borrar
          })
          .catch(() => {
            alert('❌ Error al eliminar el registro.');
          });
      }
    });
  });

  // =====================================
  // 🌗 MODO OSCURO (BONUS OPCIONAL)
  // =====================================

  const botonModo = document.getElementById('toggleMode');
  if (botonModo) {
    botonModo.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      const modoActivo = document.body.classList.contains('dark-mode');
      botonModo.textContent = modoActivo ? '☀️ Modo Claro' : '🌙 Modo Oscuro';
    });
  }

});
