import { getCategory, getDrawing } from './data/drawings.js';
import { renderHome } from './views/home.js';
import { renderCategory } from './views/category.js';
import { renderPaint } from './views/paint.js';
import { unlockAudio } from './audio.js';

const app = document.getElementById('app');
let cleanup = null;

/** Enrutador por hash: #/  ·  #/c/<categoría>  ·  #/p/<dibujo> */
function route() {
  cleanup?.();
  cleanup = null;
  const [kind, id] = location.hash.replace(/^#\/?/, '').split('/');
  app.replaceChildren();
  if (kind === 'c' && getCategory(id)) cleanup = renderCategory(app, getCategory(id));
  else if (kind === 'p' && getDrawing(id)) cleanup = renderPaint(app, getDrawing(id));
  else cleanup = renderHome(app);
  window.scrollTo(0, 0);
}

export const go = (hash) => { location.hash = hash; };

window.addEventListener('hashchange', route);
document.addEventListener('pointerdown', unlockAudio, { capture: true });
// Evita menús contextuales y gestos que confunden a los más pequeños.
document.addEventListener('contextmenu', (e) => e.preventDefault());
document.addEventListener('gesturestart', (e) => e.preventDefault());
document.addEventListener('dblclick', (e) => e.preventDefault(), { passive: false });

route();

if ('serviceWorker' in navigator && location.protocol !== 'file:') {
  navigator.serviceWorker.register('./sw.js').catch(() => {});
}
