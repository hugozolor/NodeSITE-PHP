// js/components/carousel.js
var currentSlide = 0;
var slideTimer;
var slidesData = [
  { title: 'Nueva Luminaria LED', desc: 'Mejoramos la iluminación en Barrio Norte para mayor seguridad.', type: 'IMPORTANTE' },
  { title: 'Tip de Seguridad', desc: 'Reporta baches en menos de 30 segundos.', type: 'Tip' }
];
function renderCarousel() {
    var track = document.getElementById('carouselTrack');
    if (!track) return;
    var html = '';
    for(var i=0; i<slidesData.length; i++) {
        var slide = slidesData[i];
        html += '<div class="slide" style="flex: 0 0 100%; width: 100%; text-align: center;">' +
               '<div class="slide-card info">' +
               '<span class="slide-badge" style="background:#fee2e2; color:#dc2626; padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; font-weight: bold; margin-bottom: 10px; display: inline-block;">' + slide.type + '</span>' +
               '<div class="noticia-titulo" style="font-size: 1.25rem; font-weight: bold; color: #1e293b; margin-bottom: 5px;">' + slide.title + '</div>' +
               '<p class="noticia-desc" style="color: #64748b; font-size: 0.95rem; margin: 0;">' + slide.desc + '</p>' +
               '</div></div>';
    }
    track.innerHTML = html;
    updateCarouselPosition();
}
function updateCarouselPosition() {
    var track = document.getElementById('carouselTrack');
    if (track) { track.style.transform = 'translateX(-' + (currentSlide * 100) + '%)'; }
}
function prevSlide() {
    stopCarousel();
    currentSlide = (currentSlide - 1 + slidesData.length) % slidesData.length;
    updateCarouselPosition();
    startCarousel();
}
function nextSlide() {
    stopCarousel();
    currentSlide = (currentSlide + 1) % slidesData.length;
    updateCarouselPosition();
    startCarousel();
}
function startCarousel() {
    stopCarousel();
    slideTimer = setInterval(function() {
        currentSlide = (currentSlide + 1) % slidesData.length;
        updateCarouselPosition();
    }, 5000);
}
function stopCarousel() {
    if (slideTimer) clearInterval(slideTimer);
}