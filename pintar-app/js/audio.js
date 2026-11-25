import { settings } from './storage.js';

let ctx = null;

/** Los navegadores exigen un gesto del usuario antes de reproducir audio. */
export function unlockAudio() {
  if (!ctx) {
    const C = window.AudioContext || window.webkitAudioContext;
    if (C) ctx = new C();
  }
  if (ctx && ctx.state === 'suspended') ctx.resume();
}

function tone(freq, dur, { type = 'sine', vol = 0.18, when = 0, to = null } = {}) {
  if (!ctx || !settings.sound) return;
  const t = ctx.currentTime + when;
  const osc = ctx.createOscillator();
  const gain = ctx.createGain();
  osc.type = type;
  osc.frequency.setValueAtTime(freq, t);
  if (to) osc.frequency.exponentialRampToValueAtTime(to, t + dur);
  gain.gain.setValueAtTime(0.0001, t);
  gain.gain.exponentialRampToValueAtTime(vol, t + 0.015);
  gain.gain.exponentialRampToValueAtTime(0.0001, t + dur);
  osc.connect(gain).connect(ctx.destination);
  osc.start(t);
  osc.stop(t + dur + 0.05);
}

export const sfx = {
  tap: () => tone(660, 0.08, { type: 'triangle', vol: 0.12 }),
  pop: () => {
    const f = 380 + Math.random() * 260;
    tone(f, 0.16, { to: f * 2.2, vol: 0.22 });
  },
  erase: () => tone(300, 0.12, { type: 'triangle', to: 150, vol: 0.1 }),
  undo: () => tone(520, 0.12, { type: 'triangle', to: 330, vol: 0.14 }),
  fanfare: () => {
    [523, 659, 784, 1047].forEach((f, i) => tone(f, 0.25, { type: 'triangle', when: i * 0.13, vol: 0.2 }));
    tone(1319, 0.5, { type: 'sine', when: 0.55, vol: 0.18 });
  },
};

let voice = null;
function pickVoice() {
  const voices = speechSynthesis.getVoices();
  voice =
    voices.find((v) => /^es[-_]CL/i.test(v.lang)) ||
    voices.find((v) => /^es[-_](419|MX|US|AR)/i.test(v.lang)) ||
    voices.find((v) => /^es/i.test(v.lang)) ||
    null;
}
if ('speechSynthesis' in window) {
  pickVoice();
  speechSynthesis.addEventListener?.('voiceschanged', pickVoice);
}

/** Voz amigable: refuerza colores y nombres (los niños aún no leen). */
export function speak(text) {
  if (!settings.sound || !('speechSynthesis' in window)) return;
  speechSynthesis.cancel();
  const u = new SpeechSynthesisUtterance(text);
  u.lang = voice?.lang || 'es-CL';
  if (voice) u.voice = voice;
  u.rate = 0.95;
  u.pitch = 1.25;
  speechSynthesis.speak(u);
}
