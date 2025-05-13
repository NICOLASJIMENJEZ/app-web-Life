document.addEventListener('DOMContentLoaded', function () {
    const logoutBtn = document.getElementById('logoutBtn');
  
    if (logoutBtn) {
      logoutBtn.addEventListener('click', function () {
        // Limpiar la sesión
        sessionStorage.clear();
        localStorage.clear();
  
        // Redirigir al login
        window.location.href = 'login.php';

      });
    }
  });
  