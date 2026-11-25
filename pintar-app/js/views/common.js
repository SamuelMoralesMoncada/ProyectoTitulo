/** Crea un elemento a partir de HTML. */
export function html(str) {
  const t = document.createElement('template');
  t.innerHTML = str.trim();
  return t.content.firstElementChild;
}

/** Botón grande con ícono + etiqueta. */
export function bigButton({ icon, label, cls = '', aria }) {
  return html(`<button class="btn ${cls}" type="button" aria-label="${aria || label || ''}">
    <span class="btn-icon" aria-hidden="true">${icon}</span>${label ? `<span class="btn-label">${label}</span>` : ''}
  </button>`);
}

/** Fija una acción al soltar el dedo (más tolerante que click en pantallas táctiles). */
export function onTap(el, fn) {
  el.addEventListener('click', (e) => { e.preventDefault(); fn(e); });
}
