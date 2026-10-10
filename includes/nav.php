<?php 
 
?>
<header class="main-header" style="margin-top: 0; padding-top: 0;">
  <div class="nav-container" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
    
    <div style="display: flex; align-items: center; gap: 15px;">
        <button class="menu-trigger" onclick="toggleSidebar()" aria-label="Menú principal">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>

        <a href="<?= BASE_URL ?>index.php" style="text-decoration:none; color:inherit;"><div class="app-brand">
          <img src="<?= BASE_URL ?>public/assets/NodesiteLogo.svg" alt="Logo NODEsite" class="brand-logo-img">
          <h1>Node<span>site</span></h1></div></a></a>
    </div>

    <!-- Right side: Clock and User Profile -->
    <div style="display: flex; align-items: center; gap: 15px;">
        <div id="relojHeader" style="font-weight: 500; font-size: 0.9rem; background: rgba(255,255,255,0.1); padding: 6px 12px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.2);"></div>
        <button class="profile-trigger" onclick="toggleUserMenu()" aria-label="Menú de usuario" style="margin-left: 0;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path>
            <circle cx="8.5" cy="7" r="4"></circle>
          </svg>
        </button>
    </div>
  </div>

  <!-- DROPDOWN DE USUARIO (FIEL AL PROYECTO ORIGINAL) -->
  <div class="user-dropdown" id="userMenu" style="display: none;">
    <div class="dropdown-header">
      <div class="info-row">
        <svg class="icon-2d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        <span class="text-bold">Usuario_Nodesite</span>
      </div>
      <div class="info-row email">
        <svg class="icon-2d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        <span>contacto@nodesite.com</span>
      </div>
    </div>

    <div class="chances-badge-inline">
        <svg class="heart-icon" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
        <span class="counter">Publicaciones: <strong>5/5</strong></span>
    </div>
    
    <div class="dropdown-actions">
      <button class="action-btn" onclick="toggleTheme()">
        <svg class="icon-2d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
        <span>Modo Oscuro</span>
      </button>
      <a class="action-btn exit" href="<?= BASE_URL ?>index.php" style="text-decoration: none;">
        <svg class="icon-2d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4m7 14l5-5-5-5m5 5H9"></path></svg>
        <span>Cerrar Sesión</span>
      </a>
    </div>
  </div>
</header>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()" style="display: none;"></div>

<aside class="sidebar" id="mainSidebar">
  <div class="sidebar-header">
    <a href="<?= BASE_URL ?>index.php" style="text-decoration:none; color:inherit;"><div class="app-brand">
      <img src="<?= BASE_URL ?>public/assets/NodesiteLogo.svg" alt="Logo NODEsite" class="brand-logo-img">
      <h1>Node<span>site</span></h1></div></a></a>
  </div>

  <nav class="sidebar-content">
      <a class="nav-item" href="<?= BASE_URL ?>pages/dashboard.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"></path></svg><span class="nav-item-label">Menú Principal</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/mapa.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M15 18.89l-6-2.11V5.11l6 2.22v11.56zM20.64 19.1L15 21l-6-2.11-5.34 2.08C3.15 21.03 3 20.85 3 20.62V5.5c0-.22.15-.4.36-.48L9 3l6 2.11 5.64-1.9c.21-.07.36.11.36.33v15.12c0 .23-.15.41-.36.44z"></path></svg><span class="nav-item-label">Mapa</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/publicar.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M17 19.22H5V7h7V5H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-7h-2v7.22zM19 2h-2v3h-3v2h3v3h2V7h3V5h-3V2zM7 9h8v2H7zm0 4h8v2H7zm0 4h5v2H7z"></path></svg><span class="nav-item-label">Publicar</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/resenas.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 14v-2.42l5.88-5.88c.2-.2.51-.2.71 0l1.71 1.71c.2.2.2.51 0 .71L8.42 14H6zm12 0h-7.42l2-2H18v2z"></path></svg><span class="nav-item-label">Reseñas</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/chatbot.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M20 9V7c0-1.1-.9-2-2-2h-3c0-1.66-1.34-3-3-3S9 3.34 9 5H6c-1.1 0-2 .9-2 2v2c-1.66 0-3 1.34-3 3s1.34 3 3 3v4c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-4c1.66 0 3-1.34 3-3s-1.34-3-3-3zm-2 10H6V7h12v12zm-9-6c-.83 0-1.5-.67-1.5-1.5S8.17 10 9 10s1.5.67 1.5 1.5S9.83 13 9 13zm6 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5 1.67 1.5 1.5-.67 1.5-1.5 1.5zm-6 3h6v2H9v-2z"></path></svg><span class="nav-item-label">Chat Bot</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/notificaciones.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M7.58 4.08L6.15 2.65C3.75 4.48 2.17 7.3 2.03 10.5h2c.15-2.65 1.51-4.97 3.55-6.42zM19.97 10.5h2c-.15-2.65-1.51-4.97-3.55-6.42l-1.43 1.43c2.4 1.83 3.98 4.65 4.12 7.69zM18 11c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-6 11c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2z"></path></svg><span class="nav-item-label">Notificaciones</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/centro-aprendizaje.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 14.72l5-2.45v3.72z"></path></svg><span class="nav-item-label">Aprendizaje</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/blog.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path></svg><span class="nav-item-label">Blog</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/cv.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path></svg><span class="nav-item-label">cv</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/mi-cuenta.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"></path></svg><span class="nav-item-label">Configuración</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/nosotros.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M4 13c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm16 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-8 0c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V21h14v-2.5c0-2.33-4.67-3.5-7-3.5zM4 15c-.83 0-1.5 .67-1.5 1.5V19h5v-1.66c0-1.25.75-2.32 1.86-2.77C8.14 15.22 5.89 15 4 15zm16 0c-1.89 0-4.14.22-5.36.57 1.11.45 1.86 1.52 1.86 2.77V19h5v-2.5c0-.83-.67-1.5-1.5-1.5z"></path></svg><span class="nav-item-label">nosotros</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/Quiénes somos.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M4 13c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm16 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-8 0c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V21h14v-2.5c0-2.33-4.67-3.5-7-3.5zM4 15c-.83 0-1.5 .67-1.5 1.5V19h5v-1.66c0-1.25.75-2.32 1.86-2.77C8.14 15.22 5.89 15 4 15zm16 0c-1.89 0-4.14.22-5.36.57 1.11.45 1.86 1.52 1.86 2.77V19h5v-2.5c0-.83-.67-1.5-1.5-1.5z"></path></svg><span class="nav-item-label">Quiénes somos</span></a>
      <a class="nav-item" href="<?= BASE_URL ?>pages/faq.php"><svg class="icon-2d" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path></svg><span class="nav-item-label">faq</span></a>
  </nav>
</aside>