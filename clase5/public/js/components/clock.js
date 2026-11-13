// js/components/clock.js
function iniciarReloj() {
    var relojEl = document.getElementById('relojHeader');
    if (!relojEl) return;
    setInterval(function() {
        var ahora = new Date();
        relojEl.textContent = ahora.toLocaleString();
    }, 1000);
}