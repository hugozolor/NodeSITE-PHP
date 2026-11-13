<?php 
$titulo_pagina = "Historial - NodeSite";
$pagina_actual = "historial";
require_once '../includes/header.php'; 
require_once '../includes/nav.php'; 
?>

<div class="main-viewport">


<div class="historial-wrapper fade-in">
    <div class="main-container">
        
        <header class="historial-header">
            <div class="header-title-row">
                <h2 class="title-main">Historial</h2>
            </div>

            <div class="tabs-container">
                <button class="tab-btn"  >
                    PINES
                </button>
                <button class="tab-btn"  >
                    RESEÑAS
                </button>
            </div>
        </header>

        <div class="filters-section" >
            <div class="custom-dropdown">
                <button class="dropdown-trigger" >
                    <span class="filter-label">
                        <span class="material-symbols-outlined">swap_vert</span>
                        
                    </span>
                    <span class="material-symbols-outlined">expand_more</span>
                </button>
                
                <div class="dropdown-menu" >
                    <button class="dropdown-item"  >
                        Más recientes primero
                    </button>
                    <button class="dropdown-item"  >
                        Más antiguos primero
                    </button>
                </div>
            </div>
        </div>

        <div class="empty-state" >
            <div class="empty-icon-container">
                <span class="material-symbols-outlined">history</span>
            </div>
            <h3>Aún no hay publicaciones registradas.</h3>
            <p>Cuando realices tu primera publicación, aparecerá aquí.</p>
        </div>

        <section class="historial-scroll-area" >
            
            <ng-container >
                <div class="card premium-card" >
                    <div class="card-top-bar">
                        <span class="date"></span>
                    </div>

                    <div class="pin-body-layout">
                        <div class="zone-left">
                            <div class="icon-wrapper">
                                <img  alt="Icono Pin" class="custom-svg-icon">
                            </div>
                            <span class="pin-type-name"></span>
                        </div>

                        <div class="zone-center">
                            <p class="description" >
                                
                            </p>
                            <button class="btn-expand"  >
                                
                            </button>
                        </div>

                        <div class="zone-right" >
                            <div class="image-carousel" (scroll)="onCarouselScroll($event, pin.id)">
                                <img   alt="Evidencia" loading="lazy" class="carousel-img">
                            </div>
                            
                            <div class="carousel-indicators" >
                                <span class="dot" 
                                      
                                      >
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </ng-container>

            <ng-container >
                <div class="card premium-card" >
                    <div class="review-header">
                        <div class="review-left">
                            <div class="material-icon-wrapper">
                                <span class="material-symbols-outlined"></span>
                            </div>
                            <span class="neighborhood-name"></span>
                        </div>
                        <span class="date"></span>
                    </div>
                    
                    <div class="review-body">
                        <p class="description" style="-webkit-line-clamp: unset;">
                            
                        </p>
                    </div>

                    <div class="review-footer">
                        <div class="stars-container">
                            <span class="material-symbols-outlined">
                                star
                            </span>
                        </div>
                    </div>
                </div>
            </ng-container>

        </section>
    </div>
</div>


</div>

<?php require_once '../includes/footer.php'; ?>