const P = 'pintar:v1:';

function read(key, fallback) {
  try {
    const v = localStorage.getItem(P + key);
    return v == null ? fallback : JSON.parse(v);
  } catch {
    return fallback;
  }
}
function write(key, value) {
  try {
    if (value == null) localStorage.removeItem(P + key);
    else localStorage.setItem(P + key, JSON.stringify(value));
    return true;
  } catch {
    return false; // cuota llena o modo privado: la app sigue funcionando sin guardar
  }
}

export const loadFills = (id) => read('f:' + id, {});
export const saveFills = (id, fills) => write('f:' + id, Object.keys(fills).length ? fills : null);
export const loadBrush = (id) => read('b:' + id, null);
export const saveBrush = (id, dataUrl) => write('b:' + id, dataUrl);

export const settings = {
  get sound() { return read('sound', true); },
  set sound(v) { write('sound', !!v); },
};
