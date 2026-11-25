const NS = 'http://www.w3.org/2000/svg';

/** Reglas de estilo que se incrustan al exportar la imagen. */
export const DRAWING_CSS = `
  .r{fill:#fff;stroke:#2b2b3a;stroke-width:7;stroke-linejoin:round;stroke-linecap:round}
  .r.bg{stroke:none}
  .d{fill:#2b2b3a;stroke:none}
  .l{fill:none;stroke:#2b2b3a;stroke-width:7;stroke-linecap:round;stroke-linejoin:round}`;

/** Construye el <svg> de un dibujo aplicando los colores guardados. */
export function buildSVG(drawing, fills = {}, { outline = false } = {}) {
  const svg = document.createElementNS(NS, 'svg');
  svg.setAttribute('viewBox', '0 0 400 400');
  svg.setAttribute('class', outline ? 'drawing outline' : 'drawing');
  if (outline) svg.setAttribute('aria-hidden', 'true');
  svg.setAttribute('aria-label', drawing.name);
  svg.innerHTML = `<rect class="r bg" x="0" y="0" width="400" height="400"/>${drawing.svg}`;
  regionsOf(svg).forEach((el, i) => {
    el.dataset.i = i;
    if (fills[i]) el.style.fill = fills[i];
  });
  return svg;
}

export const regionsOf = (svg) => [...svg.querySelectorAll('.r')];

/**
 * Capas: rellenos (SVG) → crayón (canvas/imagen) → contornos.
 * La capa de contornos es el mismo dibujo en blanco y se combina con "multiply":
 * el blanco no altera los colores y el negro mantiene los bordes visibles,
 * respetando qué figura queda delante de cuál.
 */
export function buildThumb(drawing, fills, brushDataUrl) {
  const wrap = document.createElement('div');
  wrap.className = 'thumb';
  wrap.append(buildSVG(drawing, fills));
  if (brushDataUrl) {
    const img = new Image();
    img.src = brushDataUrl;
    img.alt = '';
    wrap.append(img, buildSVG(drawing, {}, { outline: true }));
  }
  return wrap;
}

/** Combina SVG + crayón en un PNG descargable. */
export async function exportPNG(svg, outlineSvg, brushCanvas, size = 1200) {
  const fillsImg = await svgToImage(svg);
  const outlineImg = await svgToImage(outlineSvg);
  const c = document.createElement('canvas');
  c.width = c.height = size;
  const ctx = c.getContext('2d');
  ctx.drawImage(fillsImg, 0, 0, size, size);
  ctx.drawImage(brushCanvas, 0, 0, size, size);
  ctx.globalCompositeOperation = 'multiply';
  ctx.drawImage(outlineImg, 0, 0, size, size);
  return c.toDataURL('image/png');
}

async function svgToImage(svg, size = 1200) {
  const clone = svg.cloneNode(true);
  clone.setAttribute('xmlns', NS);
  clone.setAttribute('width', size);
  clone.setAttribute('height', size);
  const style = document.createElementNS(NS, 'style');
  style.textContent = DRAWING_CSS;
  clone.prepend(style);
  const blob = new Blob([new XMLSerializer().serializeToString(clone)], { type: 'image/svg+xml' });
  const url = URL.createObjectURL(blob);
  try {
    return await new Promise((res, rej) => {
      const i = new Image();
      i.onload = () => res(i);
      i.onerror = rej;
      i.src = url;
    });
  } finally {
    URL.revokeObjectURL(url);
  }
}
