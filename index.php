<?php 
$titulo_pagina = "Inicio - NodeSite";
$pagina_actual = "home";
require_once 'includes/header.php'; 
?>
<div class="home-wrapper">
    <div class="background-container"></div>
    <div class="overlay neblina-general"></div>
    <div class="overlay neblina-superior"></div>
    <div class="overlay neblina-inferior"></div>

    <div class="ui-layer">
        <header class="header-top">
            <div class="logo-side">
                <img src="<?= BASE_URL ?>public/assets/NodesiteLogo.svg" alt="Logo" class="logo-img">
            </div>
            <a class="btn-login" href="<?= BASE_URL ?>pages/login.php" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">Iniciar sesión</a>
        </header>

        <section class="hero-branding">
            <h1 class="project-name">
                <span class="node">NODE</span><span class="site">site</span>
            </h1>
        </section>

        <main class="content-bottom">
            <div class="text-info">
                <h2 class="title-main">Comienza a disfrutar</h2>
                <p class="description-text">
                    Que un caño roto o una calle en sombras no te arruinen la vuelta a casa. 
                    Hacé que tu reporte brille.
                </p>
            </div>
            
            <a class="btn-start" href="<?= BASE_URL ?>pages/dashboard.php" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">Comenzar</a>

            <p class="footer-action">
                ¿No tienes una cuenta? 
                <a href="<?= BASE_URL ?>pages/register.php" class="link-registro" style="text-decoration:none;">Registrarse</a>
            </p>
        </main>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>