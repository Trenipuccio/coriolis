<?php
$lang = $_GET['lang'] ?? 'en';
if (!in_array($lang, ['en', 'it'], true)) $lang = 'en';
$t = include __DIR__ . '/includes/translations_' . $lang . '.php';

$originLabels = [
    11 => ['en' => 'Orphanage',        'it' => 'Orfanotrofio'],
    12 => ['en' => 'Mining Colony',    'it' => 'Colonia Mineraria'],
    15 => ['en' => 'Far Colonies',     'it' => 'Colonie Lontane'],
    23 => ['en' => 'Aluminum Bay',     'it' => 'Baia di Alluminio'],
    32 => ['en' => 'The Dome',         'it' => 'La Cupola'],
    41 => ['en' => 'The Haze',         'it' => 'La Foschia'],
    46 => ['en' => 'Hull Town',        'it' => 'Hull Town'],
    54 => ['en' => 'Turbine Halls',    'it' => 'Sale delle Turbine'],
    56 => ['en' => 'Cave Gardens',     'it' => 'Giardini delle Caverne'],
    61 => ['en' => 'Inner Sanctum',    'it' => 'Sancta Sanctorum'],
    63 => ['en' => 'The Lighthouse',   'it' => 'Il Faro'],
    64 => ['en' => 'Scavenger Herd',   'it' => 'Orda di Predatori'],
    66 => ['en' => 'Greatship',        'it' => 'Grandenave'],
];

?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($t['page_title']) ?> — Coriolis: The Great Dark</title>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=Cinzel:wght@400;600&family=Raleway:ital,wght@0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/generator.css">
</head>
<body>
<div class="wrapper">

  <!-- ── HEADER ──────────────────────────────────────────────────────────── -->
  <header>
    <div class="subtitle-line"><span>Guild Explorers</span></div>
    <h1>CORIOLIS: THE GREAT DARK</h1>
    <p class="tagline"><?= htmlspecialchars($t['page_subtitle']) ?></p>
  </header>

  <!-- ── TOP NAV ─────────────────────────────────────────────────────────── -->
  <div class="top-nav">
    <div class="lang-switch">
      <a href="?lang=en" class="lang-btn <?= $lang === 'en' ? 'active' : '' ?>">🇬🇧 EN</a>
      <a href="?lang=it" class="lang-btn <?= $lang === 'it' ? 'active' : '' ?>">🇮🇹 IT</a>
    </div>
    <div class="lang-switch">
      <a href="index.php" class="nav-btn">← Cheatsheet</a>
    </div>
  </div>

  <!-- ── CONTROLS ────────────────────────────────────────────────────────── -->
  <div class="controls">
    <div class="controls-grid">

      <div class="control-group">
        <label for="sel-mode"><?= htmlspecialchars($t['label_mode']) ?></label>
        <select id="sel-mode">
          <option value="normal"><?= htmlspecialchars($t['mode_normal']) ?></option>
          <option value="solo"><?= htmlspecialchars($t['mode_solo']) ?></option>
          <option value="custom"><?= htmlspecialchars($t['mode_custom']) ?></option>
        </select>
      </div>

      <div class="control-group">
        <label for="sel-prof"><?= htmlspecialchars($t['label_profession']) ?></label>
        <select id="sel-prof">
          <option value=""><?= htmlspecialchars($t['label_random']) ?></option>
          <option value="1"><?= htmlspecialchars($t['prof_Artist']) ?></option>
          <option value="2"><?= htmlspecialchars($t['prof_Enforcer']) ?></option>
          <option value="3"><?= htmlspecialchars($t['prof_Esoteric']) ?></option>
          <option value="4"><?= htmlspecialchars($t['prof_Odd Jobber']) ?></option>
          <option value="5"><?= htmlspecialchars($t['prof_Roughneck']) ?></option>
          <option value="6"><?= htmlspecialchars($t['prof_Scholar']) ?></option>
          <option value="7"><?= htmlspecialchars($t['prof_Scoundrel']) ?></option>
          <option value="8"><?= htmlspecialchars($t['prof_Traveler']) ?></option>
        </select>
      </div>

      <div class="control-group">
        <label for="sel-origin"><?= htmlspecialchars($t['label_origin']) ?></label>
        <select id="sel-origin">
          <option value=""><?= htmlspecialchars($t['label_random']) ?></option>
          <?php foreach ($originLabels as $key => $labels): ?>
          <option value="<?= $key ?>"><?= htmlspecialchars($labels[$lang]) ?></option>
          <?php endforeach ?>
        </select>
      </div>

    </div>

    <button class="btn-generate" id="btn-generate" onclick="generateCharacter()">
      <div class="spinner"></div>
      <span class="btn-text">⚡ <?= htmlspecialchars($t['btn_generate']) ?></span>
    </button>

    <div class="error-msg" id="error-msg"></div>
  </div>

  <!-- ── CHARACTER SHEET ─────────────────────────────────────────────────── -->
  <div id="sheet">

    <!-- Sheet header -->
    <div class="sheet-header">
      <button class="reroll-all" onclick="generateCharacter()"><?= htmlspecialchars($t['btn_reroll']) ?> ↺</button>
      <div class="char-name" id="char-name">—</div>
      <div class="char-meta">
        <span id="char-prof-label">—</span>
        <span class="mode-badge" id="char-mode-badge">—</span>
        <span id="char-points-label"></span>
      </div>
    </div>

    <div class="sheet-grid">

      <!-- ORIGIN -->
      <div class="card teal" id="card-origin">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_origin']) ?>
          <span class="roll-badge" id="origin-roll"></span>
          <button class="reroll-btn" onclick="rerollSection('origin')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="origin-location" id="origin-location">—</div>
        <div class="origin-desc" id="origin-desc">—</div>
        <span class="label-sm"><?= $lang === 'it' ? 'Talento di Origine' : 'Origin Talent' ?></span>
        <div class="talent-list">
          <span class="talent-tag origin" id="origin-talent">—</span>
        </div>
      </div>

      <!-- PROFESSION -->
      <div class="card" id="card-profession">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_profession']) ?>
          <span class="roll-badge" id="prof-roll"></span>
          <button class="reroll-btn" onclick="rerollSection('profession')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="big-value" id="prof-name">—</div>
        <span class="label-sm"><?= htmlspecialchars($t['key_attr_label']) ?></span>
        <span class="big-value" style="font-size:.85rem" id="prof-key-attr">—</span>
        <span class="label-sm"><?= htmlspecialchars($t['sec_talents']) ?></span>
        <div class="talent-list" id="prof-talents"></div>
      </div>

      <!-- SPECIALTY -->
      <div class="card orange" id="card-specialty">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_specialty']) ?>
          <span class="roll-badge" id="spec-roll"></span>
          <button class="reroll-btn" onclick="rerollSection('specialty')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="spec-name" id="spec-name">—</div>
        <div class="spec-desc" id="spec-desc">—</div>
        <div style="margin-top:.7rem">
          <span class="label-sm"><?= htmlspecialchars($t['free_talent']) ?></span>
          <span class="talent-tag free" id="spec-free-talent">—</span>
        </div>
      </div>

      <!-- EQUIPMENT -->
      <div class="card" id="card-equipment">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_equipment']) ?>
          <button class="reroll-btn" onclick="rerollSection('equipment')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="desc-text" id="char-equipment">—</div>
      </div>

      <!-- ATTRIBUTES -->
      <div class="card span-2" id="card-attributes">
        <div class="card-title"><?= htmlspecialchars($t['sec_attributes']) ?></div>
        <div class="attr-grid">
          <?php foreach (['STR', 'AGI', 'LOG', 'PER', 'INS', 'EMP'] as $a): ?>
          <div class="attr-item" id="attr-<?= $a ?>">
            <span class="attr-label"><?= htmlspecialchars($t['attr_' . $a]) ?></span>
            <span class="attr-value" id="attr-val-<?= $a ?>">—</span>
          </div>
          <?php endforeach ?>
        </div>
      </div>

      <!-- DERIVED STATS -->
      <div class="card teal">
        <div class="card-title"><?= htmlspecialchars($t['sec_derived']) ?></div>
        <div class="derived-grid">
          <div class="derived-item">
            <span class="derived-label">❤ <?= htmlspecialchars($t['stat_health']) ?></span>
            <span class="derived-value" id="stat-health">—</span>
            <span class="derived-formula">STR + AGI</span>
          </div>
          <div class="derived-item">
            <span class="derived-label">✨ <?= htmlspecialchars($t['stat_hope']) ?></span>
            <span class="derived-value" id="stat-hope">—</span>
            <span class="derived-formula">LOG + EMP</span>
          </div>
          <div class="derived-item">
            <span class="derived-label">💙 <?= htmlspecialchars($t['stat_heart']) ?></span>
            <span class="derived-value" id="stat-heart">—</span>
            <span class="derived-formula">INS + PER</span>
          </div>
          <div class="derived-item">
            <span class="derived-label">🎒 <?= htmlspecialchars($t['stat_carry']) ?></span>
            <span class="derived-value" id="stat-carry">—</span>
            <span class="derived-formula" id="stat-carry-formula">STR + 4</span>
          </div>
        </div>
      </div>

      <!-- CAPITAL -->
      <div class="card orange" id="card-capital">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_capital']) ?>
          <button class="reroll-btn" onclick="rerollSection('capital')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div>
          <span class="capital-value" id="capital-value">—</span>
          <span class="capital-currency"><?= htmlspecialchars($t['rukh']) ?></span>
        </div>
        <span class="label-sm" style="margin-top:.5rem" id="capital-formula">—</span>
      </div>

      <!-- QUIRK -->
      <div class="card" id="card-quirk">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_quirk']) ?>
          <span class="roll-badge" id="quirk-roll"></span>
          <button class="reroll-btn" onclick="rerollSection('quirk')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="desc-text" id="char-quirk">—</div>
      </div>

      <!-- APPEARANCE -->
      <div class="card" id="card-appearance">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_appearance']) ?>
          <span class="roll-badge" id="appearance-roll"></span>
          <button class="reroll-btn" onclick="rerollSection('appearance')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="desc-text" id="char-appearance">—</div>
      </div>

      <!-- KEEPSAKE -->
      <div class="card green" id="card-keepsake">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_keepsake']) ?>
          <span class="roll-badge" id="keepsake-roll"></span>
          <button class="reroll-btn" onclick="rerollSection('keepsake')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="desc-text" id="char-keepsake">—</div>
      </div>

      <!-- REASON -->
      <div class="card" id="card-reason">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_reason']) ?>
          <span class="roll-badge" id="reason-roll"></span>
          <button class="reroll-btn" onclick="rerollSection('reason')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="desc-text" id="char-reason">—</div>
      </div>

      <!-- BACKGROUND (solo only) -->
      <div class="card red span-2" id="card-background" style="display:none">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_background']) ?>
          <button class="reroll-btn" onclick="rerollSection('background')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="desc-text" id="char-background">—</div>
      </div>

      <!-- BLIGHT SCAR (solo only) -->
      <div class="card red" id="card-blight-scar" style="display:none">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_blight_scar']) ?>
          <span class="roll-badge" id="blight-roll"></span>
          <button class="reroll-btn" onclick="rerollSection('blight_scar')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="scar-name" id="scar-name">—</div>
        <span class="label-sm"><?= htmlspecialchars($t['effect_label']) ?></span>
        <div class="desc-text" id="scar-effect">—</div>
      </div>

      <!-- MONIKER (solo only) -->
      <div class="card orange" id="card-moniker" style="display:none">
        <div class="card-title">
          <?= htmlspecialchars($t['sec_moniker']) ?>
          <button class="reroll-btn" onclick="rerollSection('moniker')"><?= htmlspecialchars($t['btn_reroll_section']) ?></button>
        </div>
        <div class="moniker-full" id="moniker-full">—</div>
        <div class="moniker-parts" id="moniker-parts"></div>
      </div>

    </div><!-- /sheet-grid -->

    <!-- ACTIONS BAR -->
    <div class="actions-bar">
      <button class="action-btn primary" onclick="generateCharacter()">⚡ <?= htmlspecialchars($t['btn_reroll']) ?></button>
      <button class="action-btn" onclick="copySheet()"><?= htmlspecialchars($t['btn_copy']) ?></button>
      <button class="action-btn" onclick="window.print()"><?= htmlspecialchars($t['btn_print']) ?></button>
    </div>

  </div><!-- /sheet -->

  <footer>
    <span>Coriolis: The Great Dark —
      <?= $lang === 'it' ? 'Generatore di Personaggio Non Ufficiale' : 'Unofficial Character Generator' ?>
      · <?= date('Y') ?>
    </span>
  </footer>

</div><!-- /wrapper -->

<script src="assets/js/config.php?lang=<?= urlencode($lang) ?>"></script>
<script src="assets/js/generator.js"></script>

</body>
</html>
