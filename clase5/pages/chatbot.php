<?php 
$titulo_pagina = "Chatbot - NodeSite";
$pagina_actual = "chatbot";
require_once '../includes/header.php'; 
require_once '../includes/nav.php'; 
?>

<div class="main-viewport">


<div class="chatbot-wrapper">
  <div class="main-chat-area">
    
    <div class="chat-content-container" style="flex: 1; display: flex; flex-direction: column; position: relative; overflow: hidden;">
      
      
        

        <div class="welcome-container" style="flex: 1; display: flex; align-items: center; justify-content: center; overflow-y: auto; padding: 20px;">
          <div class="welcome-card" style="width: 100%; max-width: 400px;">
            <h3>Bienvenido al Chat de Nodesite</h3>
            <p>¿Alguna duda o solo querés charlar un rato? Nuestro bot no duerme.</p>
          </div>
        </div>

      <div class="chat-history" #scrollContainer 
           [style.display]="(chatbotService.messages$ | async)?.length === 0 ? 'none' : 'flex'"
           style="flex: 1; overflow-y: auto; padding: 20px; flex-direction: column; gap: 15px;">
        
        
          <div class="message-row" >
            <div class="bubble">
              
              <span class="time"></span>
            </div>
          </div>

          <div class="message-row bot">
            <div class="bubble typing">
              <span class="dot"></span>
              <span class="dot"></span>
              <span class="dot"></span>
            </div>
          </div>

      </div>
    </div>

    <footer class="input-bar">
      <div class="input-container">
        
        <textarea 
          rows="1"
           
          placeholder="Escribí tu mensaje..."
          
          
          class="auto-expand-input"
        ></textarea>
        
        <button  >
          <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
          </svg>
        </button>
      </div>
    </footer>

  </div>
</div>
</div>

<?php require_once '../includes/footer.php'; ?>