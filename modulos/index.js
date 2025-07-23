function verImagen(elemento) {
  const imagen = document.getElementById("imagenGrande");
  const titulo = document.getElementById("modalTitulo");
  const galeria = document.getElementById("galeriaScroll");

  imagen.src = elemento.src;
  titulo.textContent = elemento.alt;

  galeria.style.animationPlayState = 'paused'; // Detiene el scroll automático
}

document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('modalImagen');
  modal.addEventListener('hidden.bs.modal', function () {
    document.getElementById("galeriaScroll").style.animationPlayState = 'running';
  });
});