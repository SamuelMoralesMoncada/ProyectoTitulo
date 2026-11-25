/**
 * Catálogo de dibujos para colorear.
 *
 * Cada dibujo es SVG dentro de un viewBox 0 0 400 400.
 * Clases usadas:
 *   r → zona pintable (se rellena con un toque). Grandes para la motricidad de 2-3 años.
 *   d → detalle oscuro (ojos, nariz). No recibe toques.
 *   l → línea de contorno sin relleno. No recibe toques.
 * El fondo (rect .bg) lo agrega automáticamente el renderizador.
 */

/* ---------- Generadores para figuras repetitivas ---------- */

function sunRays(cx, cy, inner, outer, count) {
  let out = '';
  for (let k = 0; k < count; k++) {
    const a = (Math.PI * 2 * k) / count - Math.PI / 2;
    const half = Math.PI / count * 0.7;
    const p = (ang, rad) => `${(cx + Math.cos(ang) * rad).toFixed(1)} ${(cy + Math.sin(ang) * rad).toFixed(1)}`;
    out += `<path class="r" d="M${p(a - half, inner)} L${p(a, outer)} L${p(a + half, inner)} Z"/>`;
  }
  return out;
}

function petals(cx, cy, dist, r, count) {
  let out = '';
  for (let k = 0; k < count; k++) {
    const a = (Math.PI * 2 * k) / count - Math.PI / 2;
    out += `<circle class="r" cx="${(cx + Math.cos(a) * dist).toFixed(1)}" cy="${(cy + Math.sin(a) * dist).toFixed(1)}" r="${r}"/>`;
  }
  return out;
}

function scallop(cx, cy, r, bumps) {
  const pt = (k) => {
    const a = (Math.PI * 2 * k) / bumps;
    return `${(cx + Math.cos(a) * r).toFixed(1)} ${(cy + Math.sin(a) * r).toFixed(1)}`;
  };
  const br = (r * Math.sin(Math.PI / bumps) * 1.15).toFixed(1);
  let d = `M${pt(0)}`;
  for (let k = 1; k <= bumps; k++) d += ` A${br} ${br} 0 0 1 ${pt(k)}`;
  return `<path class="r" d="${d} Z"/>`;
}

// Los bordes inferiores salen del viewBox para que no se vea su contorno.
const grass = '<path class="r" d="M0 360 Q100 340 200 362 Q300 384 400 356 L410 410 L-10 410 Z"/>';

/* ---------- Dibujos ---------- */

const TERRESTRES = [
  {
    id: 'leon', name: 'León', say: 'el león',
    svg: `
      ${scallop(200, 210, 150, 14)}
      <circle class="r" cx="128" cy="122" r="30"/>
      <circle class="r" cx="272" cy="122" r="30"/>
      <circle class="r" cx="200" cy="215" r="105"/>
      <ellipse class="r" cx="200" cy="268" rx="60" ry="42"/>
      <circle class="d" cx="160" cy="190" r="13"/>
      <circle class="d" cx="240" cy="190" r="13"/>
      <path class="d" d="M178 242 L222 242 L200 266 Z"/>
      <path class="l" d="M200 266 L200 284 M200 284 Q185 300 170 290 M200 284 Q215 300 230 290"/>`,
  },
  {
    id: 'gato', name: 'Gato', say: 'el gato',
    svg: `
      <path class="r" d="M290 335 Q385 305 352 205 Q340 180 320 200 Q345 280 285 300 Z"/>
      <ellipse class="r" cx="200" cy="300" rx="108" ry="80"/>
      <path class="r" d="M130 132 L118 40 L192 95 Z"/>
      <path class="r" d="M270 132 L282 40 L208 95 Z"/>
      <circle class="r" cx="200" cy="168" r="90"/>
      <ellipse class="r" cx="158" cy="372" rx="38" ry="22"/>
      <ellipse class="r" cx="242" cy="372" rx="38" ry="22"/>
      <circle class="d" cx="165" cy="155" r="12"/>
      <circle class="d" cx="235" cy="155" r="12"/>
      <path class="d" d="M188 186 L212 186 L200 199 Z"/>
      <path class="l" d="M200 199 Q190 214 178 206 M200 199 Q210 214 222 206 M148 195 L98 185 M148 207 L98 213 M252 195 L302 185 M252 207 L302 213"/>`,
  },
  {
    id: 'perro', name: 'Perro', say: 'el perro',
    svg: `
      <circle class="r" cx="200" cy="195" r="112"/>
      <ellipse class="r" cx="92" cy="205" rx="42" ry="88" transform="rotate(15 92 205)"/>
      <ellipse class="r" cx="308" cy="205" rx="42" ry="88" transform="rotate(-15 308 205)"/>
      <circle class="r" cx="245" cy="158" r="38"/>
      <ellipse class="r" cx="200" cy="262" rx="72" ry="54"/>
      <circle class="d" cx="158" cy="168" r="13"/>
      <circle class="d" cx="245" cy="162" r="13"/>
      <ellipse class="d" cx="200" cy="240" rx="25" ry="17"/>
      <path class="l" d="M200 256 L200 276 M200 276 Q180 296 164 281 M200 276 Q220 296 236 281"/>`,
  },
  {
    id: 'elefante', name: 'Elefante', say: 'el elefante',
    svg: `
      <rect class="r" x="160" y="280" width="52" height="85" rx="16"/>
      <rect class="r" x="272" y="280" width="52" height="85" rx="16"/>
      <path class="l" d="M345 225 Q375 250 362 290"/>
      <ellipse class="r" cx="255" cy="230" rx="110" ry="88"/>
      <path class="r" d="M108 228 Q62 300 88 352 Q108 372 124 348 Q104 300 152 250 Z"/>
      <circle class="r" cx="140" cy="188" r="72"/>
      <ellipse class="r" cx="196" cy="196" rx="48" ry="64"/>
      <circle class="d" cx="118" cy="170" r="11"/>`,
  },
];

const MARINOS = [
  {
    id: 'pez', name: 'Pez', say: 'el pez',
    svg: `
      <path class="r" d="M285 200 L375 120 L375 280 Z"/>
      <path class="r" d="M140 125 Q195 40 260 128 Z"/>
      <ellipse class="r" cx="190" cy="205" rx="135" ry="92"/>
      <path class="r" d="M205 116 Q250 205 205 294 Q170 205 205 116 Z"/>
      <circle class="r" cx="110" cy="185" r="25"/>
      <circle class="d" cx="105" cy="185" r="11"/>
      <path class="l" d="M68 222 Q84 234 98 222"/>
      <circle class="l" cx="55" cy="95" r="15"/>
      <circle class="l" cx="85" cy="50" r="10"/>`,
  },
  {
    id: 'pulpo', name: 'Pulpo', say: 'el pulpo',
    svg: `
      <path class="r" d="M125 215 Q55 300 85 362 Q108 384 122 352 Q110 300 168 250 Z"/>
      <path class="r" d="M275 215 Q345 300 315 362 Q292 384 278 352 Q290 300 232 250 Z"/>
      <path class="r" d="M162 250 Q145 330 172 375 Q196 388 197 358 Q186 312 200 262 Z"/>
      <path class="r" d="M238 250 Q255 330 228 375 Q204 388 203 358 Q214 312 200 262 Z"/>
      <ellipse class="r" cx="200" cy="160" rx="108" ry="112"/>
      <circle class="d" cx="162" cy="168" r="14"/>
      <circle class="d" cx="238" cy="168" r="14"/>
      <path class="l" d="M168 215 Q200 242 232 215"/>`,
  },
  {
    id: 'tortuga', name: 'Tortuga', say: 'la tortuga',
    svg: `
      <ellipse class="r" cx="125" cy="300" rx="34" ry="28"/>
      <ellipse class="r" cx="275" cy="300" rx="34" ry="28"/>
      <circle class="r" cx="335" cy="240" r="44"/>
      <path class="r" d="M55 282 Q55 112 200 104 Q345 112 345 282 Z"/>
      <path class="r" d="M200 145 L255 178 L255 238 L200 268 L145 238 L145 178 Z"/>
      <rect class="r" x="45" y="270" width="310" height="28" rx="14"/>
      <circle class="d" cx="345" cy="228" r="9"/>
      <path class="l" d="M328 258 Q344 270 362 255"/>`,
  },
  {
    id: 'ballena', name: 'Ballena', say: 'la ballena',
    svg: `
      <path class="r" d="M315 230 L368 158 Q388 146 388 170 L362 232 L388 292 Q388 316 368 304 Z"/>
      <path class="r" d="M35 232 Q35 112 190 112 Q325 112 335 222 Q335 305 190 305 Q35 305 35 232 Z"/>
      <path class="r" d="M58 258 Q190 332 322 252 Q305 305 190 305 Q78 305 58 258 Z"/>
      <circle class="d" cx="112" cy="200" r="12"/>
      <path class="l" d="M80 240 Q110 262 142 246 M190 108 L190 62 M190 66 Q170 38 146 50 M190 66 Q210 38 234 50"/>`,
  },
];

const DINOSAURIOS = [
  {
    id: 'trex', name: 'T-Rex', say: 'el tiranosaurio',
    svg: `
      <path class="r" d="M150 225 L15 330 L175 292 Z"/>
      <rect class="r" x="155" y="280" width="48" height="88" rx="14"/>
      <rect class="r" x="228" y="280" width="48" height="88" rx="14"/>
      <ellipse class="r" cx="205" cy="240" rx="90" ry="78"/>
      <ellipse class="r" cx="222" cy="258" rx="48" ry="52"/>
      <path class="r" d="M262 228 L310 244 L304 264 L258 252 Z"/>
      <rect class="r" x="222" y="70" width="152" height="108" rx="42"/>
      <circle class="d" cx="300" cy="112" r="12"/>
      <path class="l" d="M298 150 L368 150"/>`,
  },
  {
    id: 'cuellolargo', name: 'Cuello largo', say: 'el dinosaurio de cuello largo',
    svg: `
      <path class="r" d="M110 258 Q40 258 8 210 Q50 282 122 305 Z"/>
      <rect class="r" x="112" y="272" width="42" height="92" rx="14"/>
      <rect class="r" x="168" y="272" width="42" height="92" rx="14"/>
      <rect class="r" x="228" y="272" width="42" height="92" rx="14"/>
      <rect class="r" x="282" y="272" width="42" height="92" rx="14"/>
      <path class="r" d="M262 222 Q296 120 294 80 L342 80 Q338 152 318 242 Z"/>
      <ellipse class="r" cx="215" cy="250" rx="118" ry="72"/>
      <circle class="r" cx="190" cy="232" r="24"/>
      <circle class="r" cx="250" cy="222" r="20"/>
      <ellipse class="r" cx="328" cy="74" rx="48" ry="30"/>
      <circle class="d" cx="340" cy="66" r="8"/>
      <path class="l" d="M345 88 Q360 94 372 82"/>`,
  },
  {
    id: 'triceratops', name: 'Triceratops', say: 'el triceratops',
    svg: `
      <path class="r" d="M110 248 L15 282 L118 292 Z"/>
      <rect class="r" x="110" y="275" width="46" height="88" rx="14"/>
      <rect class="r" x="200" y="275" width="46" height="88" rx="14"/>
      <ellipse class="r" cx="180" cy="245" rx="98" ry="72"/>
      <circle class="r" cx="280" cy="188" r="78"/>
      <path class="r" d="M298 188 L330 112 L330 192 Z"/>
      <path class="r" d="M335 196 L378 132 L358 206 Z"/>
      <path class="r" d="M352 216 L398 196 L366 240 Z"/>
      <ellipse class="r" cx="312" cy="228" rx="62" ry="48"/>
      <circle class="d" cx="320" cy="215" r="10"/>
      <path class="l" d="M318 255 Q340 266 362 250"/>`,
  },
  {
    id: 'estegosaurio', name: 'Estegosaurio', say: 'el estegosaurio',
    svg: `
      <path class="r" d="M108 218 L128 148 L162 196 Z"/>
      <path class="r" d="M150 196 L182 118 L218 186 Z"/>
      <path class="r" d="M202 186 L238 112 L268 190 Z"/>
      <path class="r" d="M255 196 L288 142 L308 218 Z"/>
      <path class="r" d="M92 258 L15 228 L98 292 Z"/>
      <rect class="r" x="118" y="280" width="44" height="80" rx="14"/>
      <rect class="r" x="250" y="280" width="44" height="80" rx="14"/>
      <ellipse class="r" cx="200" cy="252" rx="122" ry="72"/>
      <ellipse class="r" cx="335" cy="272" rx="44" ry="30"/>
      <circle class="d" cx="346" cy="264" r="8"/>`,
  },
];

const TRANSPORTES = [
  {
    id: 'auto', name: 'Auto', say: 'el auto',
    svg: `
      <path class="r" d="M115 182 L160 105 L272 105 L316 182 Z"/>
      <path class="r" d="M146 176 L175 122 L210 122 L210 176 Z"/>
      <path class="r" d="M224 122 L260 122 L290 176 L224 176 Z"/>
      <rect class="r" x="40" y="172" width="320" height="96" rx="32"/>
      <circle class="r" cx="120" cy="272" r="50"/>
      <circle class="r" cx="280" cy="272" r="50"/>
      <circle class="r" cx="120" cy="272" r="20"/>
      <circle class="r" cx="280" cy="272" r="20"/>
      <path class="l" d="M210 182 L210 255"/>`,
  },
  {
    id: 'barco', name: 'Barco', say: 'el barco',
    svg: `
      <rect class="r" x="192" y="58" width="16" height="205"/>
      <path class="r" d="M208 58 L255 74 L208 92 Z"/>
      <path class="r" d="M184 78 L184 242 L70 242 Z"/>
      <path class="r" d="M216 96 L216 242 L320 242 Z"/>
      <path class="r" d="M50 258 L350 258 L296 336 L104 336 Z"/>
      <path class="r" d="M0 318 Q50 296 100 318 Q150 340 200 318 Q250 296 300 318 Q350 340 400 318 L410 410 L-10 410 Z"/>`,
  },
  {
    id: 'avion', name: 'Avión', say: 'el avión',
    svg: `
      <path class="r" d="M72 192 L38 92 L104 92 L138 192 Z"/>
      <path class="r" d="M55 182 Q55 158 90 158 L300 158 Q375 162 380 205 Q375 250 300 250 L90 250 Q55 250 55 226 Z"/>
      <path class="r" d="M318 172 Q352 178 364 204 L318 204 Z"/>
      <path class="r" d="M160 215 L265 215 L205 340 L150 340 Z"/>
      <circle class="r" cx="180" cy="188" r="16"/>
      <circle class="r" cx="228" cy="188" r="16"/>
      <circle class="r" cx="276" cy="188" r="16"/>`,
  },
  {
    id: 'tren', name: 'Tren', say: 'el tren',
    svg: `
      <circle class="r" cx="105" cy="58" r="26"/>
      <circle class="r" cx="152" cy="34" r="19"/>
      <path class="r" d="M88 172 L74 92 L130 92 L116 172 Z"/>
      <rect class="r" x="44" y="168" width="185" height="112" rx="22"/>
      <rect class="r" x="218" y="88" width="138" height="192" rx="14"/>
      <rect class="r" x="202" y="66" width="170" height="34" rx="12"/>
      <rect class="r" x="244" y="118" width="86" height="68" rx="12"/>
      <rect class="r" x="34" y="272" width="332" height="28" rx="12"/>
      <circle class="r" cx="96" cy="322" r="42"/>
      <circle class="r" cx="200" cy="322" r="42"/>
      <circle class="r" cx="304" cy="322" r="42"/>
      <circle class="d" cx="96" cy="322" r="10"/>
      <circle class="d" cx="200" cy="322" r="10"/>
      <circle class="d" cx="304" cy="322" r="10"/>`,
  },
];

const MI_MUNDO = [
  {
    id: 'sol', name: 'Sol', say: 'el sol',
    svg: `
      ${sunRays(200, 200, 100, 188, 8)}
      <circle class="r" cx="200" cy="200" r="112"/>
      <circle class="r" cx="140" cy="232" r="20"/>
      <circle class="r" cx="260" cy="232" r="20"/>
      <circle class="d" cx="160" cy="180" r="13"/>
      <circle class="d" cx="240" cy="180" r="13"/>
      <path class="l" d="M160 238 Q200 275 240 238"/>`,
  },
  {
    id: 'flor', name: 'Flor', say: 'la flor',
    svg: `
      <rect class="r" x="187" y="220" width="26" height="178" rx="10"/>
      <path class="r" d="M200 330 Q128 272 92 304 Q138 360 200 340 Z"/>
      <path class="r" d="M200 300 Q272 242 308 274 Q262 330 200 310 Z"/>
      ${petals(200, 150, 82, 56, 6)}
      <circle class="r" cx="200" cy="150" r="56"/>
      <circle class="d" cx="182" cy="140" r="8"/>
      <circle class="d" cx="218" cy="140" r="8"/>
      <path class="l" d="M180 165 Q200 182 220 165"/>`,
  },
  {
    id: 'arbol', name: 'Árbol', say: 'el árbol',
    svg: `
      <path class="r" d="M168 380 L180 235 L220 235 L232 380 Z"/>
      <path class="r" d="M100 232 Q45 200 78 148 Q66 76 140 76 Q172 22 234 46 Q306 36 314 108 Q366 140 334 202 Q332 254 270 248 Q200 272 140 252 Q98 262 100 232 Z"/>
      <circle class="r" cx="148" cy="140" r="24"/>
      <circle class="r" cx="252" cy="118" r="24"/>
      <circle class="r" cx="218" cy="200" r="24"/>
      <circle class="r" cx="292" cy="182" r="22"/>
      ${grass}`,
  },
  {
    id: 'casa', name: 'Casa', say: 'la casa',
    svg: `
      <rect class="r" x="258" y="70" width="42" height="95"/>
      <path class="r" d="M44 192 L200 66 L356 192 Z"/>
      <rect class="r" x="76" y="186" width="248" height="176"/>
      <rect class="r" x="168" y="256" width="64" height="106" rx="8"/>
      <rect class="r" x="100" y="214" width="54" height="54" rx="6"/>
      <rect class="r" x="246" y="214" width="54" height="54" rx="6"/>
      <circle class="d" cx="218" cy="312" r="6"/>
      ${grass}`,
  },
];

export const CATEGORIES = [
  { id: 'terrestres', name: 'Animales terrestres', say: 'animales terrestres', color: '#FFB547', drawings: TERRESTRES },
  { id: 'marinos', name: 'Animales marinos', say: 'animales marinos', color: '#4FC3F7', drawings: MARINOS },
  { id: 'dinosaurios', name: 'Dinosaurios', say: 'dinosaurios', color: '#81C784', drawings: DINOSAURIOS },
  { id: 'transportes', name: 'Transportes', say: 'medios de transporte', color: '#F48FB1', drawings: TRANSPORTES },
  { id: 'mundo', name: 'Mi mundo', say: 'mi mundo', color: '#B39DDB', drawings: MI_MUNDO },
];

const byId = new Map();
for (const cat of CATEGORIES) for (const d of cat.drawings) byId.set(d.id, { ...d, category: cat });

export const getCategory = (id) => CATEGORIES.find((c) => c.id === id);
export const getDrawing = (id) => byId.get(id);

/** Colores grandes y saturados. Sin negro para no tapar los contornos. */
export const PALETTE = [
  { name: 'rojo', hex: '#FF4B4B' },
  { name: 'naranjo', hex: '#FF9A2E' },
  { name: 'amarillo', hex: '#FFE135' },
  { name: 'verde claro', hex: '#9BE15D' },
  { name: 'verde', hex: '#2DB35A' },
  { name: 'celeste', hex: '#5AD1FF' },
  { name: 'azul', hex: '#3A6FF2' },
  { name: 'morado', hex: '#9B5CF6' },
  { name: 'rosado', hex: '#FF7EC4' },
  { name: 'café', hex: '#9A6B3F' },
  { name: 'durazno', hex: '#FFCFA8' },
  { name: 'gris', hex: '#A8B0BA' },
];
