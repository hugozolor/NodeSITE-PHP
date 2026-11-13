<?php 
$titulo_pagina = "Nuevo Reporte - NodeSite";
$pagina_actual = "publicar";
require_once '../includes/header.php';
require_once '../includes/nav.php';

// Inicialización de variables para retroalimentación y persistencia
$errores = [];
$mensaje_exito = "";

$tipo_reporte = "";
$barrio = "";
$email = "";
$descripcion = "";

$nuevo_pin_tipo = "";
$nuevo_pin_barrio = "";
$nuevo_pin_desc = "";

// PROCESAMIENTO DINÁMICO DEL FORMULARIO POR POST (Requerimiento A y B)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitización estricta de entradas (OWASP - Prevención de XSS)
    $tipo_reporte = htmlspecialchars(trim($_POST['tipo_reporte'] ?? ''), ENT_QUOTES, 'UTF-8');
    $barrio       = htmlspecialchars(trim($_POST['barrio'] ?? ''), ENT_QUOTES, 'UTF-8');
    
    // Captura y sanitización de correo electrónico
    $email_raw    = trim($_POST['email'] ?? '');
    $email        = htmlspecialchars($email_raw, ENT_QUOTES, 'UTF-8');
    
    $descripcion  = htmlspecialchars(trim($_POST['descripcion'] ?? ''), ENT_QUOTES, 'UTF-8');

    // 2. Validación en el Servidor (empty, isset, formatos específicos)
    if (empty($tipo_reporte)) {
        $errores[] = "Debe seleccionar un tipo de reporte (Bache, Alumbrado, Basura, etc.).";
    }

    if (empty($barrio)) {
        $errores[] = "El campo 'Barrio o Ubicación' es obligatorio.";
    } elseif (mb_strlen($barrio) < 3) {
        $errores[] = "El nombre del barrio o ubicación debe contener al menos 3 caracteres.";
    }

    if (empty($email_raw)) {
        $errores[] = "El correo electrónico es obligatorio para el seguimiento del reporte.";
    } elseif (!filter_var($email_raw, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico ingresado no tiene un formato válido (ejemplo: vecino@dominio.com).";
    }

    if (empty($descripcion)) {
        $errores[] = "La descripción del problema es obligatoria.";
    } elseif (mb_strlen($descripcion) < 10) {
        $errores[] = "La descripción debe tener al menos 10 caracteres para explicar la situación.";
    }

    // 3. Resultado del procesamiento (Requerimiento C: Retroalimentación y Paso a Ubicación en Mapa)
    if (empty($errores)) {
        $mensaje_exito = "¡Datos guardados con éxito! Ahora selecciona la ubicación exacta en el mapa para publicar tu reporte.";
        
        $nuevo_pin_tipo = $tipo_reporte;
        $nuevo_pin_barrio = $barrio;
        $nuevo_pin_desc = $descripcion;

        $tipo_reporte = "";
        $barrio = "";
        $email = "";
        $descripcion = "";
    }
}
?>

<div class="main-container">
  <div class="white-sheet">
    <div class="sheet-content">
      <h2>Nuevo Reporte</h2>
      <hr style="opacity: 0.1; margin-bottom: 20px;">

      <!-- MENSAJES DE RETROALIMENTACIÓN AL USUARIO (Requerimiento C) -->
      <?php if (!empty($errores)): ?>
        <div class="alert-box alert-error" role="alert">
          <div class="alert-title">
            <span class="material-symbols-outlined">error</span>
            <strong>Por favor, revise los siguientes campos:</strong>
          </div>
          <ul class="alert-list">
            <?php foreach ($errores as $err): ?>
              <li><?= $err ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if (!empty($mensaje_exito)): ?>
        <div class="alert-box alert-success" role="alert">
          <div class="alert-title">
            <span class="material-symbols-outlined" style="font-size: 26px;">check_circle</span>
            <div>
              <span><?= $mensaje_exito ?></span>
              <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <a href="mapa.php?modo=elegir_ubicacion&tipo=<?= urlencode($nuevo_pin_tipo) ?>&barrio=<?= urlencode($nuevo_pin_barrio) ?>&desc=<?= urlencode($nuevo_pin_desc) ?>" class="btn-ir-mapa" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background-color: #005fa3; color: white; border-radius: 10px; text-decoration: none; font-size: 0.88rem; font-weight: 700;">
                  <span class="material-symbols-outlined" style="font-size: 18px;">pin_drop</span> Elegir ubicación en el Mapa →
                </a>
                <span style="font-size: 0.78rem; color: #166534; font-weight: 600;">(Redirigiendo al mapa en 2 segundos...)</span>
              </div>
            </div>
          </div>
        </div>

        <script>
          setTimeout(function() {
            window.location.href = "mapa.php?modo=elegir_ubicacion&tipo=<?= urlencode($nuevo_pin_tipo) ?>&barrio=<?= urlencode($nuevo_pin_barrio) ?>&desc=<?= urlencode($nuevo_pin_desc) ?>";
          }, 2500);
        </script>
      <?php endif; ?>
      
      <div class="selector-container" id="selectorPin">
        <label class="label-titulo" style="font-size: 0.85rem; color: #64748b; font-weight: 700; margin-bottom: 15px; display: block;">SELECCIONA EL TIPO DE REPORTE</label>
        
        <div class="scroll-wrapper" style="overflow-x: auto; padding-bottom: 10px;">
          <div class="pines-grid" style="display: flex; gap: 15px; min-width: max-content;">
            
            <div class="pin-item <?= $tipo_reporte === 'Bache' ? 'selected' : '' ?>" onclick="seleccionarPin(this, 'Bache')" style="display:flex; flex-direction:column; align-items:center; gap:8px; cursor:pointer; padding:10px; border-radius:12px; transition:all 0.3s; border:2px solid transparent;">
              <div class="icon-circle" style="width: 50px; height: 50px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="color:#333;">warning</span>
              </div>
              <span class="pin-name" style="font-size:0.85rem; font-weight:600;">Bache</span>
            </div>

            <div class="pin-item <?= $tipo_reporte === 'Alumbrado' ? 'selected' : '' ?>" onclick="seleccionarPin(this, 'Alumbrado')" style="display:flex; flex-direction:column; align-items:center; gap:8px; cursor:pointer; padding:10px; border-radius:12px; transition:all 0.3s; border:2px solid transparent;">
              <div class="icon-circle" style="width: 50px; height: 50px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="color:#333;">lightbulb</span>
              </div>
              <span class="pin-name" style="font-size:0.85rem; font-weight:600;">Alumbrado</span>
            </div>

            <div class="pin-item <?= $tipo_reporte === 'Basura' ? 'selected' : '' ?>" onclick="seleccionarPin(this, 'Basura')" style="display:flex; flex-direction:column; align-items:center; gap:8px; cursor:pointer; padding:10px; border-radius:12px; transition:all 0.3s; border:2px solid transparent;">
              <div class="icon-circle" style="width: 50px; height: 50px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="color:#333;">delete</span>
              </div>
              <span class="pin-name" style="font-size:0.85rem; font-weight:600;">Basura</span>
            </div>

            <div class="pin-item <?= $tipo_reporte === 'Tránsito' ? 'selected' : '' ?>" onclick="seleccionarPin(this, 'Tránsito')" style="display:flex; flex-direction:column; align-items:center; gap:8px; cursor:pointer; padding:10px; border-radius:12px; transition:all 0.3s; border:2px solid transparent;">
              <div class="icon-circle" style="width: 50px; height: 50px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="color:#333;">traffic</span>
              </div>
              <span class="pin-name" style="font-size:0.85rem; font-weight:600;">Tránsito</span>
            </div>
            
          </div>
        </div>
      </div>

      <!-- FORMULARIO DE ENVÍO POR POST CON PERSISTENCIA DE DATOS -->
      <form action="publicar.php" method="POST" class="form-container" id="formContainer" novalidate style="<?= (!empty($errores) || !empty($tipo_reporte)) ? 'display: block;' : 'display: none;' ?>">
        
        <input type="hidden" name="tipo_reporte" id="tipoReporteInput" value="<?= $tipo_reporte ?>">

        <div class="input-group" style="margin-top: 15px;">
          <label for="barrioInput" style="font-size: 0.85rem; color: #64748b; font-weight: 700; display:block; margin-bottom: 8px;">BARRIO O UBICACIÓN <span style="color:#ef4444;">*</span></label>
          <input 
            type="text" 
            id="barrioInput" 
            name="barrio" 
            class="form-control-input" 
            placeholder="Ej: Barrio Norte, Av. Belgrano 1200..." 
            value="<?= $barrio ?>" 
            required
          >
        </div>

        <div class="input-group" style="margin-top: 15px;">
          <label for="emailInput" style="font-size: 0.85rem; color: #64748b; font-weight: 700; display:block; margin-bottom: 8px;">CORREO ELECTRÓNICO DE CONTACTO <span style="color:#ef4444;">*</span></label>
          <input 
            type="email" 
            id="emailInput" 
            name="email" 
            class="form-control-input" 
            placeholder="vecino@ejemplo.com" 
            value="<?= $email ?>" 
            required
          >
          <small style="color: #94a3b8; font-size: 0.78rem;">Se utilizará para notificarle sobre el estado de la resolución.</small>
        </div>

        <div class="input-group" style="margin-top: 15px;">
          <label for="descText" style="font-size: 0.85rem; color: #64748b; font-weight: 700; display:block; margin-bottom: 8px;">DESCRIPCIÓN DEL PROBLEMA <span style="color:#ef4444;">*</span></label>
          <textarea 
            id="descText" 
            name="descripcion" 
            placeholder="Describa el inconveniente detalladamente (mínimo 10 caracteres)..." 
            required
          ><?= $descripcion ?></textarea>
        </div>

        <div class="fotos-section" style="margin-top: 20px;">
          <label style="font-size: 0.85rem; color: #64748b; font-weight: 700; display:block; margin-bottom: 8px;">FOTOS DEL REPORTE (OPCIONAL, MÁXIMO 3)</label>
          <div class="fotos-grid">
            <label class="foto-box">
              <span style="font-size: 28px; color: #cbd5e1;">+</span>
              <input type="file" hidden accept="image/*" onchange="fotoSeleccionada(this)">
            </label>
            <label class="foto-box">
              <span style="font-size: 28px; color: #cbd5e1;">+</span>
              <input type="file" hidden accept="image/*" onchange="fotoSeleccionada(this)">
            </label>
            <label class="foto-box">
              <span style="font-size: 28px; color: #cbd5e1;">+</span>
              <input type="file" hidden accept="image/*" onchange="fotoSeleccionada(this)">
            </label>
          </div>
        </div>

        <button type="submit" class="btn-publicar" id="btnPublicar" style="cursor:pointer; width:100%; border:none;">
          Publicar Reporte (POST)
        </button>
      </form>

    </div>
  </div>
</div>

<style>
.alert-box {
  padding: 14px 18px;
  border-radius: 12px;
  margin-bottom: 20px;
  font-size: 0.9rem;
  line-height: 1.5;
  animation: fadeIn 0.3s ease-in-out;
}
.alert-title {
  display: flex;
  align-items: center;
  gap: 10px;
}
.alert-title .material-symbols-outlined {
  font-size: 22px;
}
.alert-error {
  background-color: #fef2f2;
  border: 1px solid #f87171;
  color: #991b1b;
}
.alert-success {
  background-color: #f0fdf4;
  border: 1px solid #4ade80;
  color: #166534;
}
.alert-list {
  margin: 8px 0 0 32px;
  padding: 0;
}
.alert-list li {
  margin-bottom: 4px;
}
.form-control-input {
  width: 100%;
  height: 44px;
  border-radius: 12px;
  border: 1px solid rgba(128, 128, 128, 0.25);
  background-color: rgba(128, 128, 128, 0.06);
  padding: 0 14px;
  font-size: 0.95rem;
  color: inherit;
  font-family: inherit;
  outline: none;
  transition: border-color 0.2s;
}
.form-control-input:focus {
  border-color: #005fa3;
}
.pin-item.selected {
  border-color: #005fa3 !important;
  background-color: rgba(0, 95, 163, 0.08);
}
.pin-item.selected .icon-circle {
  background-color: #005fa3 !important;
}
.pin-item.selected .material-symbols-outlined {
  color: white !important;
}

/* Modo oscuro */
body.dark-mode .alert-error {
  background-color: rgba(239, 68, 68, 0.15);
  border-color: #ef4444;
  color: #fca5a5;
}
body.dark-mode .alert-success {
  background-color: rgba(34, 197, 94, 0.15);
  border-color: #22c55e;
  color: #86efac;
}
body.dark-mode .alert-success span {
  color: #86efac;
}
body.dark-mode .form-control-input {
  border-color: rgba(255, 255, 255, 0.15);
  background-color: rgba(255, 255, 255, 0.05);
  color: #f1f5f9;
}
body.dark-mode .form-control-input:focus {
  border-color: #38bdf8;
}
body.dark-mode .pin-item.selected {
  border-color: #38bdf8 !important;
  background-color: rgba(56, 189, 248, 0.12);
}
body.dark-mode .pin-item.selected .icon-circle {
  background-color: #38bdf8 !important;
}
</style>

<script>
function seleccionarPin(elemento, tipo) {
    var items = document.querySelectorAll('.pin-item');
    items.forEach(function(item) { item.classList.remove('selected'); });
    
    elemento.classList.add('selected');
    document.getElementById('tipoReporteInput').value = tipo;
    
    var form = document.getElementById('formContainer');
    if (form.style.display === 'none') {
        form.style.display = 'block';
        form.animate([
            { transform: 'translateY(15px)', opacity: 0 },
            { transform: 'translateY(0)', opacity: 1 }
        ], { duration: 250, easing: 'ease-out' });
    }
}

function fotoSeleccionada(input) {
    if (input.files && input.files[0]) {
        var span = input.previousElementSibling;
        span.innerHTML = '✔';
        span.style.color = '#10EB2C';
        span.style.fontSize = '24px';
    }
}
</script>

<?php require_once '../includes/footer.php'; ?>
