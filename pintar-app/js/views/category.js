import { buildThumb } from '../svg.js';
import { loadFills, loadBrush } from '../storage.js';
import { sfx, speak } from '../audio.js';
import { html, bigButton, onTap } from './common.js';

export function renderCategory(root, cat) {
  const view = html(`<section class="view category" style="--c:${cat.color}">
    <header class="bar">
      <h1 class="bar-title">${cat.name}</h1>
    </header>
    <div class="grid drawings"></div>
  </section>`);

  const back = bigButton({ icon: '⬅️', cls: 'btn-round btn-back', aria: 'Volver' });
  onTap(back, () => { sfx.tap(); location.hash = '#/'; });
  view.querySelector('.bar').prepend(back);

  const grid = view.querySelector('.drawings');
  for (const d of cat.drawings) {
    const card = html(`<button class="card" type="button" aria-label="${d.name}">
      <span class="card-label">${d.name}</span>
    </button>`);
    card.prepend(buildThumb(d, loadFills(d.id), loadBrush(d.id)));
    onTap(card, () => {
      sfx.tap();
      speak(`¡Vamos a pintar ${d.say}!`);
      location.hash = `#/p/${d.id}`;
    });
    grid.append(card);
  }
  root.append(view);
}
