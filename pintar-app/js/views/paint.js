import { PALETTE } from '../data/drawings.js';
import { buildSVG, regionsOf, exportPNG } from '../svg.js';
import { loadFills, saveFills, loadBrush, saveBrush } from '../storage.js';
import { sfx, speak } from '../audio.js';
import { html, bigButton, onTap } from './common.js';

const CANVAS_SIZE = 800;          // resolución interna de la capa de crayón (cuadrada)
const BRUSH_WIDTH = 64;           // trazo muy grueso: fácil para manos pequeñas
const ERASER_WIDTH = 96;
const UNDO_LIMIT = 12;
const RAINBOW = 'rainbow';

const TOOLS = [
  { id: 'fill', icon: '🪣', label: 'Rellenar', say: 'rellenar' },
  { id: 'brush', icon: '🖍️', label: 'Crayón', say: 'crayón' },
  { id: 'eraser', icon: '🧽', label: 'Borrar', say: 'borrar' },
];

export function renderPaint(root, drawing) {
  const id = drawing.id;
  const fills = loadFills(id);

  const view = html(`<section class="view paint" style="--c:${drawing.category.color}">
    <div class="side tools"></div>
    <div class="stage-wrap"><div class="stage"></div></div>
    <div class="side palette" role="radiogroup" aria-label="Colores"></div>
  </section>`);
  const stage = view.querySelector('.stage');
  const toolsEl = view.querySelector('.tools');
  const paletteEl = view.querySelector('.palette');

  /* ---------- Capas: SVG (rellenos) → canvas (crayón) → SVG (contornos) ---------- */
  const svg = buildSVG(drawing, fills);
  const regions = regionsOf(svg);
  const canvas = document.createElement('canvas');
  canvas.width = canvas.height = CANVAS_SIZE;
  canvas.className = 'brush-layer';
  const ctx = canvas.getContext('2d', { willReadFrequently: true });
  ctx.lineCap = 'round';
  ctx.lineJoin = 'round';
  const outlineSvg = buildSVG(drawing, {}, { outline: true });
  stage.append(svg, canvas, outlineSvg);

  const saved = loadBrush(id);
  if (saved) {
    const img = new Image();
    img.onload = () => ctx.drawImage(img, 0, 0, CANVAS_SIZE, CANVAS_SIZE);
    img.src = saved;
  }

  /* ---------- Estado ---------- */
  let tool = 'fill';
  let color = PALETTE[0].hex;
  let rainbowStep = 0;
  let hue = 0;
  const undoStack = [];
  let celebrated = isComplete();

  /* ---------- Barra de herramientas ---------- */
  const back = bigButton({ icon: '⬅️', cls: 'btn-round btn-back', aria: 'Volver' });
  onTap(back, () => { sfx.tap(); location.hash = `#/c/${drawing.category.id}`; });
  toolsEl.append(back);

  const toolButtons = TOOLS.map((t) => {
    const b = bigButton({ icon: t.icon, label: t.label, cls: 'btn-tool' });
    b.dataset.tool = t.id;
    onTap(b, () => { setTool(t.id); sfx.tap(); speak(t.say); });
    toolsEl.append(b);
    return b;
  });

  const undoBtn = bigButton({ icon: '↩️', label: 'Atrás', cls: 'btn-tool', aria: 'Deshacer' });
  onTap(undoBtn, undo);
  toolsEl.append(undoBtn);

  // "Borrar todo" pide un segundo toque para evitar accidentes.
  const clearBtn = bigButton({ icon: '🗑️', label: 'Todo', cls: 'btn-tool', aria: 'Borrar todo' });
  let clearArmed = null;
  onTap(clearBtn, () => {
    if (clearArmed) {
      clearTimeout(clearArmed);
      clearArmed = null;
      clearBtn.classList.remove('armed');
      clearAll();
    } else {
      sfx.tap();
      speak('¿Borrar todo? Toca otra vez');
      clearBtn.classList.add('armed');
      clearArmed = setTimeout(() => { clearArmed = null; clearBtn.classList.remove('armed'); }, 3000);
    }
  });
  toolsEl.append(clearBtn);

  // Guardar imagen: mantener presionado (pensado para el adulto).
  const saveBtn = bigButton({ icon: '📷', cls: 'btn-round btn-save', aria: 'Guardar imagen (mantener presionado)' });
  setupLongPress(saveBtn, 900, downloadImage);
  toolsEl.append(saveBtn);

  /* ---------- Paleta ---------- */
  const swatches = PALETTE.map((p) => makeSwatch(p.hex, p.name, `background:${p.hex}`));
  swatches.push(makeSwatch(RAINBOW, 'arcoíris', '', 'rainbow'));
  paletteEl.append(...swatches);

  function makeSwatch(value, name, style, extra = '') {
    const b = html(`<button class="swatch ${extra}" type="button" role="radio" aria-label="${name}" style="${style}"></button>`);
    b.dataset.color = value;
    onTap(b, () => {
      color = value;
      updateSelection();
      sfx.tap();
      speak(name);
      if (tool === 'eraser') setTool('fill');
    });
    return b;
  }

  function setTool(t) {
    tool = t;
    updateSelection();
  }

  function updateSelection() {
    toolButtons.forEach((b) => b.classList.toggle('selected', b.dataset.tool === tool));
    swatches.forEach((s) => {
      const on = s.dataset.color === color;
      s.classList.toggle('selected', on);
      s.setAttribute('aria-checked', on);
    });
    stage.dataset.tool = tool;
  }
  updateSelection();

  /* ---------- Colores ---------- */
  function nextFillColor() {
    if (color !== RAINBOW) return color;
    const c = PALETTE[rainbowStep % PALETTE.length].hex;
    rainbowStep++;
    return c;
  }
  function strokeColor() {
    if (color !== RAINBOW) return color;
    hue = (hue + 4) % 360;
    return `hsl(${hue} 95% 58%)`;
  }

  /* ---------- Interacción sobre el lienzo ---------- */
  let active = null; // { pointerId, x, y, action }

  function toCanvas(e) {
    const r = stage.getBoundingClientRect();
    return {
      x: ((e.clientX - r.left) / r.width) * CANVAS_SIZE,
      y: ((e.clientY - r.top) / r.height) * CANVAS_SIZE,
    };
  }

  function regionAt(clientX, clientY) {
    return document.elementsFromPoint(clientX, clientY).find((el) => el.classList?.contains('r') && svg.contains(el));
  }

  function setRegion(el, value, action) {
    const i = +el.dataset.i;
    const prev = fills[i] || null;
    if (prev === value) return false;
    action.fills.push({ i, prev, next: value });
    if (value) fills[i] = value; else delete fills[i];
    el.style.fill = value || '';
    return true;
  }

  stage.addEventListener('pointerdown', (e) => {
    e.preventDefault();
    if (tool === 'fill') {
      const el = regionAt(e.clientX, e.clientY);
      if (!el) return;
      const action = { fills: [] };
      const c = nextFillColor();
      if (setRegion(el, c, action)) {
        el.classList.remove('just-filled');
        void el.getBBox(); // reinicia la animación
        el.classList.add('just-filled');
        pushUndo(action);
        persistFills();
        sfx.pop();
        ripple(e, c);
        checkComplete();
      } else {
        ripple(e, c);
      }
      return;
    }
    if (active) return; // un solo dedo a la vez para el crayón (ignora la palma)
    stage.setPointerCapture(e.pointerId);
    const p = toCanvas(e);
    active = {
      pointerId: e.pointerId, x: p.x, y: p.y, lastRegionCheck: 0,
      action: { fills: [], brush: ctx.getImageData(0, 0, CANVAS_SIZE, CANVAS_SIZE) },
    };
    if (tool === 'eraser') { sfx.erase(); eraseRegionAt(e); }
    drawSegment(p, p);
  });

  stage.addEventListener('pointermove', (e) => {
    if (!active || e.pointerId !== active.pointerId) return;
    const events = e.getCoalescedEvents ? e.getCoalescedEvents() : [e];
    for (const ev of (events.length ? events : [e])) {
      const p = toCanvas(ev);
      drawSegment({ x: active.x, y: active.y }, p);
      active.x = p.x;
      active.y = p.y;
    }
    if (tool === 'eraser' && e.timeStamp - active.lastRegionCheck > 40) {
      active.lastRegionCheck = e.timeStamp;
      eraseRegionAt(e);
    }
  });

  const endStroke = (e) => {
    if (!active || e.pointerId !== active.pointerId) return;
    pushUndo(active.action);
    active = null;
    persistBrush();
    if (Object.keys(fills).length) persistFills();
    celebrated = celebrated && isComplete();
  };
  stage.addEventListener('pointerup', endStroke);
  stage.addEventListener('pointercancel', endStroke);
  stage.addEventListener('lostpointercapture', endStroke);

  function drawSegment(a, b) {
    ctx.save();
    if (tool === 'eraser') {
      ctx.globalCompositeOperation = 'destination-out';
      ctx.strokeStyle = '#000';
      ctx.lineWidth = ERASER_WIDTH;
    } else {
      ctx.globalCompositeOperation = 'source-over';
      ctx.strokeStyle = strokeColor();
      ctx.lineWidth = BRUSH_WIDTH;
    }
    ctx.beginPath();
    ctx.moveTo(a.x, a.y);
    ctx.lineTo(b.x + 0.01, b.y);
    ctx.stroke();
    ctx.restore();
  }

  function eraseRegionAt(e) {
    const el = regionAt(e.clientX, e.clientY);
    if (el && setRegion(el, null, active.action)) celebrated = false;
  }

  /* ---------- Deshacer / borrar todo ---------- */
  function pushUndo(action) {
    if (!action.fills.length && !action.brush) return;
    undoStack.push(action);
    if (undoStack.length > UNDO_LIMIT) undoStack.shift();
  }

  function undo() {
    const action = undoStack.pop();
    if (!action) { sfx.tap(); undoBtn.classList.add('nope'); setTimeout(() => undoBtn.classList.remove('nope'), 400); return; }
    sfx.undo();
    for (const f of [...action.fills].reverse()) {
      if (f.prev) fills[f.i] = f.prev; else delete fills[f.i];
      regions[f.i].style.fill = f.prev || '';
    }
    if (action.brush) ctx.putImageData(action.brush, 0, 0);
    persistFills();
    persistBrush();
    celebrated = isComplete();
  }

  function clearAll() {
    const action = { fills: [], brush: ctx.getImageData(0, 0, CANVAS_SIZE, CANVAS_SIZE) };
    regions.forEach((el) => setRegion(el, null, action));
    ctx.clearRect(0, 0, CANVAS_SIZE, CANVAS_SIZE);
    pushUndo(action);
    persistFills();
    persistBrush();
    celebrated = false;
    sfx.erase();
    speak('¡Listo! A pintar de nuevo');
  }

  /* ---------- Guardado ---------- */
  let brushTimer = null;
  function persistFills() { saveFills(id, fills); }
  function persistBrush() {
    clearTimeout(brushTimer);
    brushTimer = setTimeout(() => saveBrush(id, canvasIsEmpty() ? null : canvas.toDataURL('image/png')), 250);
  }
  function canvasIsEmpty() {
    const data = ctx.getImageData(0, 0, CANVAS_SIZE, CANVAS_SIZE).data;
    for (let k = 3; k < data.length; k += 16) if (data[k]) return false;
    return true;
  }

  async function downloadImage() {
    try {
      const url = await exportPNG(svg, outlineSvg, canvas);
      const a = document.createElement('a');
      a.href = url;
      a.download = `${drawing.id}-${new Date().toISOString().slice(0, 10)}.png`;
      a.click();
      sfx.fanfare();
    } catch { /* sin soporte: no hacemos nada */ }
  }

  /* ---------- Celebración ---------- */
  function isComplete() {
    return regions.every((el) => el.classList.contains('bg') || fills[el.dataset.i]);
  }
  function checkComplete() {
    if (celebrated || !isComplete()) return;
    celebrated = true;
    celebrate();
  }
  function celebrate() {
    sfx.fanfare();
    speak(`¡Muy bien! ¡Pintaste ${drawing.say}!`);
    const colors = PALETTE.map((p) => p.hex);
    const overlay = html(`<div class="celebration" role="status">
      <div class="celebration-msg"><span class="big-star">⭐</span><span>¡Muy bien!</span></div>
    </div>`);
    for (let k = 0; k < 60; k++) {
      const s = document.createElement('i');
      s.style.cssText = `left:${Math.random() * 100}%;background:${colors[k % colors.length]};` +
        `animation-delay:${Math.random() * 0.8}s;animation-duration:${1.8 + Math.random() * 1.4}s;` +
        `--rot:${Math.random() * 720 - 360}deg;--drift:${Math.random() * 120 - 60}px`;
      overlay.append(s);
    }
    const close = () => overlay.remove();
    overlay.addEventListener('pointerdown', close);
    setTimeout(close, 3800);
    view.append(overlay);
  }

  /* ---------- Efectos ---------- */
  function ripple(e, c) {
    const r = stage.getBoundingClientRect();
    const dot = document.createElement('span');
    dot.className = 'ripple';
    dot.style.cssText = `left:${e.clientX - r.left}px;top:${e.clientY - r.top}px;--rc:${c}`;
    stage.append(dot);
    dot.addEventListener('animationend', () => dot.remove());
  }

  root.append(view);

  return () => {
    clearTimeout(brushTimer);
    clearTimeout(clearArmed);
    if (!canvasIsEmpty() || loadBrush(id)) saveBrush(id, canvasIsEmpty() ? null : canvas.toDataURL('image/png'));
  };
}

function setupLongPress(el, ms, fn) {
  let t = null;
  const start = (e) => {
    e.preventDefault();
    el.classList.add('pressing');
    t = setTimeout(() => { el.classList.remove('pressing'); t = null; fn(); }, ms);
  };
  const cancel = () => { clearTimeout(t); t = null; el.classList.remove('pressing'); };
  el.style.setProperty('--press', `${ms}ms`);
  el.addEventListener('pointerdown', start);
  ['pointerup', 'pointerleave', 'pointercancel'].forEach((ev) => el.addEventListener(ev, cancel));
}
