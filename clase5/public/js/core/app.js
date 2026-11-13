// js/core/app.js (Main Initializer)
function initApp() {
    if (typeof renderCarousel === 'function') renderCarousel();
    if (typeof startCarousel === 'function') startCarousel();
    if (typeof iniciarReloj === 'function') iniciarReloj();
}
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp);
} else {
    initApp();
}