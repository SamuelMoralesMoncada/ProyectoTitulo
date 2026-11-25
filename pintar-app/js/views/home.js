import { CATEGORIES } from '../data/drawings.js';
import { buildThumb } from '../svg.js';
import { loadFills, loadBrush, settings } from '../storage.js';
import { sfx, speak } from '../audio.js';
import { html, onTap } from './common.js';

export function renderHome(root) {
  const view = html(`<section class="view home">
    <header class="home-header">
      <h1 class="title" aria-label="¡A pintar!">
        ${[...'¡A pintar!'].map((ch, i) => `<span style="--i:${i}">${ch === ' ' ? '&nbsp;' : ch}</span>`).join('')}
      </h1>
      <button class="btn btn-round sound-toggle" type="button"></button>
    </header>
    <div class="grid categories"></div>
  </section>`);

  const grid = view.querySelector('.categories');
  for (const cat of CATEGORIES) {
    const first = cat.drawings[0];
    const card = html(`<button class="card cat-card" type="button" style="--c:${cat.color}" aria-label="${cat.name}">
      <span class="card-label">${cat.name}</span>
    </button>`);
    card.prepend(buildThumb(first, loadFills(first.id), loadBrush(first.id)));
    onTap(card, () => {
      sfx.tap();
      speak(cat.say);
      location.hash = `#/c/${cat.id}`;
    });
    grid.append(card);
  }

  const soundBtn = view.querySelector('.sound-toggle');
  const paintSound = () => {
    soundBtn.innerHTML = `<span class="btn-icon" aria-hidden="true">${settings.sound ? '🔊' : '🔇'}</span>`;
    soundBtn.setAttribute('aria-label', settings.sound ? 'Silenciar' : 'Activar sonido');
  };
  paintSound();
  onTap(soundBtn, () => {
    settings.sound = !settings.sound;
    paintSound();
    sfx.tap();
  });

  root.append(view);
}
