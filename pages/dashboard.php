<?php 
$titulo_pagina = "Dashboard - NodeSite";
$pagina_actual = "dashboard";
require_once '../includes/header.php'; 
require_once '../includes/nav.php'; 
?>

<div class="main-viewport">
  <main class="dashboard-content">
    
    <section class="carousel-container" id="newsCarousel" style="position: relative; overflow: hidden; background: #ffffff; border-radius: 16px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-bottom: 30px;">
      
      <button class="carousel-control prev" onclick="prevSlide()" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: #ffffff; border: 1px solid #e2e8f0; border-radius: 50%; width: 32px; height: 32px; cursor: pointer; z-index: 10; display: flex; justify-content: center; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><polyline points="15 18 9 12 15 6"></polyline></svg>
      </button>

      <div class="carousel-track" id="carouselTrack" style="display: flex; transition: transform 0.5s ease-in-out;">
      </div>

      <button class="carousel-control next" onclick="nextSlide()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: #ffffff; border: 1px solid #e2e8f0; border-radius: 50%; width: 32px; height: 32px; cursor: pointer; z-index: 10; display: flex; justify-content: center; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><polyline points="9 18 15 12 9 6"></polyline></svg>
      </button>

    </section>

    <div class="welcome-section" style="text-align: center; margin-bottom: 30px;">
      <h1 class="welcome-title" style="color: #2e448f; font-size: 2rem;">¡Te damos la Bienvenida a Nodesite!</h1>
      <p class="discover-text" style="color: #64748b; font-size: 1.1rem;">¡Descubrí lo que podés hacer!</p>
    </div>

    <section class="options-container">
      <a class="anses-card" href="<?= BASE_URL ?>pages/mapa.php" style="text-decoration: none; color: inherit;">
        <div class="card-icon-box">
          <span class="material-symbols-outlined custom-icon">travel_explore</span>
        </div>
        <div class="card-info">
          <h2>Mapa Interactivo</h2>
          <p>Visualiza reportes en tiempo real.</p>
        </div>
      </a>
      <a class="anses-card" href="<?= BASE_URL ?>pages/resenas.php" style="text-decoration: none; color: inherit;">
        <div class="card-icon-box">
          <span class="material-symbols-outlined custom-icon">rate_review</span>
        </div>
        <div class="card-info">
          <h2>Reseñas</h2>
          <p>Consulta la opinión de otros ciudadanos.</p>
        </div>
      </a>
      <a class="anses-card" href="<?= BASE_URL ?>pages/publicar.php" style="text-decoration: none; color: inherit;">
        <div class="card-icon-box">
          <span class="material-symbols-outlined custom-icon">campaign</span>
        </div>
        <div class="card-info">
          <h2>Publicar Reporte</h2>
          <p>Sube una foto y descripción de tu barrio.</p>
        </div>
      </a>
      <a class="anses-card" href="<?= BASE_URL ?>pages/chatbot.php" style="text-decoration: none; color: inherit;">
        <div class="card-icon-box">
          <span class="material-symbols-outlined custom-icon">smart_toy</span>
        </div>
        <div class="card-info">
          <h2>Chat Nodesite</h2>
          <p>Preguntale a nuestro guía digital lo que necesites.</p>
        </div>
      </a>
      <a class="anses-card" href="<?= BASE_URL ?>pages/notificaciones.php" style="text-decoration: none; color: inherit;">
        <div class="card-icon-box">
          <span class="material-symbols-outlined custom-icon">notifications_active</span>
        </div>
        <div class="card-info">
          <h2>Notificación</h2>
          <p>Recibí actualizaciones oficiales sobre tus reportes.</p>
        </div>
      </a>
      <a class="anses-card" href="<?= BASE_URL ?>pages/nosotros.php" style="text-decoration: none; color: inherit;">
        <div class="card-icon-box">
          <span class="material-symbols-outlined custom-icon">account_tree</span>
        </div>
        <div class="card-info">
          <h2>Nosotros</h2>
          <p>Conocé la ingeniería humana detrás de cada pin.</p>
        </div>
      </a>
    </section>

  </main>
</div>

<?php require_once '../includes/footer.php'; ?>