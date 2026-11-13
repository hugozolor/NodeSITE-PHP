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

// Comprobar si venimos en modo de selección de ubicación desde publicar.php
var urlParams = new URLSearchParams(window.location.search);
var modoSeleccion = urlParams.get('modo') === 'elegir_ubicacion';
var nuevoReporteData = {
    tipo: urlParams.get('tipo') || 'Reporte',
    barrio: urlParams.get('barrio') || 'Salta Capital',
    desc: urlParams.get('desc') || 'Incidencia reportada por el usuario.'
};

var marcadorTemporal = null;
var ubicacionSeleccionada = null;

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

        // Evento de clic en el mapa para colocar el pin donde el usuario elija
        map.on('click', function(e) {
            if (modoSeleccion) {
                colocarMarcadorTemporal(e.lngLat.lat, e.lngLat.lng);
            }
        });
    });
}

function colocarMarcadorTemporal(lat, lng) {
    if (marcadorTemporal) {
        marcadorTemporal.remove();
    }

    ubicacionSeleccionada = { lat: lat, lng: lng };

    var outerEl = document.createElement('div');
    var innerEl = document.createElement('div');
    innerEl.className = 'custom-pin-wrapper anim-bounce';
    innerEl.innerHTML = '<svg viewBox="0 0 24 24" width="44" height="44" fill="#005fa3" stroke="white" stroke-width="2" style="filter: drop-shadow(0px 4px 8px rgba(0,0,0,0.45));"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>';
    outerEl.appendChild(innerEl);

    marcadorTemporal = new maplibregl.Marker({ element: outerEl, anchor: 'bottom' })
        .setLngLat([lng, lat])
        .addTo(map);

    // Habilitar el botón de Confirmar ubicación
    var btnConfirm = document.getElementById('btnConfirmarUbicacion');
    if (btnConfirm) {
        btnConfirm.disabled = false;
        btnConfirm.style.opacity = '1';
        btnConfirm.style.cursor = 'pointer';
    }
}

function confirmarSeleccionUbicacion() {
    if (!ubicacionSeleccionada) return;

    // Crear el pin permanente con los datos del usuario
    var pinFinal = {
        id: 'user-publicado-' + Date.now(),
        lat: ubicacionSeleccionada.lat,
        lng: ubicacionSeleccionada.lng,
        tipo: nuevoReporteData.tipo,
        descripcion: nuevoReporteData.barrio + ' - ' + nuevoReporteData.desc,
        usuario: 'Tú (Recién publicado)',
        esAdmin: false,
        esNuevo: true
    };

    todosLosPines.unshift(pinFinal);

    // Limpiar modo selección
    if (marcadorTemporal) {
        marcadorTemporal.remove();
        marcadorTemporal = null;
    }
    modoSeleccion = false;

    var overlay = document.getElementById('seleccionOverlay');
    if (overlay) overlay.style.display = 'none';

    // Redibujar pines
    aplicarFiltros();

    // Mostrar Toast de confirmación
    var toast = document.getElementById('mapToast');
    var toastDesc = document.getElementById('mapToastDesc');
    if (toast && toastDesc) {
        toastDesc.innerHTML = 'Reporte de <strong>' + nuevoReporteData.tipo + '</strong> publicado en <strong>' + nuevoReporteData.barrio + '</strong>.';
        toast.style.display = 'flex';
        setTimeout(function() {
            toast.style.display = 'none';
        }, 5000);
    }

    // Centrar mapa suavemente en la ubicación elegida
    map.flyTo({
        center: [ubicacionSeleccionada.lng, ubicacionSeleccionada.lat],
        zoom: 16,
        essential: true
    });
}

function cancelarSeleccionUbicacion() {
    if (marcadorTemporal) {
        marcadorTemporal.remove();
        marcadorTemporal = null;
    }
    modoSeleccion = false;
    var overlay = document.getElementById('seleccionOverlay');
    if (overlay) overlay.style.display = 'none';
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

    var markerNuevoToOpen = null;

    pinesFiltrados.forEach(function(pin) {
        var outerEl = document.createElement('div');
        var innerEl = document.createElement('div');
        innerEl.className = 'custom-pin-wrapper anim-bounce';
        
        var pinColor = pin.esNuevo ? '#10b981' : (pin.esAdmin ? '#005fa3' : '#dc2626');
        innerEl.innerHTML = '<svg viewBox="0 0 24 24" fill="' + pinColor + '" stroke="white" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>';
        outerEl.appendChild(innerEl);

        var popupHtml = '<h3 style="margin:0 0 5px 0;font-size:16px;' + (pin.esNuevo ? 'color:#059669;' : '') + '">' + pin.tipo + (pin.esNuevo ? ' <span style="font-size:11px;background:#dcfce7;color:#166534;padding:2px 6px;border-radius:4px;font-weight:700;">NUEVO</span>' : '') + '</h3>' +
                        '<p style="margin:0 0 10px 0;font-size:14px;color:#475569;">' + pin.descripcion + '</p>' +
                        '<small style="color:#64748b;">Por: <strong>' + pin.usuario + '</strong></small>';

        var popup = new maplibregl.Popup({ offset: 25 })
            .setHTML(popupHtml);

        var marker = new maplibregl.Marker({ element: outerEl, anchor: 'bottom' })
            .setLngLat([pin.lng, pin.lat])
            .setPopup(popup)
            .addTo(map);

        if (pin.esNuevo) {
            markerNuevoToOpen = marker;
        }

        marcadoresEnMapa.push(marker);
    });

    if (markerNuevoToOpen) {
        setTimeout(function() {
            markerNuevoToOpen.togglePopup();
        }, 500);
    }
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
