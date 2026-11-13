<?php 
$titulo_pagina = "Mapa Interactivo - NodeSite";
$pagina_actual = "mapa";
require_once '../includes/header.php'; 
require_once '../includes/nav.php'; 

// Detección de parámetros de reporte
$modo_seleccion = isset($_GET['modo']) && $_GET['modo'] === 'elegir_ubicacion';
$tipo_nuevo     = htmlspecialchars($_GET['tipo'] ?? 'Incidencia', ENT_QUOTES, 'UTF-8');
$barrio_nuevo   = htmlspecialchars($_GET['barrio'] ?? 'Salta Capital', ENT_QUOTES, 'UTF-8');
$desc_nuevo     = htmlspecialchars($_GET['desc'] ?? '', ENT_QUOTES, 'UTF-8');
?>

<!-- MapLibre GL CSS -->
<link href="https://unpkg.com/maplibre-gl@3.0.1/dist/maplibre-gl.css" rel="stylesheet" />

<div class="map-viewport">
  <div id="map-container"></div> 

  <!-- Overlay para Seleccionar Ubicación del PIN (Replicado de Angular) -->
  <div class="seleccion-overlay" id="seleccionOverlay" style="<?= $modo_seleccion ? 'display: flex;' : 'display: none;' ?>">
    <div class="panel-card">
      <div class="panel-header">
        <div class="icon-wrapper">
          <svg class="icon-md3" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
          </svg>
        </div>
        
        <div class="text-content">
          <h3>Selecciona la ubicación del PIN</h3>
          <p class="description">
            Toca o haz clic en cualquier punto del mapa para indicar dónde ocurrió el reporte de <strong><?= $tipo_nuevo ?></strong>.
          </p>
        </div>
      </div>

      <div class="panel-actions">
        <button class="btn-cancel" onclick="cancelarSeleccionUbicacion()" type="button">
          ✕ Cancelar
        </button>

        <button class="btn-confirm" id="btnConfirmarUbicacion" onclick="confirmarSeleccionUbicacion()" type="button" disabled style="opacity: 0.5; cursor: not-allowed;">
          ✔ Confirmar ubicación
        </button>
      </div>
    </div>
  </div>

  <!-- Notificación Toast flotante -->
  <div class="map-toast-notification" id="mapToast" style="display: none;">
    <span class="material-symbols-outlined" style="color: #22c55e; font-size: 26px;">check_circle</span>
    <div style="flex: 1;">
      <strong style="display:block; font-size: 0.95rem;">¡Reporte publicado con éxito!</strong>
      <span style="font-size: 0.82rem; color: #cbd5e1;" id="mapToastDesc">Tu reporte ya está visible en el mapa interactivo.</span>
    </div>
    <button onclick="document.getElementById('mapToast').style.display='none'" style="background: none; border: none; color: #94a3b8; font-size: 18px; cursor: pointer; padding: 4px;">✕</button>
  </div>

  <button class="fab-filter" onclick="toggleFiltro()">
    <svg viewBox="0 0 24 24" fill="currentColor">
      <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
    </svg>
  </button>

  <div class="filter-side-panel" id="filterPanel">
    
    <div class="panel-header">
      <div class="header-text">
        <h3>Filtrar Reportes</h3>
        <p>Selecciona una categoría para visualizar reportes específicos.</p>
      </div>
      <button class="close-btn" onclick="toggleFiltro()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"></path></svg>
      </button>
    </div>

    <div class="panel-body">
      <button class="filter-chip active" onclick="seleccionarCategoria('Todas', this)">
        Ver Todas
      </button>

      <button class="filter-chip" onclick="seleccionarCategoria('Bache', this)">Bache</button>
      <button class="filter-chip" onclick="seleccionarCategoria('Alumbrado', this)">Alumbrado</button>
      <button class="filter-chip" onclick="seleccionarCategoria('Basura', this)">Basura</button>
      <button class="filter-chip" onclick="seleccionarCategoria('Tránsito', this)">Tránsito</button>
      <button class="filter-chip" onclick="seleccionarCategoria('Obra Vial', this)">Obra Vial</button>
    </div>

    <div class="panel-footer">
      <h4>Acciones rápidas</h4>
      <div class="action-buttons-container">
        <a class="action-btn outline-btn" href="<?= BASE_URL ?>pages/resenas.php" style="text-decoration:none;">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 14v-2.47l6.88-6.88c.2-.2.51-.2.71 0l1.77 1.77c.2.2.2.51 0 .71L8.47 14H6zm12 0h-7.5l2-2H18v2z"/></svg>
          Reseñar
        </a>

        <a class="action-btn primary-btn" href="<?= BASE_URL ?>pages/publicar.php" style="text-decoration:none;">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.14 2 5 5.14 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.86-3.14-7-7-7zm4 8h-3v3h-2v-3H8V8h3V5h2v3h3v2z"/></svg>
          Publicar
        </a>
      </div>
    </div>

  </div>
</div>

<style>
/* --- CONTENEDOR ESTRUCTURAL OVERLAY --- */
.seleccion-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none; 
  z-index: 2000;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  align-items: center;
  padding: 24px;
}

/* --- TARJETA FLOTANTE --- */
.panel-card {
  pointer-events: auto;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(226, 232, 240, 0.9);
  border-radius: 24px;
  padding: 20px;
  width: 100%;
  max-width: 440px;
  display: flex;
  flex-direction: column;
  gap: 16px;
  box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.15), 
              0 10px 10px -5px rgba(15, 23, 42, 0.08);
  animation: panelSlideUp 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes panelSlideUp {
  from { transform: translateY(30px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

.panel-header {
  display: flex;
  gap: 14px;
  align-items: flex-start;
}

.icon-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  border-radius: 14px;
  background-color: rgba(0, 95, 163, 0.1);
  color: #005fa3;
  flex-shrink: 0;
}

.icon-md3 {
  width: 24px;
  height: 24px;
}

.text-content {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.text-content h3 {
  font-size: 1.05rem;
  font-weight: 700;
  color: #1e293b;
  margin: 0;
}

.text-content .description {
  font-size: 0.88rem;
  color: #64748b;
  margin: 0;
  line-height: 1.4;
}

.panel-actions {
  display: flex;
  gap: 12px;
  width: 100%;
}

.panel-actions button {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: 12px 16px;
  font-size: 0.95rem;
  font-weight: 700;
  border-radius: 16px;
  cursor: pointer;
  flex: 1;
  transition: all 0.2s ease;
}

.btn-cancel {
  background: transparent;
  color: #64748b;
  border: 1px solid #cbd5e1;
}

.btn-cancel:hover {
  background: #fee2e2;
  color: #dc2626;
  border-color: #fca5a5;
}

.btn-confirm {
  background: #005fa3; 
  color: #ffffff;
  border: none;
  box-shadow: 0 4px 12px rgba(0, 95, 163, 0.25);
}

.btn-confirm:hover {
  background: #004b82;
}

/* Modo oscuro */
body.dark-mode .panel-card {
  background: rgba(30, 41, 59, 0.92);
  border-color: rgba(51, 65, 85, 0.8);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
}
body.dark-mode .text-content h3 {
  color: #f8fafc;
}
body.dark-mode .text-content .description {
  color: #94a3b8;
}
body.dark-mode .icon-wrapper {
  background-color: rgba(56, 189, 248, 0.15);
  color: #38bdf8;
}
body.dark-mode .btn-cancel {
  color: #94a3b8;
  border-color: #475569;
}
body.dark-mode .btn-cancel:hover {
  background: rgba(239, 68, 68, 0.2);
  color: #f87171;
}
body.dark-mode .btn-confirm {
  background: #38bdf8;
  color: #0f172a;
}

.map-toast-notification {
  position: absolute;
  top: 20px;
  left: 50%;
  transform: translateX(-50%);
  background: rgba(15, 23, 42, 0.94);
  color: white;
  padding: 12px 18px;
  border-radius: 14px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.35);
  display: flex;
  align-items: center;
  gap: 12px;
  z-index: 1000;
  max-width: 90%;
  width: 440px;
  backdrop-filter: blur(8px);
  border: 1px solid rgba(255, 255, 255, 0.15);
  animation: slideToast 0.4s ease-out;
}
@keyframes slideToast {
  from { opacity: 0; transform: translate(-50%, -20px); }
  to { opacity: 1; transform: translate(-50%, 0); }
}
</style>

<!-- MapLibre GL JS -->
<script src="https://unpkg.com/maplibre-gl@3.0.1/dist/maplibre-gl.js"></script>
<script src="<?= BASE_URL ?>public/js/pages/mapa.js?v=<?php echo time(); ?>"></script>

<?php require_once '../includes/footer.php'; ?>
