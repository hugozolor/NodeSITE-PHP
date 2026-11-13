<?php 
$titulo_pagina = "Iniciar Sesión - NodeSite";
$pagina_actual = "login";
require_once '../includes/header.php'; 
?>
<div class="register-layout">
  
  <header class="brand-header">
    <h1 class="logo-text">
      <span class="node">Node</span><span class="site">site</span>
    </h1>
  </header>

  <main class="register-card">
    
    <div class="card-header fade-in">
      <h2>Inicio de sesión</h2>
      <p>Bienvenido de vuelta a la comunidad.</p>
    </div>

    <form method="POST" action="login.php" class="register-form">
      
      <div class="input-group fade-in-delay-1">
        <label for="email">Correo Electrónico</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          placeholder="nombre@ejemplo.com" 
          required
        >
      </div>

      <div class="input-group fade-in-delay-2">
        <label for="username">Ingresar nombre de usuario</label>
        <input 
          type="text" 
          id="username" 
          name="username" 
          placeholder="Tu usuario" 
          required
        >
        <span class="helper-text">Nodesite guarda de forma segura tu información de sesión.</span>
      </div>

      <div class="action-area fade-in-delay-3">
        <button type="submit" class="btn-submit">
          Ingresar
        </button>
        <span class="helper-text">
          <p>
          Al cerrar sesión, se conserva tu historial de publicaciones, 
          reseñas y el uso de tus oportunidades mensuales. Al volver a 
          iniciar sesión, podrás continuar utilizando la aplicación 
          sin perder tu progreso.
          </p>
        </span>
      </div>

    </form>
  </main>
</div>
<script>
document.querySelector('form.register-form').addEventListener('submit', function(e) {
    e.preventDefault();
    window.location.href = 'dashboard.php';
});
</script>
</body>
</html>