/**
 * Coriolis: The Great Dark — Character Generator
 * Frontend logic: fetch, render, reroll, copy, print
 */

/* ── Globals injected by PHP (see generator.php) ───────────────────────────── */
// LANG       — 'en' | 'it'
// T          — UI translation strings
// TRANS_IT   — content translations (quirks, talents, etc.)

/* ── Content translation helper ────────────────────────────────────────────── */
function tr(type, val) {
  if (LANG !== 'it') return val;
  const map = TRANS_IT[type] || {};
  return map[val] || val;
}

/* ── State ──────────────────────────────────────────────────────────────────── */
let currentChar = null;

/* ── Generate (full character) ──────────────────────────────────────────────── */
async function generateCharacter(overrides = {}) {
  const btn   = document.getElementById('btn-generate');
  const errEl = document.getElementById('error-msg');

  btn.classList.add('loading');
  btn.disabled = true;
  errEl.style.display = 'none';

  const mode   = overrides.mode   || document.getElementById('sel-mode').value;
  const prof   = overrides.prof   || document.getElementById('sel-prof').value;
  const origin = overrides.origin || document.getElementById('sel-origin').value;

  const params = new URLSearchParams({ lang: LANG, mode });
  if (prof)   params.set('prof',   prof);
  if (origin) params.set('origin', origin);

  try {
    const res  = await fetch('api/generate.php?' + params);
    if (!res.ok) throw new Error('HTTP ' + res.status);
    const char = await res.json();
    if (char.error) throw new Error(char.error);

    currentChar = char;
    renderCharacter(char);

    const sheet = document.getElementById('sheet');
    sheet.classList.add('visible');
    sheet.scrollIntoView({ behavior: 'smooth', block: 'start' });

  } catch (e) {
    errEl.textContent = T.error + ' (' + e.message + ')';
    errEl.style.display = 'block';
  } finally {
    btn.classList.remove('loading');
    btn.disabled = false;
  }
}

/* ── Reroll a single section ────────────────────────────────────────────────── */
async function rerollSection(section) {
  if (!currentChar) return;

  const params = new URLSearchParams({
    lang:  LANG,
    mode:  currentChar.mode,
  });
  if (section !== 'origin')     params.set('origin', currentChar.origin.roll);
  if (section !== 'profession') params.set('prof',   currentChar.profession.id);

  try {
    const res  = await fetch('api/generate.php?' + params);
    const char = await res.json();

    // Merge only the rerolled section into current character
    const mergeMap = {
      origin:     () => { currentChar.origin     = char.origin; },
      profession: () => { currentChar.profession  = char.profession; currentChar.attributes = char.attributes; currentChar.derived = char.derived; },
      specialty:  () => { currentChar.profession.specialty = char.profession.specialty; },
      equipment:  () => { currentChar.profession.equipment = char.profession.equipment; },
      capital:    () => { currentChar.capital     = char.capital; },
      quirk:      () => { currentChar.quirk       = char.quirk; },
      keepsake:   () => { currentChar.keepsake    = char.keepsake; },
      appearance: () => { currentChar.appearance  = char.appearance; },
      reason:     () => { currentChar.reason      = char.reason; },
      background: () => { currentChar.background  = char.background; },
      blight_scar:() => { currentChar.blight_scar = char.blight_scar; },
      moniker:    () => { currentChar.moniker      = char.moniker; },
    };

    if (mergeMap[section]) mergeMap[section]();
    renderCharacter(currentChar);

  } catch (e) {
    console.error('Reroll failed:', e);
  }
}

/* ── Render full character sheet ────────────────────────────────────────────── */
function renderCharacter(c) {
  const isSolo = (c.mode === 'solo');

  // ── Header ────────────────────────────────────────────────────────────────
  set('char-name',         c.name.full || '—');
  set('char-prof-label',   tr('professions', c.profession.name));
  set('char-mode-badge',   T.modeNames[c.mode] || c.mode);
  set('char-points-label', T.points + ': ' + c.points + '  |  ' + T.xpLabel + ': ' + c.start_xp);

  // ── Origin ────────────────────────────────────────────────────────────────
  set('origin-roll',    'D66: ' + c.origin.roll);
  set('origin-location', tr('origins', c.origin.location));
  set('origin-desc',     tr('origin_descs', c.origin.desc));
  set('origin-talent',   tr('talents', c.origin.talent));

  // ── Profession ────────────────────────────────────────────────────────────
  set('prof-roll', 'D8: ' + c.profession.roll);
  set('prof-name', tr('professions', c.profession.name));
  set('prof-key-attr',
    LANG === 'it'
      ? (TRANS_IT.keyAttrs[c.profession.key_attr] || c.profession.key_attr)
      : c.profession.key_attr
  );

  const tList = document.getElementById('prof-talents');
  tList.innerHTML = '';
  (c.profession.talents || []).forEach(tal => {
    const span = document.createElement('span');
    span.className = 'talent-tag';
    span.textContent = tr('talents', tal);
    tList.appendChild(span);
  });

  // ── Specialty ─────────────────────────────────────────────────────────────
  set('spec-roll',        'D6: ' + c.profession.specialty.roll);
  set('spec-name',        (LANG === 'it' && c.profession.specialty.name_it) ? c.profession.specialty.name_it : c.profession.specialty.name);
  set('spec-desc',        (LANG === 'it' && c.profession.specialty.desc_it) ? c.profession.specialty.desc_it : c.profession.specialty.desc);
  set('spec-free-talent', tr('talents', c.profession.specialty.talent));

  // ── Equipment ─────────────────────────────────────────────────────────────
  set('char-equipment', c.profession.equipment || '—');

  // ── Attributes ────────────────────────────────────────────────────────────
  const keyAttrCodeMap = {
    'Empathy': 'EMP', 'Agility': 'AGI', 'Insight': 'INS',
    'Strength': 'STR', 'Logic': 'LOG', 'Perception': 'PER',
  };
  const keyAttrCode = keyAttrCodeMap[c.profession.key_attr] || 'EMP';

  ['STR', 'AGI', 'LOG', 'PER', 'INS', 'EMP'].forEach(a => {
    const wrapper = document.getElementById('attr-' + a);
    const valEl   = document.getElementById('attr-val-' + a);
    if (wrapper && valEl) {
      valEl.textContent = c.attributes[a] ?? '—';
      wrapper.classList.toggle('key-attr', a === keyAttrCode);
    }
  });

  // ── Derived stats ─────────────────────────────────────────────────────────
  set('stat-health',         c.derived.health);
  set('stat-hope',           c.derived.hope);
  set('stat-heart',          c.derived.heart);
  set('stat-carry',          c.derived.carry);
  set('stat-carry-formula',  isSolo ? 'STR+6' : 'STR+4');

  // ── Capital ───────────────────────────────────────────────────────────────
  set('capital-value',   c.capital.total.toLocaleString());
  set('capital-formula', c.capital.formula);

  // ── Personal details ──────────────────────────────────────────────────────
  set('quirk-roll',       'D66: ' + c.quirk.roll);
  set('char-quirk',       tr('quirks', c.quirk.value));

  set('appearance-roll',  'D66: ' + c.appearance.roll);
  set('char-appearance',  tr('appearances', c.appearance.value));

  set('keepsake-roll',    'D66: ' + c.keepsake.roll);
  set('char-keepsake',    tr('keepsakes', c.keepsake.value));

  set('reason-roll',      'D66: ' + c.reason.roll);
  set('char-reason',      tr('reasons', c.reason.value));

  // ── Solo-only sections ────────────────────────────────────────────────────
  toggleCard('card-background',  isSolo);
  toggleCard('card-blight-scar', isSolo);
  toggleCard('card-moniker',     isSolo);

  if (isSolo) {
    set('char-background', c.background ? tr('backgrounds', c.background) : '—');

    if (c.blight_scar) {
      set('blight-roll',  'D66: ' + c.blight_scar.roll);
      set('scar-name',    tr('blight_scar_names', c.blight_scar.scar));
      set('scar-effect',  tr('blight_scar_effects', c.blight_scar.effect));
    }

    if (c.moniker) {
      set('moniker-full',  c.moniker.full);
      set('moniker-parts',
        c.moniker.prefix + ' (D66: ' + c.moniker.prefix_roll + ')' +
        ' + ' +
        c.moniker.suffix + ' (D66: ' + c.moniker.suffix_roll + ')'
      );
    }
  }
}

/* ── DOM helper: set text content ───────────────────────────────────────────── */
function set(id, val) {
  const el = document.getElementById(id);
  if (el) el.textContent = (val !== null && val !== undefined) ? val : '—';
}

/* ── DOM helper: show/hide card ─────────────────────────────────────────────── */
function toggleCard(id, show) {
  const el = document.getElementById(id);
  if (el) el.style.display = show ? '' : 'none';
}

/* ── Copy sheet to clipboard ────────────────────────────────────────────────── */
function copySheet() {
  if (!currentChar) return;
  const c = currentChar;

  const lines = [
    '=== CORIOLIS: THE GREAT DARK — CHARACTER SHEET ===',
    'Name: '       + c.name.full,
    'Profession: ' + c.profession.name + '  |  Mode: ' + c.mode + '  |  Points: ' + c.points,
    '',
    '-- ORIGIN --',
    c.origin.location + ' (D66: ' + c.origin.roll + ')',
    c.origin.desc,
    'Origin Talent: ' + c.origin.talent,
    '',
    '-- ATTRIBUTES --',
    Object.entries(c.attributes).map(([k, v]) => k + ': ' + v).join('  |  '),
    'Health: ' + c.derived.health + '  |  Hope: ' + c.derived.hope +
      '  |  Heart: ' + c.derived.heart + '  |  Carry: ' + c.derived.carry,
    '',
    '-- PROFESSION: ' + c.profession.name + ' --',
    'Key Attribute: ' + c.profession.key_attr,
    'Key Talents: '   + c.profession.talents.join(', '),
    'Specialty: ' + c.profession.specialty.name + ' (Free Talent: ' + c.profession.specialty.talent + ')',
    c.profession.specialty.desc,
    'Equipment: ' + c.profession.equipment,
    '',
    '-- CHARACTER DETAILS --',
    'Capital: '    + c.capital.total + ' rukh (' + c.capital.formula + ')',
    'Quirk: '      + c.quirk.value,
    'Appearance: ' + c.appearance.value,
    'Keepsake: '   + c.keepsake.value,
    'Reason: '     + c.reason.value,
  ];

  if (c.mode === 'solo' && c.background) {
    lines.push('', '-- SOLO MODE --');
    lines.push('Background: ' + c.background);
    if (c.blight_scar) lines.push('Blight Scar: ' + c.blight_scar.scar + ' — ' + c.blight_scar.effect);
    if (c.moniker)     lines.push('Moniker: '    + c.moniker.full);
  }

  navigator.clipboard?.writeText(lines.join('\n'))
    .then(()  => alert(LANG === 'it' ? 'Scheda copiata!' : 'Sheet copied!'))
    .catch(()  => alert(LANG === 'it' ? 'Copia non supportata.' : 'Copy not supported.'));
}

/* ── Auto-generate on first load ────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
  generateCharacter();
});
