// js/mapa.js

var map;
var todosLosPines = [
    {
      id: 'admin-1', lat: -24.7821, lng: -65.4232, tipo: 'Obra Vial', 
      iconoUrl: 'assets/icons/obra.png', 
      descripcion: 'Repavimentación oficial.',
      usuario: 'Municipalidad', esAdmin: true
    },
    {
      id: 'user-1', lat: -24.7850, lng: -65.4150, tipo: 'Bache', 
      iconoUrl: 'assets/icons/bache.png', 
      descripcion: 'Pozo peligroso en la esquina.',
      usuario: 'Juan Perez', esAdmin: false
    }
];
var marcadoresEnMapa = [];
var categoriaSeleccionada = 'Todas';

var temaClaro = 'https://basemaps.cartocdn.com/gl/voyager-gl-style/style.json';
var temaOscuro = 'https://basemaps.cartocdn.com/gl/dark-matter-gl-style/style.json';
var esModoOscuro = document.body.classList.contains('dark-mode');

function initMap() {
    var limitesSalta = [
      [-65.55, -24.95],
      [-65.30, -24.65] 
    ];

    map = new maplibregl.Map({
      container: 'map-container',
      style: esModoOscuro ? temaOscuro : temaClaro,
      center: [-65.4232, -24.7821], 
      zoom: 14,
      minZoom: 6,
      maxBounds: limitesSalta
    });

    map.on('load', function() {
        aplicarFiltros();
    });
}

function aplicarFiltros() {
    marcadoresEnMapa.forEach(function(marker) {
        marker.remove();
    });
    marcadoresEnMapa = [];

    var pinesFiltrados = todosLosPines;
    if (categoriaSeleccionada !== 'Todas') {
        pinesFiltrados = todosLosPines.filter(function(p) { return p.tipo === categoriaSeleccionada; });
    }

        pinesFiltrados.forEach(function(pin) {
        var outerEl = document.createElement('div');
        
        var innerEl = document.createElement('div');
        innerEl.className = 'custom-pin-wrapper anim-bounce';
        innerEl.innerHTML = '<svg viewBox="0 0 24 24" fill="' + (pin.esAdmin ? '#005fa3' : '#dc2626') + '" stroke="white" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>';
        
        outerEl.appendChild(innerEl);

        var popup = new maplibregl.Popup({ offset: 25 })
            .setHTML('<h3 style="margin:0 0 5px 0;font-size:16px;">' + pin.tipo + '</h3><p style="margin:0 0 10px 0;font-size:14px;color:#475569;">' + pin.descripcion + '</p><small style="color:#64748b;">Por: ' + pin.usuario + '</small>');

        var marker = new maplibregl.Marker({ element: outerEl })
            .setLngLat([pin.lng, pin.lat])
            .setPopup(popup)
            .addTo(map);

        marcadoresEnMapa.push(marker);
    });
}

function toggleFiltro() {
    var panel = document.getElementById('filterPanel');
    if (panel) {
        panel.classList.toggle('show');
    }
}

function seleccionarCategoria(categoria, boton) {
    categoriaSeleccionada = categoria;
    aplicarFiltros();
    
    var botones = document.querySelectorAll('.filter-chip');
    botones.forEach(function(btn) { btn.classList.remove('active'); });
    boton.classList.add('active');
}

// Ensure execution is safe whether deferred or direct
function launchMap() {
    if (document.getElementById('map-container') && typeof maplibregl !== 'undefined') {
        initMap();
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', launchMap);
} else {
    launchMap();
}

var observer = new MutationObserver(function() {
    var isDark = document.body.classList.contains('dark-mode');
    if (esModoOscuro !== isDark) {
        esModoOscuro = isDark;
        if (map) {
            map.setStyle(esModoOscuro ? temaOscuro : temaClaro);
        }
    }
});
observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });