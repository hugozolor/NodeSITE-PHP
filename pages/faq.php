<?php 
$titulo_pagina = "FAQ - NodeSite";
$pagina_actual = "faq";
require_once '../includes/header.php'; 
require_once '../includes/nav.php'; 
?>

<div class="main-viewport">
<div class="vista-faq-contenedor">
  <div class="contenedor-faq">
    <h1>Preguntas Frecuentes</h1>

    <div class="lista-acordeon">
      <div class="tarjeta-faq">
        <h3><span class="icono-pregunta">?</span> ¿Cómo publico un problema en mi barrio?</h3>
        <p>Es muy fácil. Vas a la sección "Publicar" del menú, completas el formulario con la dirección, el tipo de incidente (bache, luminaria, basura) y una breve descripción.</p>
      </div>

      <div class="tarjeta-faq">
        <h3><span class="icono-pregunta">?</span> ¿Quiénes pueden ver mis reportes públicos?</h3>
        <p>Todos los vecinos que ingresen a NodeSite pueden ver los pines en el mapa interactivo, al igual que los administradores del municipio.</p>
      </div>

      <div class="tarjeta-faq">
        <h3><span class="icono-pregunta">?</span> ¿Cuánto tiempo tarda la municipalidad en responder?</h3>
        <p>Los reportes se procesan diariamente. El tiempo de reparación varía según la urgencia del caso y la disponibilidad de las cuadrillas técnicas.</p>
      </div>

      <div class="tarjeta-faq">
        <h3><span class="icono-pregunta">?</span> ¿El servicio tiene algún costo?</h3>
        <p>No, NodeSite es una plataforma vecinal 100% gratuita destinada al beneficio de toda la comunidad.</p>
      </div>
    </div>
  </div>
</div>
</div>

<?php require_once '../includes/footer.php'; ?>