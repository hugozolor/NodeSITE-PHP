<?php 
$titulo_pagina = "Mi Cuenta - NodeSite";
$pagina_actual = "mi-cuenta";
require_once '../includes/header.php'; 
require_once '../includes/nav.php'; 
?>

<div class="main-viewport">


<div class="main-viewport-wrapper">
    <div class="main-container">
        <nav class="breadcrumb">
            <span class="root">Configuración</span>
            <span class="material-symbols-outlined">chevron_right</span>
            <span class="current">Mi cuenta</span>
        </nav>

        <section class="account-card">
            <div class="field-group">
                <label for="username"><span class="material-symbols-outlined">badge</span> Nombre de usuario</label>
                <input type="text" id="username"  readonly class="readonly-input">
            </div>

            <div class="field-group">
                <label for="email"><span class="material-symbols-outlined">alternate_email</span> Correo electrónico</label>
                <input type="email" id="email"  readonly class="readonly-input">
            </div>

            <div class="field-group">
                <label for="currentPassword"><span class="material-symbols-outlined">lock_person</span> Contraseña</label>
                <div class="password-control">
                    <input type="password" id="currentPassword" value="********" readonly>
                    <button class="btn-change-trigger" >
                        
                    </button>
                </div>
            </div>

            <div class="expandable-section" >
                <div class="field-group">
                    <label for="newPassword"><span class="material-symbols-outlined">vpn_key</span> Nueva Contraseña</label>
                    <div class="password-input-wrapper">
                        <input id="newPassword"  placeholder="Ingresa tu nueva clave" >
                        <button class="btn-icon-eye" >
                            <span class="material-symbols-outlined"></span>
                        </button>
                    </div>
                </div>

                <div class="anses-notice-box">
                    <div class="anses-icon-container">
                        <span class="material-symbols-outlined">error_outline</span>
                    </div>
                    <div class="anses-content">
                        <h3>Aviso importante</h3>
                        <p>
                            Estás por actualizar tu contraseña de acceso. Para garantizar la protección de tu cuenta y asegurar que siempre puedas ingresar, te recomendamos elegir una combinación robusta y almacenarla de inmediato en un lugar seguro o en tu gestor de confianza.
                        </p>
                        <p style="margin-top: 10px;">
                            <span class="highlight-text">Ten en cuenta:</span> Por motivos de seguridad y encriptación de datos, esta contraseña será la única vía para validar tu identidad. Si la pierdes o la olvidas, podrías perder el acceso de forma permanente a la plataforma. Asegúrate de registrarla correctamente antes de confirmar el cambio.
                        </p>
                    </div>
                </div>

                <div class="confirmation-checkbox">
                    <label>
                        <input type="checkbox" >
                        <span>Entiendo que si olvido esta clave, no podré acceder a mi cuenta</span>
                    </label>
                </div>
            </div>

            <div class="actions-footer">
                <button class="btn-logout" >
                    <span class="material-symbols-outlined">logout</span> Cerrar sesión
                </button>
                
                <div class="right-actions">
                    <button class="btn-cancel" >Cancelar</button>
                    <button class="btn-update" 
                         
                        >
                        ACTUALIZAR
                    </button>
                </div>
            </div>
        </section>
    </div>
</div>


</div>

<?php require_once '../includes/footer.php'; ?>