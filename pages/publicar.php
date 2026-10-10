<?php 
$titulo_pagina = "Nuevo Reporte - NodeSite";
$pagina_actual = "publicar";
require_once '../includes/header.php';
require_once '../includes/nav.php';
?>

<div class="main-container">
  <div class="white-sheet">
    <div class="sheet-content">
      <h2>Nuevo Reporte</h2>
      <hr style="opacity: 0.1; margin-bottom: 20px;">
      
      <div class="selector-container" id="selectorPin">
        <label class="label-titulo" style="font-size: 0.85rem; color: #64748b; font-weight: 700; margin-bottom: 15px; display: block;">SELECCIONA EL TIPO DE REPORTE</label>
        
        <div class="scroll-wrapper" style="overflow-x: auto; padding-bottom: 10px;">
          <div class="pines-grid" style="display: flex; gap: 15px; min-width: max-content;">
            
            <div class="pin-item" onclick="seleccionarPin(this)" style="display:flex; flex-direction:column; align-items:center; gap:8px; cursor:pointer; padding:10px; border-radius:12px; transition:all 0.3s; border:2px solid transparent;">
              <div class="icon-circle" style="width: 50px; height: 50px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="color:#333;">warning</span>
              </div>
              <span class="pin-name" style="font-size:0.85rem; font-weight:600;">Bache</span>
            </div>

            <div class="pin-item" onclick="seleccionarPin(this)" style="display:flex; flex-direction:column; align-items:center; gap:8px; cursor:pointer; padding:10px; border-radius:12px; transition:all 0.3s; border:2px solid transparent;">
              <div class="icon-circle" style="width: 50px; height: 50px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="color:#333;">lightbulb</span>
              </div>
              <span class="pin-name" style="font-size:0.85rem; font-weight:600;">Alumbrado</span>
            </div>

            <div class="pin-item" onclick="seleccionarPin(this)" style="display:flex; flex-direction:column; align-items:center; gap:8px; cursor:pointer; padding:10px; border-radius:12px; transition:all 0.3s; border:2px solid transparent;">
              <div class="icon-circle" style="width: 50px; height: 50px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                <span class="material-symbols-outlined" style="color:#333;">delete</span>
              </div>
              <span class="pin-name" style="font-size:0.85rem; font-weight:600;">Basura</span>
            </div>
            
          </div>
        </div>
      </div>

      <div class="form-container" id="formContainer" style="display: none;">
        
        <div class="input-group" style="margin-top: 20px;">
          <label style="font-size: 0.85rem; color: #64748b; font-weight: 700; display:block; margin-bottom: 8px;">DESCRIPCIÓN DEL PROBLEMA</label>
          <textarea id="descText" placeholder="¿Qué está pasando?" oninput="validarFormulario()"></textarea>
        </div>

        <div class="fotos-section" style="margin-top: 20px;">
          <label style="font-size: 0.85rem; color: #64748b; font-weight: 700; display:block; margin-bottom: 8px;">FOTOS (MÁXIMO 3)</label>
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

        <button class="btn-publicar" id="btnPublicar" disabled onclick="alert('Funcionalidad de publicación conectada correctamente.');">
          Publicar
        </button>
      </div>

    </div>
  </div>
</div>

<style>
.pin-item.selected {
  border-color: #005fa3 !important;
  background-color: rgba(0, 95, 163, 0.05);
}
.pin-item.selected .icon-circle {
  background-color: #005fa3 !important;
}
.pin-item.selected .material-symbols-outlined {
  color: white !important;
}
body.dark-mode .pin-item.selected {
  border-color: #38bdf8 !important;
  background-color: rgba(56, 189, 248, 0.1);
}
body.dark-mode .pin-item.selected .icon-circle {
  background-color: #38bdf8 !important;
}
</style>

<script>
function seleccionarPin(elemento) {
    // Quitar 'selected' a todos
    var items = document.querySelectorAll('.pin-item');
    items.forEach(function(item) { item.classList.remove('selected'); });
    
    // Asignar al clicado
    elemento.classList.add('selected');
    
    // Mostrar formulario
    var form = document.getElementById('formContainer');
    if (form.style.display === 'none') {
        form.style.display = 'block';
        // Animación simple CSS inline para deslizar hacia arriba
        form.animate([
            { transform: 'translateY(20px)', opacity: 0 },
            { transform: 'translateY(0)', opacity: 1 }
        ], { duration: 300, easing: 'ease-out' });
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

function validarFormulario() {
    var text = document.getElementById('descText').value;
    var btn = document.getElementById('btnPublicar');
    btn.disabled = text.trim() === '';
}
</script>

<?php require_once '../includes/footer.php'; ?>