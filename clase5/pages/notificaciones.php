<?php 
$titulo_pagina = "Notificaciones - NodeSite";
$pagina_actual = "notificaciones";
require_once '../includes/header.php'; 
require_once '../includes/nav.php'; 
?>

<div class="main-viewport">


<div class="notifications-page">
  <div class="top-nav">
    <button class="back-btn" >
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M19 12H5M12 19l-7-7 7-7"/>
      </svg>
      <span>Volver</span>
    </button>
  </div>

  <div class="content-area" style="flex: 1; display: flex; flex-direction: column; position: relative; overflow: hidden;">
    
    
      

    <div class="filter-header" >
      <button mat-icon-button  class="filter-btn">
        <span class="material-symbols-outlined">filter_list</span>
      </button>
      
      <div class="mat-menu" style="display: none;">
        <button mat-menu-item >TODAS</button>
        <button mat-menu-item >INFO</button>
        <button mat-menu-item >SUCCESS</button>
        <button mat-menu-item >WARNING</button>
        <button mat-menu-item >BAN</button>
      </div>

      <h2 class="dynamic-title">
        
      </h2>
    </div>

    <div class="notifications-scroll-container">
      
        
          
          <div class="empty-state-container" >
            <span class="material-symbols-outlined">notifications_none</span>
            <p class="empty-text">ESTE ES EL CANAL DE COMUNICACION OFICIAL DE NODESITE. AUN NO HAS RECIBIDO NINGUN MENSAJE.</p>
          </div>
          
        
          
          <div class="notification-list" >
            
              <div class="notification-card">
                
                <div class="card-header">
                  <span class="badge" >
                    
                  </span>
                </div>
                
                <div class="card-body">
                  <h3 class="card-title"></h3>
                  <p class="card-desc"></p>
                </div>
                
                <div class="card-footer">
                  <span class="date-time">
                    
                  </span>
                </div>

              </div>

          </div>


    </div>
  </div>
</div>
</div>

<?php require_once '../includes/footer.php'; ?>