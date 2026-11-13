<?php 
// 1. La sesión DEBE iniciarse antes de enviar cualquier salida HTML
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$titulo_pagina = "Comunidad y Reseñas - NodeSite";
$pagina_actual = "resenas";
require_once '../includes/header.php';
require_once '../includes/nav.php';

$barrios_salta = [
    'Centro',
    'Barrio Norte',
    'Tres Cerritos',
    'San Bernardo',
    'Grand Bourg',
    'Ciudad del Milagro',
    'San Lorenzo',
    'Intersindical',
    'San Martín',
    'El Tribuno'
];

// Reseñas iniciales por defecto en la sesión
if (!isset($_SESSION['todas_resenas'])) {
    $_SESSION['todas_resenas'] = [
        [
            'id' => 1,
            'nombreBarrio' => 'Barrio Norte',
            'fecha' => '10/10/2026',
            'comentario' => 'Excelente la nueva iluminación LED en la plaza principal y calles aledañas.',
            'calificacion' => 5,
            'estado' => 'publicada'
        ],
        [
            'id' => 2,
            'nombreBarrio' => 'Centro',
            'fecha' => '05/10/2026',
            'comentario' => 'Falta mayor frecuencia en la recolección de residuos en la peatonal Alberdi.',
            'calificacion' => 3,
            'estado' => 'moderada'
        ],
        [
            'id' => 3,
            'nombreBarrio' => 'Tres Cerritos',
            'fecha' => '02/10/2026',
            'comentario' => 'Repararon el bache profundo de la subida con rapidez tras el reporte.',
            'calificacion' => 4,
            'estado' => 'publicada'
        ],
        [
            'id' => 4,
            'nombreBarrio' => 'San Bernardo',
            'fecha' => '28/09/2026',
            'comentario' => 'Buen mantenimiento general de veredas y espacios verdes en la costanera.',
            'calificacion' => 5,
            'estado' => 'publicada'
        ],
        [
            'id' => 5,
            'nombreBarrio' => 'Grand Bourg',
            'fecha' => '20/09/2026',
            'comentario' => 'Reclamo reiterado por semáforo titilante en avenida principal.',
            'calificacion' => 2,
            'estado' => 'moderada'
        ]
    ];
}

$errores_resena = [];
$exito_resena = "";

// PROCESAMIENTO DE NUEVA RESEÑA (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion_resena'])) {
    $nuevo_barrio  = htmlspecialchars(trim($_POST['barrio_resena'] ?? ''), ENT_QUOTES, 'UTF-8');
    $nuevo_stars   = filter_input(INPUT_POST, 'estrellas_resena', FILTER_VALIDATE_INT);
    $nuevo_coment  = htmlspecialchars(trim($_POST['comentario_resena'] ?? ''), ENT_QUOTES, 'UTF-8');

    if (empty($nuevo_barrio)) {
        $errores_resena[] = "Debes seleccionar un barrio.";
    }

    if ($nuevo_stars === false || $nuevo_stars < 1 || $nuevo_stars > 5) {
        $errores_resena[] = "Debes calificar el barrio con estrellas (1 a 5).";
    }

    if (empty($nuevo_coment)) {
        $errores_resena[] = "El comentario o reseña no puede estar vacío.";
    } elseif (mb_strlen($nuevo_coment) < 5) {
        $errores_resena[] = "El comentario debe tener al menos 5 caracteres.";
    }

    if (empty($errores_resena)) {
        $nueva_resena = [
            'id' => time(),
            'nombreBarrio' => $nuevo_barrio,
            'fecha' => date('d/m/Y'),
            'comentario' => $nuevo_coment,
            'calificacion' => $nuevo_stars,
            'estado' => 'publicada'
        ];
        array_unshift($_SESSION['todas_resenas'], $nueva_resena);
        $exito_resena = "¡Tu reseña de <strong>" . $nuevo_barrio . "</strong> fue publicada con éxito!";
    }
}

// PROCESAMIENTO DINÁMICO DE FILTROS (GET - Requerimiento Clase 5)
$busqueda_raw     = $_GET['q'] ?? '';
$calificacion_raw = $_GET['calificacion'] ?? '';
$estado_raw       = $_GET['estado'] ?? '';

// Sanitización estricta de entradas GET (OWASP - Prevención de XSS)
$busqueda     = htmlspecialchars(trim($busqueda_raw), ENT_QUOTES, 'UTF-8');
$calificacion = filter_input(INPUT_GET, 'calificacion', FILTER_VALIDATE_INT);
if ($calificacion === false || $calificacion < 1 || $calificacion > 5) {
    $calificacion = 0;
}

$estado = htmlspecialchars(trim($estado_raw), ENT_QUOTES, 'UTF-8');
if (!in_array($estado, ['publicada', 'moderada'])) {
    $estado = 'todos';
}

$filtros_activos = (!empty($busqueda) || $calificacion > 0 || $estado !== 'todos');

// Filtrar las reseñas dinámicamente en el servidor
$resenas = array_filter($_SESSION['todas_resenas'], function($item) use ($busqueda, $calificacion, $estado) {
    if (!empty($busqueda)) {
        $enBarrio     = mb_stripos($item['nombreBarrio'], $busqueda) !== false;
        $enComentario = mb_stripos($item['comentario'], $busqueda) !== false;
        if (!$enBarrio && !$enComentario) {
            return false;
        }
    }
    if ($calificacion > 0) {
        if ($item['calificacion'] != $calificacion) {
            return false;
        }
    }
    if ($estado !== 'todos') {
        if ($item['estado'] !== $estado) {
            return false;
        }
    }
    return true;
});
?>

<main class="resena-page">
  <div class="content-wrapper">
    
    <section class="intro-section">
      <h1>Comunidad y Reseñas</h1>
      <p>Selecciona tu barrio, califícalo y comparte tu experiencia con los vecinos.</p>
    </section>

    <!-- MENSAJES DE ÉXITO O ERROR AL PUBLICAR RESEÑA -->
    <?php if (!empty($exito_resena)): ?>
      <div class="feedback-banner banner-success" role="alert">
        <span class="material-symbols-outlined" style="color:#22c55e;">check_circle</span>
        <span><?= $exito_resena ?></span>
      </div>
    <?php endif; ?>

    <?php if (!empty($errores_resena)): ?>
      <div class="feedback-banner banner-error" role="alert">
        <span class="material-symbols-outlined" style="color:#ef4444;">error</span>
        <div>
          <strong>Corrige los siguientes errores:</strong>
          <ul style="margin:4px 0 0 16px; padding:0;">
            <?php foreach ($errores_resena as $e): ?>
              <li><?= $e ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endif; ?>

    <!-- FORMULARIO DE BÚSQUEDA Y FILTRADO POR GET (Requerimiento A) -->
    <form action="resenas.php" method="GET" class="filter-box-card">
      <div class="filter-grid-layout">
        
        <!-- Input de Búsqueda con persistencia y sanitización contra XSS -->
        <div class="filter-col search-col">
          <label for="qInput" class="filter-field-label">Buscar barrio o término</label>
          <div class="filter-input-container">
            <span class="material-symbols-outlined filter-icon">search</span>
            <input 
              type="text" 
              id="qInput" 
              name="q" 
              class="filter-text-input" 
              placeholder="Ej: Centro, iluminación, veredas..." 
              value="<?= $busqueda ?>"
            >
          </div>
        </div>

        <!-- Filtro por Calificación -->
        <div class="filter-col">
          <label for="califSelect" class="filter-field-label">Calificación</label>
          <select id="califSelect" name="calificacion" class="filter-select-input">
            <option value="0">Todas las estrellas</option>
            <option value="5" <?= $calificacion === 5 ? 'selected' : '' ?>>⭐⭐⭐⭐⭐ (5 estrellas)</option>
            <option value="4" <?= $calificacion === 4 ? 'selected' : '' ?>>⭐⭐⭐⭐ (4 estrellas)</option>
            <option value="3" <?= $calificacion === 3 ? 'selected' : '' ?>>⭐⭐⭐ (3 estrellas)</option>
            <option value="2" <?= $calificacion === 2 ? 'selected' : '' ?>>⭐⭐ (2 estrellas)</option>
            <option value="1" <?= $calificacion === 1 ? 'selected' : '' ?>>⭐ (1 estrella)</option>
          </select>
        </div>

        <!-- Filtro por Estado -->
        <div class="filter-col">
          <label for="estadoSelect" class="filter-field-label">Estado</label>
          <select id="estadoSelect" name="estado" class="filter-select-input">
            <option value="todos" <?= $estado === 'todos' ? 'selected' : '' ?>>Todos los estados</option>
            <option value="publicada" <?= $estado === 'publicada' ? 'selected' : '' ?>>Publicadas</option>
            <option value="moderada" <?= $estado === 'moderada' ? 'selected' : '' ?>>En Revisión</option>
          </select>
        </div>

        <!-- Botones de Acción -->
        <div class="filter-col actions-col">
          <button type="submit" class="btn-submit-filter">
            <span class="material-symbols-outlined" style="font-size:18px;">filter_alt</span>
            Consultar
          </button>
          <?php if ($filtros_activos): ?>
            <a href="resenas.php" class="btn-reset-filter" title="Restablecer filtros">
              Limpiar
            </a>
          <?php endif; ?>
        </div>

      </div>
    </form>

    <!-- MENSAJES DE RETROALIMENTACIÓN DE BÚSQUEDA (Requerimiento C) -->
    <?php if ($filtros_activos): ?>
      <div class="feedback-banner" role="status">
        <span class="material-symbols-outlined feedback-icon">info</span>
        <div class="feedback-text">
          <span>Filtros aplicados: </span>
          <?php if (!empty($busqueda)): ?>
            <span>Búsqueda: <strong>"<?= $busqueda ?>"</strong> | </span>
          <?php endif; ?>
          <?php if ($calificacion > 0): ?>
            <span>Calificación: <strong><?= $calificacion ?> estrellas</strong> | </span>
          <?php endif; ?>
          <?php if ($estado !== 'todos'): ?>
            <span>Estado: <strong><?= $estado === 'publicada' ? 'Publicadas' : 'En Revisión' ?></strong> | </span>
          <?php endif; ?>
          <span>Se encontraron <strong><?= count($resenas) ?></strong> reseña(s).</span>
        </div>
      </div>
    <?php endif; ?>

    <!-- LISTADO DE RESEÑAS O ESTADO VACÍO -->
    <div class="scrollable-container">
      <?php if (count($resenas) > 0): ?>
        <div class="resenas-grid">
          <?php foreach ($resenas as $item): ?>
            <div class="card-resena">
              <div class="card-top">
                <span class="tag-barrio"><?= htmlspecialchars($item['nombreBarrio'], ENT_QUOTES, 'UTF-8') ?></span>
                <span class="date"><?= htmlspecialchars($item['fecha'], ENT_QUOTES, 'UTF-8') ?></span>
              </div>
              
              <p class="comment">"<?= htmlspecialchars($item['comentario'], ENT_QUOTES, 'UTF-8') ?>"</p>
              
              <div class="stars-row">
                <?php for ($i = 0; $i < $item['calificacion']; $i++): ?>
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="#FFD700">
                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                  </svg>
                <?php endfor; ?>
              </div>
              <div class="status-badge <?= $item['estado'] === 'moderada' ? 'moderada' : '' ?>">
                <?= $item['estado'] === 'publicada' ? '&#10004; Publicada' : '&#9203; En Revisión' ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="empty-container">
          <span class="material-symbols-outlined" style="font-size: 54px; color: #94a3b8; margin-bottom: 12px;">search_off</span>
          <h2>No se encontraron reseñas</h2>
          <p>No hay opiniones que coincidan con los criterios de búsqueda.</p>
          <a href="resenas.php" class="btn-clear-empty">Ver todas las reseñas</a>
        </div>
      <?php endif; ?>
    </div> 
  </div>

  <!-- BOTÓN FLOTANTE INFERIOR: ABRE EL MODAL DE RESEÑAR -->
  <div class="fixed-footer">
    <button type="button" class="btn-main" onclick="abrirModalResena()">
      <span class="material-symbols-outlined" style="font-size: 22px;">rate_review</span> RESEÑAR MI BARRIO
    </button>
  </div>
</main>

<!-- MODAL PARA CALIFICAR Y PUBLICAR RESEÑA -->
<div class="modal-resena-overlay" id="modalResena" style="display: none;">
  <div class="modal-resena-card">
    
    <div class="modal-resena-header">
      <div>
        <h3 style="margin:0; font-size:1.2rem; font-weight:800;">Calificar mi Barrio</h3>
        <p style="margin:4px 0 0 0; font-size:0.85rem; color:#64748b;">Deja tu reseña para ayudar a la comunidad.</p>
      </div>
      <button type="button" class="btn-close-modal" onclick="cerrarModalResena()">✕</button>
    </div>

    <form action="resenas.php" method="POST" class="form-modal-resena" novalidate>
      <input type="hidden" name="accion_resena" value="1">
      <input type="hidden" name="estrellas_resena" id="inputEstrellas" value="5">

      <div class="input-group-modal">
        <label for="barrioSelectModal">SELECCIONA TU BARRIO</label>
        <select name="barrio_resena" id="barrioSelectModal" class="input-modal-control" required>
          <option value="">-- Elige un barrio de Salta --</option>
          <?php foreach ($barrios_salta as $b): ?>
            <option value="<?= $b ?>"><?= $b ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="input-group-modal">
        <label>CALIFICACIÓN</label>
        <div class="star-rating-selector" id="starSelector">
          <span class="star-btn active" data-val="1" onclick="setRating(1)">&#9733;</span>
          <span class="star-btn active" data-val="2" onclick="setRating(2)">&#9733;</span>
          <span class="star-btn active" data-val="3" onclick="setRating(3)">&#9733;</span>
          <span class="star-btn active" data-val="4" onclick="setRating(4)">&#9733;</span>
          <span class="star-btn active" data-val="5" onclick="setRating(5)">&#9733;</span>
          <span class="rating-label" id="ratingLabel">5 de 5 estrellas</span>
        </div>
      </div>

      <div class="input-group-modal">
        <label for="comentarioModal">TU RESEÑA / OPINIÓN</label>
        <textarea 
          name="comentario_resena" 
          id="comentarioModal" 
          class="input-modal-control" 
          placeholder="Cuéntanos cómo está la limpieza, alumbrado, seguridad o calles en tu barrio..." 
          rows="4" 
          required
        ></textarea>
      </div>

      <div class="modal-actions-row">
        <button type="button" class="btn-modal-cancel" onclick="cerrarModalResena()">Cancelar</button>
        <button type="submit" class="btn-modal-submit">Publicar Reseña</button>
      </div>
    </form>

  </div>
</div>

<style>
/* Estilos para filtros GET */
.filter-box-card {
  background-color: #f8fafc;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 14px 16px;
  margin-bottom: 18px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}

.filter-grid-layout {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  align-items: flex-end;
}

.filter-col {
  flex: 1;
  min-width: 140px;
}

.filter-col.search-col {
  flex: 2;
  min-width: 200px;
}

.filter-field-label {
  display: block;
  font-size: 0.78rem;
  font-weight: 700;
  color: #64748b;
  margin-bottom: 6px;
  text-transform: uppercase;
}

.filter-input-container {
  display: flex;
  align-items: center;
  background-color: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 10px;
  padding: 0 10px;
  height: 40px;
}

.filter-icon {
  color: #94a3b8;
  font-size: 20px;
  margin-right: 6px;
}

.filter-text-input {
  border: none;
  background: transparent;
  outline: none;
  width: 100%;
  font-size: 0.88rem;
  color: #334155;
  font-family: inherit;
}

.filter-select-input {
  width: 100%;
  height: 40px;
  background-color: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 10px;
  padding: 0 10px;
  font-size: 0.85rem;
  color: #334155;
  outline: none;
  cursor: pointer;
  font-family: inherit;
}

.actions-col {
  display: flex;
  gap: 8px;
  flex: 0 0 auto;
}

.btn-submit-filter {
  height: 40px;
  padding: 0 16px;
  background-color: #005fa3;
  color: #ffffff;
  border: none;
  border-radius: 10px;
  font-size: 0.88rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.btn-submit-filter:hover {
  background-color: #004b82;
}

.btn-reset-filter {
  height: 40px;
  padding: 0 14px;
  background-color: #e2e8f0;
  color: #475569;
  border-radius: 10px;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.85rem;
  font-weight: 600;
  transition: background-color 0.2s;
}

.btn-reset-filter:hover {
  background-color: #cbd5e1;
}

.feedback-banner {
  background-color: #e0f2fe;
  border: 1px solid #7dd3fc;
  color: #0369a1;
  border-radius: 12px;
  padding: 12px 16px;
  margin-bottom: 16px;
  font-size: 0.88rem;
  display: flex;
  align-items: center;
  gap: 10px;
  animation: fadeIn 0.3s ease;
}

.banner-success {
  background-color: #f0fdf4 !important;
  border-color: #86efac !important;
  color: #166534 !important;
}

.banner-error {
  background-color: #fef2f2 !important;
  border-color: #fca5a5 !important;
  color: #991b1b !important;
}

.feedback-icon {
  font-size: 20px;
  flex-shrink: 0;
}

.btn-clear-empty {
  display: inline-block;
  margin-top: 14px;
  padding: 8px 18px;
  background-color: #005fa3;
  color: white;
  border-radius: 20px;
  text-decoration: none;
  font-size: 0.85rem;
  font-weight: 600;
}

/* MODAL DE RESEÑA */
.modal-resena-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.65);
  z-index: 3000;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  backdrop-filter: blur(5px);
  animation: fadeIn 0.25s ease;
}

.modal-resena-card {
  background: #ffffff;
  border-radius: 24px;
  padding: 24px 28px;
  width: 100%;
  max-width: 500px;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  animation: slideUpModal 0.3s ease-out;
}

@keyframes slideUpModal {
  from { transform: translateY(30px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

.modal-resena-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 18px;
  border-bottom: 1px solid #e2e8f0;
  padding-bottom: 12px;
}

.btn-close-modal {
  background: none;
  border: none;
  font-size: 20px;
  color: #94a3b8;
  cursor: pointer;
  padding: 4px;
}

.btn-close-modal:hover {
  color: #334155;
}

.input-group-modal {
  margin-bottom: 16px;
}

.input-group-modal label {
  display: block;
  font-size: 0.78rem;
  font-weight: 700;
  color: #64748b;
  margin-bottom: 6px;
  text-transform: uppercase;
}

.input-modal-control {
  width: 100%;
  padding: 10px 14px;
  border-radius: 12px;
  border: 1px solid #cbd5e1;
  background-color: #f8fafc;
  color: #1e293b;
  font-family: inherit;
  font-size: 0.92rem;
  outline: none;
}

.input-modal-control:focus {
  border-color: #005fa3;
  background-color: #ffffff;
}

.star-rating-selector {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 6px 0;
}

.star-btn {
  font-size: 32px;
  color: #cbd5e1;
  cursor: pointer;
  transition: transform 0.15s, color 0.15s;
  user-select: none;
  line-height: 1;
}

.star-btn.active {
  color: #f59e0b;
}

.star-btn:hover {
  transform: scale(1.15);
}

.rating-label {
  font-size: 0.88rem;
  font-weight: 600;
  color: #64748b;
  margin-left: 8px;
}

.modal-actions-row {
  display: flex;
  gap: 12px;
  margin-top: 22px;
}

.btn-modal-cancel {
  flex: 1;
  padding: 12px;
  background: #f1f5f9;
  color: #64748b;
  border: none;
  border-radius: 12px;
  font-weight: 700;
  font-size: 0.9rem;
  cursor: pointer;
}

.btn-modal-submit {
  flex: 2;
  padding: 12px;
  background: #005fa3;
  color: white;
  border: none;
  border-radius: 12px;
  font-weight: 700;
  font-size: 0.9rem;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0, 95, 163, 0.25);
}

.btn-modal-submit:hover {
  background: #004b82;
}

/* MODO OSCURO */
body.dark-mode .filter-box-card {
  background-color: #1e293b;
  border-color: #334155;
}

body.dark-mode .filter-input-container,
body.dark-mode .filter-select-input {
  background-color: #0f172a;
  border-color: #334155;
  color: #f1f5f9;
}

body.dark-mode .filter-text-input {
  color: #f1f5f9;
}

body.dark-mode .feedback-banner {
  background-color: rgba(14, 165, 233, 0.15);
  border-color: #0284c7;
  color: #7dd3fc;
}

body.dark-mode .banner-success {
  background-color: rgba(34, 197, 94, 0.15) !important;
  border-color: #22c55e !important;
  color: #86efac !important;
}

body.dark-mode .banner-error {
  background-color: rgba(239, 68, 68, 0.15) !important;
  border-color: #ef4444 !important;
  color: #fca5a5 !important;
}

body.dark-mode .btn-reset-filter {
  background-color: #334155;
  color: #cbd5e1;
}

body.dark-mode .modal-resena-card {
  background-color: #1e293b;
  color: #f1f5f9;
}

body.dark-mode .modal-resena-header {
  border-color: #334155;
}

body.dark-mode .input-modal-control {
  background-color: #0f172a;
  border-color: #334155;
  color: #f1f5f9;
}

body.dark-mode .btn-modal-cancel {
  background: #334155;
  color: #cbd5e1;
}

body.dark-mode .btn-modal-submit {
  background: #38bdf8;
  color: #0f172a;
}
</style>

<script>
function abrirModalResena() {
    document.getElementById('modalResena').style.display = 'flex';
}

function cerrarModalResena() {
    document.getElementById('modalResena').style.display = 'none';
}

function setRating(val) {
    document.getElementById('inputEstrellas').value = val;
    document.getElementById('ratingLabel').innerText = val + ' de 5 estrellas';
    var stars = document.querySelectorAll('.star-btn');
    stars.forEach(function(s) {
        var starVal = parseInt(s.getAttribute('data-val'));
        if (starVal <= val) {
            s.classList.add('active');
        } else {
            s.classList.remove('active');
        }
    });
}
</script>

<?php require_once '../includes/footer.php'; ?>
