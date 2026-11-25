# ¡A pintar! 🎨

Aplicación web para pintar dibujos, pensada para párvulos de **2 a 3 años**.
Hecha en **JavaScript puro** (módulos ES, sin frameworks ni compilación) para que sea liviana y fluida en tablets y celulares.

## Cómo usarla

Sirve la carpeta con cualquier servidor web estático y abre `index.html`:

```bash
cd pintar-app
python3 -m http.server 8080
# abrir http://localhost:8080
```

> Abrir el archivo directamente (`file://`) no funciona porque los navegadores bloquean los módulos JS en ese modo.

En una tablet se puede usar "Agregar a pantalla de inicio": se instala como app a pantalla completa y funciona **sin internet** (service worker).

## Pensado para 2-3 años

- **Toca y rellena**: un toque pinta la zona completa. No hace falta precisión ni arrastrar.
- **Zonas grandes y contornos gruesos** en todos los dibujos. Tocar fuera del dibujo pinta el fondo, así que ningún toque se pierde.
- **Botones enormes** (56-96 px) con íconos. El texto es solo de apoyo para el adulto.
- **Voz y sonidos**: dice el nombre del color ("¡rojo!"), del dibujo y felicita al terminar (se puede silenciar en el inicio).
- **Crayón grueso** para pintar libre con el dedo. Ignora la palma: solo cuenta un dedo a la vez.
- **Arcoíris**: cada toque usa un color distinto.
- **Goma**: borra el crayón y los rellenos por donde pasa.
- **Deshacer** y **Borrar todo**. Borrar todo pide un segundo toque para evitar accidentes.
- **Celebración** con confeti y estrella al completar el dibujo.
- **Se guarda solo**: el avance de cada dibujo queda en el dispositivo (localStorage) y se ve en las miniaturas.
- **📷 Guardar imagen**: hay que mantenerlo presionado (pensado para el adulto). Descarga un PNG.
- Sin menús contextuales, zoom, selección de texto ni scroll en el lienzo.

## Categorías

| Categoría | Dibujos |
|---|---|
| Animales terrestres | León, Gato, Perro, Elefante |
| Animales marinos | Pez, Pulpo, Tortuga, Ballena |
| Dinosaurios | T-Rex, Cuello largo, Triceratops, Estegosaurio |
| Transportes | Auto, Barco, Avión, Tren |
| Mi mundo | Sol, Flor, Árbol, Casa |

## Arquitectura

```
pintar-app/
├── index.html            Punto de entrada
├── manifest.webmanifest  PWA (instalable)
├── sw.js                 Service worker: funciona sin conexión
├── css/styles.css        Estilos responsivos (horizontal / vertical)
└── js/
    ├── app.js            Enrutador por hash (#/, #/c/:categoría, #/p/:dibujo)
    ├── data/drawings.js  Catálogo de categorías, dibujos SVG y paleta
    ├── svg.js            Construcción de SVG, miniaturas y exportación PNG
    ├── storage.js        Guardado en localStorage
    ├── audio.js          Sonidos sintetizados (Web Audio) y voz (speechSynthesis)
    └── views/
        ├── home.js       Pantalla de categorías
        ├── category.js   Pantalla de dibujos de una categoría
        └── paint.js      Lienzo para pintar
```

El lienzo tiene 3 capas superpuestas:

1. **SVG de rellenos**: cada zona `.r` recibe su color al tocarla.
2. **Canvas del crayón**: trazos libres a 800×800 internos.
3. **SVG de contornos**: el mismo dibujo en blanco con `mix-blend-mode: multiply`. El blanco no altera los colores y el negro mantiene los bordes siempre visibles.

### Agregar un dibujo nuevo

En `js/data/drawings.js`, agrega un objeto a la categoría que quieras:

```js
{
  id: 'conejo', name: 'Conejo', say: 'el conejo',
  svg: `
    <ellipse class="r" cx="200" cy="260" rx="110" ry="90"/>   <!-- zona pintable -->
    <circle class="d" cx="170" cy="240" r="12"/>             <!-- detalle negro -->
    <path class="l" d="M180 290 Q200 305 220 290"/>          <!-- línea -->`,
},
```

- `viewBox` de 0 a 400. Las figuras se dibujan en orden (las últimas quedan encima).
- Usa zonas grandes (idealmente de más de 40 unidades) para que sean fáciles de tocar.
- Para una categoría nueva, agrégala a `CATEGORIES`. Si agregas archivos, súmalos también a `ASSETS` en `sw.js`.
