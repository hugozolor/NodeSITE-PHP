# NodeSite - Plataforma de Reportes Ciudadanos

## 1. Título y Descripción del Proyecto

NodeSite es una aplicación web diseñada para que los ciudadanos puedan reportar problemas urbanos (baches, iluminación, recolección de basura) ubicándolos directamente en un mapa interactivo.

**Resumen de la Refactorización a PHP (Unidad 4):**
Durante el transcurso del año, el frontend de este proyecto se desarrolló completamente como una WebApp utilizando el framework Angular. Para cumplir con los requisitos de la Unidad 4, se migró el proyecto desde cero a un entorno nativo en PHP. Fue un proceso largo que implicó reemplazar la reactividad de Angular, reescribir toda la lógica (carruseles, mapa, menús) utilizando JavaScript puro y adaptar todo a CSS nativo para mantener el diseño original sin usar librerías de estilos.

## 2. Enlace al Prototipo de Figma

El diseño base de la interfaz está documentado en Figma.
Enlace: [Pega acá tu enlace cuando lo tengas]

## 3. Tecnologías Utilizadas

* <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" width="18" height="18" /> **PHP 8.x**: Renderizado de las vistas modulares.
* <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" width="18" height="18" /> **JavaScript (Vanilla)**: Interacciones, menús y manejo del DOM.
* <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg" width="18" height="18" /> **HTML5**: Estructuración del sitio.
* <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original.svg" width="18" height="18" /> **CSS3 Nativo**: Diseño y estilos a medida (no se utilizó Bootstrap).
* **MapLibre GL JS**: Librería para el renderizado del mapa.
* **XAMPP / Laragon**: Entorno de servidor local.

## 4. Instrucciones de Instalación y Ejecución Local

Pasos para levantar el proyecto de forma local:

1. Tener instalado un servidor local como **XAMPP** o **Laragon**.
2. Clonar este repositorio dentro de la carpeta pública del servidor (`htdocs` si usas XAMPP, o `www` si usas Laragon):
   
   ```bash
   git clone https://github.com/hugozolor/NodeSITE-PHP.git
