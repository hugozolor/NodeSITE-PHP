<?php 
$titulo_pagina = "Registro - NodeSite";
$pagina_actual = "register";
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
      <h2>Registrarse</h2>
      <p>Unite a la comunidad para acceder a todos los beneficios.</p>
    </div>

    <form action="/api/registrar" method="POST" class="register-form">
      
      <input type="hidden" name="origen">

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
          placeholder="UsuarioUnico" 
          pattern="[A-Za-z0-9]+"
          minlength="4"
          maxlength="15"
          required
        >
        <span class="helper-text">Solo letras y números (4-15 caracteres).</span>
      </div>

      <div class="input-group fade-in-delay-2">
        <label for="password">Contraseña</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          placeholder="Mínimo 8 caracteres" 
          minlength="8"
          required
        >
      </div>

      <div class="input-group fade-in-delay-2">
        <label for="birthdate">Fecha de Nacimiento</label>
        <input 
          type="date" 
          id="birthdate" 
          name="birthdate" 
          max="2010-12-31" 
          required
        >
        <span class="helper-text">Debes haber nacido antes de 2011.</span>
      </div>

      <div class="input-group fade-in-delay-2">
        <label>Género (Opcional)</label>
        <div style="display: flex; gap: 10px; margin-top: 5px;">
          <label for="masculino" style="font-weight: normal; font-size: 0.9em;">
            <input type="radio" id="masculino" name="gender" value="masculino"> Masculino
          </label>
          <label for="femenino" style="font-weight: normal; font-size: 0.9em;">
            <input type="radio" id="femenino" name="gender" value="femenino"> Femenino
          </label>
        </div>
      </div>

      <div class="input-group fade-in-delay-2" style="margin-top: 15px;">
        <label for="terms" style="display: flex; align-items: center; gap: 8px; font-weight: normal; font-size: 0.9em; cursor: pointer;">
          <input 
            type="checkbox" 
            id="terms" 
            name="terms" 
            required
          >
          Acepto los términos y condiciones de la app
        </label>
      </div>

      <div class="action-area fade-in-delay-3" style="display: flex; gap: 10px;">
        <button type="submit" class="btn-submit" style="flex: 1;">
          Continuar
        </button>
        <button type="reset" class="btn-submit" style="flex: 1; background-color: #666; border-color: #555;">
          Borrar Datos
        </button>
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