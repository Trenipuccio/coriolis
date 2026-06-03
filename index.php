<?php
/**
 * Coriolis: The Great Dark — Cheatsheet
 * index.php — Versione PHP con supporto multilingua
 */
$lang = $_GET['lang'] ?? 'en';
if (!in_array($lang, ['en', 'it'], true)) $lang = 'en';
$t = include __DIR__ . '/includes/translations_' . $lang . '.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coriolis: <?php echo htmlspecialchars($t['subtitle']);?> — <?php echo htmlspecialchars($t['cheatsheet_title']); ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=Cinzel:wght@400;600&family=Raleway:ital,wght@0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/cheatsheet.css">
</head>
<body class="lang-<?php echo $lang; ?>">
<div class="wrapper">

  <header>
    <div class="subtitle-line"><span><?php  echo htmlspecialchars($t['reference_title']);?></span></div>
    <h1>CORIOLIS<br><?php echo htmlspecialchars($t['subtitle']);?></h1>
    <p class="tagline"><?php echo htmlspecialchars($t['explore_title']);?></p>
  </header>

  <!-- LANG SWITCH -->
  <div class="lang-switch">
    <a href="?lang=it" class="lang-btn <?php if($lang==='it') echo 'active'; ?>">🇮🇹 Italiano</a>
    <a href="?lang=en" class="lang-btn <?php if($lang==='en') echo 'active'; ?>">🇬🇧 English</a>
  </div>

  <!-- GENERATOR BUTTON -->
  <div class="generator-bar">
    <a href="generator.php?lang=<?php echo $lang; ?>" class="btn-generator">
      <span class="icon">⚡</span>
      <?php echo htmlspecialchars($t['btn_generator']); ?>
      <span style="font-size:.75rem;opacity:.8;margin-left:.2rem">→</span>
    </a>
  </div>

  <!-- TABS -->
  <div class="tabs">
    <button class="tab-btn active" onclick="showTab('regole')">
      <span data-it>⚙ Regole Base</span><span data-en>⚙ Core Rules</span>
    </button>
    <button class="tab-btn" onclick="showTab('combattimento')">
      <span data-it>⚔ Combattimento</span><span data-en>⚔ Combat</span>
    </button>
    <button class="tab-btn" onclick="showTab('pericoli')">
      <span data-it>☣ Blight & Pericoli</span><span data-en>☣ Blight & Hazards</span>
    </button>
    <button class="tab-btn" onclick="showTab('personaggio')">
      <span data-it>👤 Personaggio</span><span data-en>👤 Character</span>
    </button>
    <button class="tab-btn" onclick="showTab('professioni')">
      <span data-it>🧑 Professioni</span><span data-en>🧑 Professions</span>
    </button>
    <button class="tab-btn" onclick="showTab('talenti')">
      <span data-it>⭐ Talenti</span><span data-en>⭐ Talents</span>
    </button>
    <button class="tab-btn" onclick="showTab('volatile')">
      <span data-it>🐦 Il Volatile</span><span data-en>🐦 The Bird</span>
    </button>
    <button class="tab-btn" onclick="showTab('fazioni')">
      <span data-it>🏛 Fazioni</span><span data-en>🏛 Factions</span>
    </button>
    <button class="tab-btn" onclick="showTab('consigli')">
      <span data-it>💡 Consigli</span><span data-en>💡 Tips</span>
    </button>
  </div>

  <!-- ================================================================ -->
  <!-- TAB: REGOLE BASE -->
  <!-- ================================================================ -->
  <div id="tab-regole" class="tab-content active">

    <div data-it>
      <div class="sec-heading"><span class="icon">⚙</span> Regole Base</div>
    </div>
    <div data-en>
      <div class="sec-heading"><span class="icon">⚙</span> Core Rules</div>
    </div>

    <div class="grid grid-2">

      <!-- DADI -->
      <div class="card">
        <div class="card-title" data-it>🎲 Come Tirare i Dadi</div>
        <div class="card-title" data-en>🎲 Rolling Dice</div>

        <div class="dice-box">
          <div><div class="die gold">6</div><p style="font-size:0.7rem;text-align:center;margin-top:4px;color:var(--gold)">Base</p></div>
          <div><div class="die black">6</div><p style="font-size:0.7rem;text-align:center;margin-top:4px;color:#aaa">Gear</p></div>
        </div>

        <div data-it>
          <div class="formula"><span>Attributo</span> + <span>Talento</span> + <span>Bonus Equipaggiamento</span> = Dadi</div>
          <ul>
            <li><strong>Dado Base (dorato):</strong> uguale al punteggio dell'Attributo + livello del Talento</li>
            <li><strong>Dado Gear (nero):</strong> fornito dall'equipaggiamento (Gear Bonus)</li>
            <li><strong>Successo:</strong> almeno un <span style="color:var(--gold2);font-weight:600">6</span> sui dadi base</li>
            <li><strong>Successi extra:</strong> ogni 6 aggiuntivo migliora il risultato</li>
          </ul>
          <div class="highlight">
            <strong>Senza talento?</strong> Si tira comunque — solo il valore dell'Attributo (+ equipaggiamento).
          </div>
        </div>
        <div data-en>
          <div class="formula"><span>Attribute</span> + <span>Talent</span> + <span>Gear Bonus</span> = Dice pool</div>
          <ul>
            <li><strong>Base Dice (golden):</strong> equal to Attribute score + Talent level</li>
            <li><strong>Gear Dice (black):</strong> provided by equipment (Gear Bonus)</li>
            <li><strong>Success:</strong> at least one <span style="color:var(--gold2);font-weight:600">6</span> on your dice</li>
            <li><strong>Extra successes:</strong> each additional 6 improves the outcome</li>
          </ul>
          <div class="highlight">
            <strong>No talent?</strong> You can still roll — only Attribute (+ gear bonus).
          </div>
        </div>
      </div>

      <!-- FORZARE -->
      <div class="card teal">
        <div class="card-title" data-it>🔁 Forzare il Tiro</div>
        <div class="card-title" data-en>🔁 Pushing the Roll</div>

        <div data-it>
          <p>Se fallisci, puoi <strong>forzare il tiro una sola volta</strong>: ritira tutti i dadi che non mostrano 1 o 6.</p>
          <div class="highlight teal">
            <strong>⚠ Rischio:</strong> ogni <span style="color:#e74c3c">1</span> sui <em>Dadi Base</em> nella forzatura = perdi 1 punto <strong>Speranza</strong>.
          </div>
          <ul>
            <li>I Dadi Gear che mostrano 1 dopo la forzatura riducono il Gear Bonus dell'equipaggiamento</li>
            <li>Se il Gear Bonus arriva a 0, l'oggetto si rompe definitivamente</li>
            <li>Alcuni talenti permettono una seconda forzatura</li>
          </ul>
        </div>
        <div data-en>
          <p>If you fail, you can <strong>push the roll once</strong>: reroll all dice that don't show 1 or 6.</p>
          <div class="highlight teal">
            <strong>⚠ Risk:</strong> each <span style="color:#e74c3c">1</span> on <em>Base Dice</em> when pushing = lose 1 <strong>Hope</strong>.
          </div>
          <ul>
            <li>Gear Dice showing 1 after pushing reduce the item's Gear Bonus</li>
            <li>If Gear Bonus reaches 0, the item breaks permanently</li>
            <li>Some talents allow a second push</li>
          </ul>
        </div>
      </div>

      <!-- ATTRIBUTI -->
      <div class="card">
        <div class="card-title" data-it>📊 I 6 Attributi</div>
        <div class="card-title" data-en>📊 The 6 Attributes</div>

        <table>
          <thead>
            <tr>
              <th data-it>Attributo</th><th data-en>Attribute</th>
              <th data-it>Descriz.</th><th data-en>Description</th>
            </tr>
          </thead>
          <tbody>
            <tr><td data-it><strong>STR</strong> Forza</td><td data-en><strong>STR</strong> Strength</td><td data-it>Potenza fisica</td><td data-en>Physical power</td></tr>
            <tr><td data-it><strong>AGI</strong> Agilità</td><td data-en><strong>AGI</strong> Agility</td><td data-it>Velocità e riflessi</td><td data-en>Speed & reflexes</td></tr>
            <tr><td data-it><strong>LOG</strong> Logica</td><td data-en><strong>LOG</strong> Logic</td><td data-it>Intelligenza</td><td data-en>Intelligence</td></tr>
            <tr><td data-it><strong>PER</strong> Percezione</td><td data-en><strong>PER</strong> Perception</td><td data-it>Consapevolezza</td><td data-en>Awareness</td></tr>
            <tr><td data-it><strong>EMP</strong> Empatia</td><td data-en><strong>EMP</strong> Empathy</td><td data-it>Carisma sociale</td><td data-en>Charisma & social</td></tr>
            <tr><td data-it><strong>INS</strong> Intuizione</td><td data-en><strong>INS</strong> Insight</td><td data-it>Stabilità mentale</td><td data-en>Mental stability</td></tr>
          </tbody>
        </table>
        <p data-it style="font-size:0.8rem;color:var(--muted)">Scala da 2 a 6. Più alto = meglio.</p>
        <p data-en style="font-size:0.8rem;color:var(--muted)">Scale from 2 to 6. Higher = better.</p>
      </div>

      <!-- SALUTE / SPERANZA / CUORE -->
      <div class="card orange">
        <div class="card-title" data-it>❤ Salute, Speranza, Cuore</div>
        <div class="card-title" data-en>❤ Health, Hope, Heart</div>

        <table>
          <thead><tr>
            <th data-it>Risorsa</th><th data-en>Resource</th>
            <th data-it>Calcolo</th><th data-en>Calculation</th>
            <th data-it>Ridotta da</th><th data-en>Reduced by</th>
          </tr></thead>
          <tbody>
            <tr>
              <td data-it>❤ <strong>Salute</strong></td><td data-en>❤ <strong>Health</strong></td>
              <td>STR + AGI</td>
              <td data-it>Danno fisico</td><td data-en>Physical damage</td>
            </tr>
            <tr>
              <td data-it>✨ <strong>Speranza</strong></td><td data-en>✨ <strong>Hope</strong></td>
              <td>LOG + EMP</td>
              <td data-it>Disperazione</td><td data-en>Despair</td>
            </tr>
            <tr>
              <td data-it>💙 <strong>Cuore</strong></td><td data-en>💙 <strong>Heart</strong></td>
              <td>INS + PER</td>
              <td data-it>Blight</td><td data-en>Blight</td>
            </tr>
          </tbody>
        </table>
        <div class="highlight" style="border-color:var(--orange);background:rgba(230,126,34,0.07)" data-it>
          Quando una risorsa raggiunge 0 sei <strong>abbattuto</strong> — non puoi effettuare tiri azione.
        </div>
        <div class="highlight" style="border-color:var(--orange);background:rgba(230,126,34,0.07)" data-en>
          When a resource reaches 0 you are <strong>broken</strong> — you cannot make action rolls.
        </div>
      </div>

      <!-- TEMPO -->
      <div class="card">
        <div class="card-title" data-it>⏱ Unità di Tempo</div>
        <div class="card-title" data-en>⏱ Units of Time</div>
        <table>
          <thead><tr>
            <th data-it>Unità</th><th data-en>Unit</th>
            <th data-it>Durata</th><th data-en>Duration</th>
            <th data-it>Usata per</th><th data-en>Used for</th>
          </tr></thead>
          <tbody>
            <tr>
              <td data-it>Round</td><td data-en>Round</td>
              <td>10 sec</td>
              <td data-it>Azione in combattimento</td><td data-en>Combat action</td>
            </tr>
            <tr>
              <td data-it>Tratto</td><td data-en>Stretch</td>
              <td>15 min</td>
              <td data-it>Esplorare una stanza</td><td data-en>Search a room</td>
            </tr>
            <tr>
              <td data-it>Turno</td><td data-en>Shift</td>
              <td>6 ore</td>
              <td data-it>Trekking / servizi nave</td><td data-en>Trekking / ship duties</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- TIRI SPECIALI -->
      <div class="card teal">
        <div class="card-title" data-it>🎯 Tiri Speciali</div>
        <div class="card-title" data-en>🎯 Special Rolls</div>
        <div data-it>
          <h3>Tiro Contrapposto</h3>
          <ul>
            <li>Entrambi tirano i dadi. Se il tuo tiro fallisce, fallisci.</li>
            <li>Se entrambi riescono, vince chi ha più 6.</li>
            <li>Solo la parte attiva può forzare il tiro.</li>
          </ul>
          <h3>Tiro di Gruppo</h3>
          <ul>
            <li>Un solo esploratore tira per il gruppo — gli altri possono aiutare.</li>
            <li>Il fallimento vale per tutti.</li>
          </ul>
          <h3>Aiuto</h3>
          <ul>
            <li>Fino a 3 esploratori possono aiutare: +1 Dado Base ciascuno.</li>
            <li>In combattimento, aiutare = usare la propria azione.</li>
          </ul>
        </div>
        <div data-en>
          <h3>Opposed Roll</h3>
          <ul>
            <li>Both roll dice. If your roll fails, you fail.</li>
            <li>If both succeed, most 6s win.</li>
            <li>Only the active party can push.</li>
          </ul>
          <h3>Group Roll</h3>
          <ul>
            <li>One explorer rolls — others may help.</li>
            <li>Failure counts for the whole group.</li>
          </ul>
          <h3>Help</h3>
          <ul>
            <li>Up to 3 explorers can help: +1 Base Die each.</li>
            <li>In combat, helping = spending your action.</li>
          </ul>
        </div>
      </div>

    </div><!-- /grid -->
  </div><!-- /tab regole -->


  <!-- ================================================================ -->
  <!-- TAB: COMBATTIMENTO -->
  <!-- ================================================================ -->
  <div id="tab-combattimento" class="tab-content">

    <div data-it><div class="sec-heading"><span class="icon">⚔</span> Combattimento</div></div>
    <div data-en><div class="sec-heading"><span class="icon">⚔</span> Combat</div></div>

    <div class="grid grid-2">

      <!-- INIZIATIVA -->
      <div class="card">
        <div class="card-title" data-it>🃏 Iniziativa</div>
        <div class="card-title" data-en>🃏 Initiative</div>
        <div data-it>
          <ol class="steps">
            <li>Prepara 10 carte numerate 1-10 (usa un mazzo normale, rimuovi i personaggi).</li>
            <li>Ogni partecipante (e il GM per ogni PNG/gruppo) pesca una carta.</li>
            <li>Si agisce dal numero più basso al più alto.</li>
            <li>Fine del round: tutti ripescano le carte.</li>
          </ol>
          <div class="highlight">
            <strong>Sorpresa:</strong> se l'attacco è completamente inaspettato, scegli liberamente il numero.
          </div>
          <p style="margin-top:0.6rem"><strong>Scambio:</strong> puoi cedere la tua carta a un altro personaggio prima di agire.</p>
        </div>
        <div data-en>
          <ol class="steps">
            <li>Prepare 10 cards numbered 1–10 (use a normal deck, remove face cards).</li>
            <li>Each participant (and the GM per NPC/group) draws a card.</li>
            <li>Act from lowest to highest number.</li>
            <li>End of round: everyone draws again.</li>
          </ol>
          <div class="highlight">
            <strong>Surprise:</strong> if the attack is fully surprising, choose any card number.
          </div>
          <p style="margin-top:0.6rem"><strong>Exchange:</strong> you can give your card to another character before acting.</p>
        </div>
      </div>

      <!-- AZIONI -->
      <div class="card">
        <div class="card-title" data-it>🎬 Azioni per Round</div>
        <div class="card-title" data-en>🎬 Actions per Round</div>
        <div data-it>
          <p>Ogni turno: <strong>1 Movimento + 1 Azione</strong></p>
          <table>
            <thead><tr><th>Azione</th><th>Attributo</th></tr></thead>
            <tbody>
              <tr><td>Attacco ravvicinato</td><td>STR</td></tr>
              <tr><td>Sparare</td><td>AGI</td></tr>
              <tr><td>Primo soccorso</td><td>LOG</td></tr>
              <tr><td>Persuadere</td><td>EMP</td></tr>
              <tr><td>Correre (2° movimento)</td><td>—</td></tr>
              <tr><td>Parare (reazione)</td><td>STR</td></tr>
              <tr><td>Schivare (reazione)</td><td>AGI</td></tr>
              <tr><td>Comandare Volatile</td><td>INS</td></tr>
            </tbody>
          </table>
          <p style="margin-top:0.6rem;font-size:0.8rem;color:var(--muted)"><em>Azioni gratuite: estrarre arma, cadere a terra, urlare.</em></p>
        </div>
        <div data-en>
          <p>Each turn: <strong>1 Movement + 1 Action</strong></p>
          <table>
            <thead><tr><th>Action</th><th>Attribute</th></tr></thead>
            <tbody>
              <tr><td>Close combat attack</td><td>STR</td></tr>
              <tr><td>Shoot</td><td>AGI</td></tr>
              <tr><td>First aid</td><td>LOG</td></tr>
              <tr><td>Persuade</td><td>EMP</td></tr>
              <tr><td>Run (2nd move)</td><td>—</td></tr>
              <tr><td>Block (reaction)</td><td>STR</td></tr>
              <tr><td>Dodge (reaction)</td><td>AGI</td></tr>
              <tr><td>Command Bird</td><td>INS</td></tr>
            </tbody>
          </table>
          <p style="margin-top:0.6rem;font-size:0.8rem;color:var(--muted)"><em>Free actions: draw weapon, drop prone, shout.</em></p>
        </div>
      </div>

      <!-- DANNO E ARMATURA -->
      <div class="card red">
        <div class="card-title" data-it>💥 Danno & Armatura</div>
        <div class="card-title" data-en>💥 Damage & Armor</div>
        <div data-it>
          <ul>
            <li><strong>Danno base</strong> = valore dell'arma + 1 per ogni 6 extra</li>
            <li><strong>Armatura:</strong> tira tanti Dadi Gear quant'è l'Armor Rating — ogni 6 riduce il danno di 1</li>
            <li><strong>Copertura:</strong> funziona come armatura extra</li>
            <li><strong>Soglia Critica:</strong> se il danno finale ≥ Crit Threshold, tira D66 sulla tabella ferite critiche</li>
          </ul>
          <div class="highlight red">
            <strong>Abbattuto da danno:</strong> non puoi agire. Recuperi 1 Salute per Turno da solo, o con Primo Soccorso (LOG).
          </div>
        </div>
        <div data-en>
          <ul>
            <li><strong>Base damage</strong> = weapon value + 1 per extra 6</li>
            <li><strong>Armor:</strong> roll Gear Dice equal to Armor Rating — each 6 reduces damage by 1</li>
            <li><strong>Cover:</strong> works as extra armor</li>
            <li><strong>Crit Threshold:</strong> if final damage ≥ Crit Threshold, roll D66 on the critical injury table</li>
          </ul>
          <div class="highlight red">
            <strong>Broken by damage:</strong> can't act. Recover 1 Health per Shift alone, or via First Aid (LOG).
          </div>
        </div>
      </div>

      <!-- DISTANZA E ZONE -->
      <div class="card">
        <div class="card-title" data-it>📍 Zone e Distanze</div>
        <div class="card-title" data-en>📍 Zones & Range</div>
        <div data-it>
          <table>
            <thead><tr><th>Distanza</th><th>Descrizione</th><th>Mod.</th></tr></thead>
            <tbody>
              <tr><td><strong>Ingaggiato</strong></td><td>Fianco a fianco</td><td>−3 (armi a distanza)</td></tr>
              <tr><td><strong>Corto</strong></td><td>Stessa zona</td><td>—</td></tr>
              <tr><td><strong>Medio</strong></td><td>Zona adiacente (~25m)</td><td>−1</td></tr>
              <tr><td><strong>Lungo</strong></td><td>~100m (4 zone)</td><td>−2</td></tr>
              <tr><td><strong>Estremo</strong></td><td>~1 km</td><td>−3 o peggio</td></tr>
            </tbody>
          </table>
          <h3>Fuoco automatico</h3>
          <p>Se colpisci, puoi fare subito un secondo attacco (e un terzo se colpisci ancora). Poi ricarichi.</p>
          <h3>Mira</h3>
          <p>+2 al prossimo tiro se usi l'azione intera per mirare. Perdi il bonus se vieni colpito.</p>
        </div>
        <div data-en>
          <table>
            <thead><tr><th>Range</th><th>Description</th><th>Mod.</th></tr></thead>
            <tbody>
              <tr><td><strong>Engaged</strong></td><td>Right next to you</td><td>−3 (ranged)</td></tr>
              <tr><td><strong>Short</strong></td><td>Same zone</td><td>—</td></tr>
              <tr><td><strong>Medium</strong></td><td>Adjacent zone (~25m)</td><td>−1</td></tr>
              <tr><td><strong>Long</strong></td><td>~100m (4 zones)</td><td>−2</td></tr>
              <tr><td><strong>Extreme</strong></td><td>~1 km</td><td>−3 or worse</td></tr>
            </tbody>
          </table>
          <h3>Full Auto</h3>
          <p>If you hit, immediately make a second attack (and the third if that hits too). Then reload.</p>
          <h3>Aim</h3>
          <p>+2 to the next shot if you spend the entire action aiming. Lost if you take damage.</p>
        </div>
      </div>

      <!-- CONDIZIONI -->
      <div class="card orange">
        <div class="card-title" data-it>😵 Condizioni (−2 dadi)</div>
        <div class="card-title" data-en>😵 Conditions (−2 dice)</div>
        <div class="grid grid-3" style="gap:0.5rem;margin-top:0.5rem">
          <div style="text-align:center">
            <div class="badge">STR</div>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-it>Esausto</p>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-en>Exhausted</p>
          </div>
          <div style="text-align:center">
            <div class="badge">AGI</div>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-it>Stordito</p>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-en>Dazed</p>
          </div>
          <div style="text-align:center">
            <div class="badge">LOG</div>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-it>Confuso</p>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-en>Confused</p>
          </div>
          <div style="text-align:center">
            <div class="badge">PER</div>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-it>Distratto</p>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-en>Distracted</p>
          </div>
          <div style="text-align:center">
            <div class="badge">INS</div>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-it>Scosso</p>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-en>Shaken</p>
          </div>
          <div style="text-align:center">
            <div class="badge">EMP</div>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-it>Avvilito</p>
            <p style="font-size:0.8rem;margin-top:0.3rem" data-en>Disheartened</p>
          </div>
        </div>
        <div class="highlight" style="margin-top:1rem;border-color:var(--orange)">
          <span data-it>Recupero: riposa 1 Turno per guarire 1 condizione. Se hai già tutti e 6, prendi 2 danni invece di una condizione.</span>
          <span data-en>Recovery: rest 1 Shift to heal 1 condition. If you already have all 6, take 2 damage instead.</span>
        </div>
      </div>

      <!-- CONFLITTO SOCIALE -->
      <div class="card teal">
        <div class="card-title" data-it>🗣 Conflitto Sociale</div>
        <div class="card-title" data-en>🗣 Social Conflict</div>
        <div data-it>
          <p>Usa <strong>EMP</strong> per convincere, ingannare o intimidire. Tiro contrapposto vs EMP del bersaglio.</p>
          <h3>Modificatori positivi (+1 ciascuno)</h3>
          <ul>
            <li>La richiesta non costa nulla all'avversario</li>
            <li>L'avversario ha subito danni, disperazione o Blight</li>
            <li>Hai già aiutato l'avversario in passato</li>
            <li>Presenti il caso in modo convincente</li>
          </ul>
          <h3>Modificatori negativi (−1 ciascuno)</h3>
          <ul>
            <li>L'avversario deve rischiare qualcosa per aiutarti</li>
            <li>Sei prigioniero dell'avversario</li>
          </ul>
        </div>
        <div data-en>
          <p>Use <strong>EMP</strong> to convince, deceive or intimidate. Opposed roll vs. target's EMP.</p>
          <h3>Positive modifiers (+1 each)</h3>
          <ul>
            <li>Request costs nothing to your opponent</li>
            <li>Opponent has suffered damage, despair or Blight</li>
            <li>You have helped the opponent before</li>
            <li>You present your case very well</li>
          </ul>
          <h3>Negative modifiers (−1 each)</h3>
          <ul>
            <li>Opponent must take a serious risk to help</li>
            <li>You are held captive by your opponent</li>
          </ul>
        </div>
      </div>

    </div>
  </div>

  <!-- ================================================================ -->
  <!-- TAB: BLIGHT & PERICOLI -->
  <!-- ================================================================ -->
  <div id="tab-pericoli" class="tab-content">

    <div data-it><div class="sec-heading"><span class="icon">☣</span> Blight & Pericoli Ambientali</div></div>
    <div data-en><div class="sec-heading"><span class="icon">☣</span> Blight & Environmental Hazards</div></div>

    <div class="grid grid-2">

      <!-- BLIGHT -->
      <div class="card red">
        <div class="card-title" data-it>☣ Il Blight</div>
        <div class="card-title" data-en>☣ The Blight</div>
        <div data-it>
          <p>Il Blight è una piaga che degrada il <strong>Cuore</strong>. Si accumula esplorando rovine, affrontando creature, o in certe location.</p>
          <h3>Livelli Blight (0-3)</h3>
          <table>
            <thead><tr><th>Livello</th><th>Descrizione</th></tr></thead>
            <tbody>
              <tr><td>0</td><td>Zona sicura — nessun Blight</td></tr>
              <tr><td>1</td><td>Tracce di Blight — esposizione minore</td></tr>
              <tr><td>2</td><td>Blight moderato — pericoloso</td></tr>
              <tr><td>3</td><td>Blight core — zona letale</td></tr>
            </tbody>
          </table>
          <h3>Protezione</h3>
          <p>Le tute protettive forniscono un <strong>Blight Protection</strong> (Dadi Gear): ogni 6 riduce il Blight subito di 1.</p>
          <div class="highlight red">
            <strong>Blight Core:</strong> impossibile recuperare Salute, Speranza o Cuore. +1 Blight per Tratto.
          </div>
        </div>
        <div data-en>
          <p>Blight is a plague that degrades <strong>Heart</strong>. Accumulated in ruins, from creatures, or specific locations.</p>
          <h3>Blight Levels (0–3)</h3>
          <table>
            <thead><tr><th>Level</th><th>Description</th></tr></thead>
            <tbody>
              <tr><td>0</td><td>Safe zone — no Blight</td></tr>
              <tr><td>1</td><td>Traces of Blight — minor exposure</td></tr>
              <tr><td>2</td><td>Moderate Blight — dangerous</td></tr>
              <tr><td>3</td><td>Blight core — lethal zone</td></tr>
            </tbody>
          </table>
          <h3>Protection</h3>
          <p>Protective suits provide <strong>Blight Protection</strong> (Gear Dice): each 6 reduces Blight suffered by 1.</p>
          <div class="highlight red">
            <strong>Blight Core:</strong> can't recover Health, Hope or Heart. +1 Blight per Stretch.
          </div>
        </div>
      </div>

      <!-- MANIFESTAZIONI BLIGHT -->
      <div class="card red">
        <div class="card-title" data-it>🧬 Manifestazioni del Blight (D66)</div>
        <div class="card-title" data-en>🧬 Blight Manifestations (D66)</div>
        <div data-it>
          <p>Quando il Cuore arriva a 0, tira D66:</p>
          <table>
            <thead><tr><th>D66</th><th>Manifestazione</th><th>Effetto</th></tr></thead>
            <tbody>
              <tr><td>11–16</td><td>Brividi</td><td>Esausto (1 Turno)</td></tr>
              <tr><td>21</td><td>Occhi Indaco</td><td>Vede al buio, Distratto alla luce (Permanente)</td></tr>
              <tr><td>22</td><td>Pelle Grigia</td><td>Avvilito, AR 1 temporaneo</td></tr>
              <tr><td>23–25</td><td>Vesciche</td><td>1 danno per livello Blight zona</td></tr>
              <tr><td>26</td><td>Tosse di Polvere</td><td>Contagioso, 1 danno/livello Blight</td></tr>
              <tr><td>31–33</td><td>Sensazioni Fantasma</td><td>Distratto e Stordito</td></tr>
              <tr><td>34–36</td><td>Eco</td><td>Distratto (tiro INS ogni Turno)</td></tr>
              <tr><td>41–43</td><td>Alito Nebuloso</td><td>Nessun agguato possibile, +2 PER nemici</td></tr>
              <tr><td>44–45</td><td>Dissonanza Temporale</td><td>Agisci per ultimo in iniziativa</td></tr>
              <tr><td>46</td><td>Ornitofobia</td><td>Terrore dell Volatile, 1 disperazione per Turno vicino a esso</td></tr>
              <tr><td>51–52</td><td>Bioluminescenza</td><td>Non puoi nasconderti nel buio</td></tr>
              <tr><td>53–54</td><td>Creepers</td><td>−2 Salute e −2 Speranza</td></tr>
            </tbody>
          </table>
        </div>
        <div data-en>
          <p>When Heart reaches 0, roll D66:</p>
          <table>
            <thead><tr><th>D66</th><th>Manifestation</th><th>Effect</th></tr></thead>
            <tbody>
              <tr><td>11–16</td><td>Shivers</td><td>Exhausted (1 Shift)</td></tr>
              <tr><td>21</td><td>Indigo Eyes</td><td>See in dark, Distracted in light (Permanent)</td></tr>
              <tr><td>22</td><td>Ashen Skin</td><td>Disheartened, AR 1 temporarily</td></tr>
              <tr><td>23–25</td><td>Blisters</td><td>1 damage per Blight Level in area</td></tr>
              <tr><td>26</td><td>Dust Cough</td><td>Contagious, 1 damage/Blight Level</td></tr>
              <tr><td>31–33</td><td>Phantom Sensations</td><td>Distracted and Dazed</td></tr>
              <tr><td>34–36</td><td>Echoes</td><td>Distracted (INS roll each Shift)</td></tr>
              <tr><td>41–43</td><td>Nebulous Breath</td><td>Can't ambush enemies +2 PER to find you</td></tr>
              <tr><td>44–45</td><td>Temporal Dissonance</td><td>Act last in initiative</td></tr>
              <tr><td>46</td><td>Ornitophobia</td><td>Fear of Bird, 1 despair per Shift near it</td></tr>
              <tr><td>51–52</td><td>Glow</td><td>Can't hide in darkness</td></tr>
              <tr><td>53–54</td><td>Creepers</td><td>−2 Health and −2 Hope</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- PERICOLI AMBIENTALI -->
      <div class="card orange">
        <div class="card-title" data-it>🔥 Pericoli Ambientali</div>
        <div class="card-title" data-en>🔥 Environmental Hazards</div>
        <div data-it>
          <h3>Fuoco</h3>
          <ul>
            <li>Tira dadi in base all'Intensità (3-9)</li>
            <li>Ogni 6 = 1 danno. Se prendi danno, <em>ti incendi</em></li>
            <li>Bruciando: attacco automatico ogni round, Intensità +1</li>
            <li>Spegnere: tiro AGI (azione). +2 con coperta</li>
          </ul>
          <h3>Esplosioni</h3>
          <table>
            <thead><tr><th>Potenza</th><th>Danno base</th></tr></thead>
            <tbody>
              <tr><td>12 dadi</td><td>4</td></tr>
              <tr><td>9 dadi</td><td>3</td></tr>
              <tr><td>6 dadi</td><td>2</td></tr>
              <tr><td>3 dadi</td><td>1</td></tr>
            </tbody>
          </table>
          <h3>Cadute</h3>
          <p>Danno = altezza (m) ÷ 2 (arrotonda per difetto). Tiro AGI riduce il danno di 1 per 6.</p>
          <h3>Buio totale</h3>
          <ul>
            <li>Correre: tiro AGI o 1 danno</li>
            <li>Attacchi Ingaggiati: −2; a Corto: prima tiro PER</li>
            <li>Medio+ impossibile</li>
          </ul>
        </div>
        <div data-en>
          <h3>Fire</h3>
          <ul>
            <li>Roll dice based on Intensity (3–9)</li>
            <li>Each 6 = 1 damage. If you take damage, you <em>catch fire</em></li>
            <li>While burning: automatic attack each round, Intensity +1</li>
            <li>Extinguish: AGI roll (action). +2 with blanket</li>
          </ul>
          <h3>Explosions</h3>
          <table>
            <thead><tr><th>Blast Power</th><th>Base Damage</th></tr></thead>
            <tbody>
              <tr><td>12 dice</td><td>4</td></tr>
              <tr><td>9 dice</td><td>3</td></tr>
              <tr><td>6 dice</td><td>2</td></tr>
              <tr><td>3 dice</td><td>1</td></tr>
            </tbody>
          </table>
          <h3>Falling</h3>
          <p>Damage = height (m) ÷ 2 (round down). AGI roll reduces damage by 1 per 6.</p>
          <h3>Total Darkness</h3>
          <ul>
            <li>Running: AGI roll or 1 damage</li>
            <li>Engaged attacks: −2; Short: need PER roll first</li>
            <li>Medium+ impossible</li>
          </ul>
        </div>
      </div>

      <!-- MORTE -->
      <div class="card red">
        <div class="card-title" data-it>💀 Morte & Ferite Critiche</div>
        <div class="card-title" data-en>💀 Death & Critical Injuries</div>
        <div data-it>
          <p>Tira D66 quando infliggi danno ≥ Crit Threshold.</p>
          <div class="highlight red">
            <strong>Ferite letali:</strong> devi effettuare un <em>Tiro della Morte</em> (STR) dopo il tempo limite. Se fallisci, muori. Puoi ritirare ogni volta che scade il tempo.
          </div>
          <h3>Stabilizzare</h3>
          <p>Primo Soccorso con LOG estende il tempo limite di 1 categoria. Il successo ferma il countdown.</p>
          <h3>Istantaneamente letali (D66)</h3>
          <p>63 Sventrato · 64 Cranio fracassato · 65 Testa trafitta · 66 Cuore trafitto</p>
          <h3>Recupero condizioni</h3>
          <p>1 condizione rimossa ogni 1 Turno di riposo.</p>
        </div>
        <div data-en>
          <p>Roll D66 when you inflict damage ≥ Crit Threshold.</p>
          <div class="highlight red">
            <strong>Lethal injuries:</strong> you must make a <em>Death Save</em> (STR) after the time limit. Fail = you die. Re-roll each time the limit expires.
          </div>
          <h3>Stabilizing</h3>
          <p>First Aid with LOG extends the time limit by 1 category. Success stops the countdown.</p>
          <h3>Instant kills (D66)</h3>
          <p>63 Disemboweled · 64 Crushed skull · 65 Pierced head · 66 Impaled heart</p>
          <h3>Condition recovery</h3>
          <p>Remove 1 condition per 1 Shift of rest.</p>
        </div>
      </div>

    </div>
  </div>


  <!-- ================================================================ -->
  <!-- TAB: PERSONAGGIO -->
  <!-- ================================================================ -->
  <div id="tab-personaggio" class="tab-content">

    <div data-it><div class="sec-heading"><span class="icon">👤</span> Creazione Personaggio & Ruoli</div></div>
    <div data-en><div class="sec-heading"><span class="icon">👤</span> Character Creation & Roles</div></div>

    <div class="grid grid-2">

      <!-- RUOLI -->
      <div class="card">
        <div class="card-title" data-it>🎭 Ruoli dell'Esploratore</div>
        <div class="card-title" data-en>🎭 Explorer Roles</div>
        <div class="grid grid-2" style="gap:0.8rem;margin-top:0.5rem">

          <div class="role-card">
            <div class="role-name"><span class="role-icon">⛏</span> Delver</div>
            <p style="font-size:0.82rem" data-it>Esperto di rovine, archeologia e ambienti ostili. Il cuore dell'esplorazione.</p>
            <p style="font-size:0.82rem" data-en>Expert in ruins, archaeology and hostile environments. The heart of exploration.</p>
          </div>

          <div class="role-card">
            <div class="role-name"><span class="role-icon">🔭</span> Scout</div>
            <p style="font-size:0.82rem" data-it>Ricognitore, raider. Veloce, furtivo, specializzato nell'avanzata.</p>
            <p style="font-size:0.82rem" data-en>Pathfinder, raider. Fast, stealthy, specialized in scouting ahead.</p>
          </div>

          <div class="role-card">
            <div class="role-name"><span class="role-icon">🔧</span> Burrower</div>
            <p style="font-size:0.82rem" data-it>Tecnico, ingegnere. Sa aprire varchi, riparare, sfruttare l'ambiente.</p>
            <p style="font-size:0.82rem" data-en>Technician, engineer. Opens passages, repairs gear, exploits the environment.</p>
          </div>

          <div class="role-card">
            <div class="role-name"><span class="role-icon">🛡</span> Guard</div>
            <p style="font-size:0.82rem" data-it>Combattente, protettore del gruppo. Primo a entrare in azione in combattimento.</p>
            <p style="font-size:0.82rem" data-en>Fighter, group protector. First into action in combat.</p>
          </div>

        </div>
      </div>

      <!-- STRUTTURA PERSONAGGIO -->
      <div class="card teal">
        <div class="card-title" data-it>📋 Componenti del Personaggio</div>
        <div class="card-title" data-en>📋 Character Components</div>
        <div data-it>
          <ul>
            <li><strong>6 Attributi</strong> (scala 2-6)</li>
            <li><strong>Salute</strong> = STR + AGI</li>
            <li><strong>Speranza</strong> = LOG + EMP</li>
            <li><strong>Cuore</strong> = INS + PER</li>
            <li><strong>Talenti</strong> — abilità speciali con livelli da +1 a +3</li>
            <li><strong>Quirk</strong> — tratto peculiare del personaggio (influenza l'XP)</li>
            <li><strong>Cimelio</strong> — oggetto minuscolo, 1×/sessione forzare un tiro come con 1 Speranza</li>
            <li><strong>Equipaggiamento</strong> — armi, armatura, inventario</li>
            <li><strong>Il Volatile</strong> — creatura aliena tutelare della crew (Salute + Livello Energia)</li>
          </ul>
        </div>
        <div data-en>
          <ul>
            <li><strong>6 Attributes</strong> (scale 2-6)</li>
            <li><strong>Health</strong> = STR + AGI</li>
            <li><strong>Hope</strong> = LOG + EMP</li>
            <li><strong>Heart</strong> = INS + PER</li>
            <li><strong>Talents</strong> — special skills at levels +1 to +3</li>
            <li><strong>Quirk</strong> — character personality trait (influences XP)</li>
            <li><strong>Keepsake</strong> — tiny item, 1×/session push a roll as if spending 1 Hope</li>
            <li><strong>Equipment</strong> — weapons, armor, inventory</li>
            <li><strong>The Bird</strong> — alien guardian creature (Health + Energy Level)</li>
          </ul>
        </div>
      </div>

      <!-- TALENTI -->
      <div class="card">
        <div class="card-title" data-it>⭐ Talenti</div>
        <div class="card-title" data-en>⭐ Talents</div>
        <div data-it>
          <p>I talenti aggiungono <strong>Dadi Base</strong> ai tiri (+1 / +2 / +3 a seconda del livello).</p>
          <div class="highlight">
            <strong>Esempio:</strong> il talento <em>Ruin Delver</em> può usarsi con AGI (navigare fisicamente le rovine) oppure con LOG (capirne la struttura). Il GM e il giocatore decidono quale attributo usare.
          </div>
          <h3>Come usare i talenti</h3>
          <ul>
            <li>Un talento può combinato con diversi attributi</li>
            <li>GM e giocatore concordano quale attributo è più appropriato</li>
            <li>Senza talento: tiri solo l'attributo + eventuale gear bonus</li>
          </ul>
          <h3>Talenti tipici dal Quickstart</h3>
          <table>
            <thead><tr><th>Talento</th><th>Bonus</th><th>Note</th></tr></thead>
            <tbody>
              <tr><td>Ruin Delver</td><td>+1</td><td>Esplorazione rovine</td></tr>
              <tr><td>Sharpshooter</td><td>+1</td><td>Fucile / carabina</td></tr>
              <tr><td>Blade Fighter</td><td>+1</td><td>Armi bianche</td></tr>
              <tr><td>Acrobat</td><td>+1</td><td>Salti, scalate, corsa</td></tr>
              <tr><td>Charmer</td><td>+2</td><td>EMP per piacere a qualcuno</td></tr>
              <tr><td>Malicious</td><td>—</td><td>Infligge disperazione in conflitti sociali</td></tr>
            </tbody>
          </table>
        </div>
        <div data-en>
          <p>Talents add <strong>Base Dice</strong> to rolls (+1 / +2 / +3 by level).</p>
          <div class="highlight">
            <strong>Example:</strong> the <em>Ruin Delver</em> talent can be used with AGI (physically navigating ruins) or LOG (understanding the structure). GM and player decide the attribute.
          </div>
          <h3>How to use talents</h3>
          <ul>
            <li>A talent can be paired with different attributes</li>
            <li>GM and player agree on the most appropriate attribute</li>
            <li>Without talent: roll-only attribute + any gear bonus</li>
          </ul>
          <h3>Typical talents from Quickstart</h3>
          <table>
            <thead><tr><th>Talent</th><th>Bonus</th><th>Note</th></tr></thead>
            <tbody>
              <tr><td>Ruin Delver</td><td>+1</td><td>Ruin exploration</td></tr>
              <tr><td>Sharpshooter</td><td>+1</td><td>Rifle / carbine</td></tr>
              <tr><td>Blade Fighter</td><td>+1</td><td>Bladed weapons</td></tr>
              <tr><td>Acrobat</td><td>+1</td><td>Jumps, climbs, running</td></tr>
              <tr><td>Charmer</td><td>+2</td><td>EMP to make someone like you</td></tr>
              <tr><td>Malicious</td><td>—</td><td>Inflict despair in social conflicts</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- EQUIPAGGIAMENTO -->
      <div class="card orange">
        <div class="card-title" data-it>🎒 Equipaggiamento & Ingombro</div>
        <div class="card-title" data-en>🎒 Equipment & Encumbrance</div>
        <div data-it>
          <div class="formula"><span>Capacità massima</span> = STR + 4 oggetti</div>
          <table>
            <thead><tr><th>Tipo</th><th>Slot</th></tr></thead>
            <tbody>
              <tr><td>Normale</td><td>1 riga</td></tr>
              <tr><td>Pesante (Heavy)</td><td>2 righe</td></tr>
              <tr><td>Leggero (Light)</td><td>½ riga (2 per riga)</td></tr>
              <tr><td>Minuscolo (Tiny)</td><td>0 (sezione dedicata)</td></tr>
              <tr><td>Rifornimenti (Supply)</td><td>4 punti = 1 riga</td></tr>
            </tbody>
          </table>
          <h3>Armi a portata di mano</h3>
          <p>Fino a 3 armi — non contano per l'ingombro. Già estratte e pronte all'uso.</p>
          <h3>Armatura</h3>
          <p>Non conta per l'ingombro. Registrata in sezione apposita.</p>
          <div class="highlight" style="margin-top:0.8rem">
            <strong>Sovraccarico:</strong> tiro STR per muoversi ogni round. Trasportare un'altra persona = sovraccarico automatico.
          </div>
        </div>
        <div data-en>
          <div class="formula"><span>Max capacity</span> = STR + 4 items</div>
          <table>
            <thead><tr><th>Type</th><th>Slots</th></tr></thead>
            <tbody>
              <tr><td>Normal</td><td>1 row</td></tr>
              <tr><td>Heavy</td><td>2 rows</td></tr>
              <tr><td>Light</td><td>½ row (2 per row)</td></tr>
              <tr><td>Tiny</td><td>0 (own section)</td></tr>
              <tr><td>Supply</td><td>4 points = 1 row</td></tr>
            </tbody>
          </table>
          <h3>Weapons at hand</h3>
          <p>Up to 3 weapons — don't count towards encumbrance. Ready to draw.</p>
          <h3>Armor</h3>
          <p>Doesn't count towards encumbrance. Recorded in its own section.</p>
          <div class="highlight" style="margin-top:0.8rem">
            <strong>Over-encumbered:</strong> STR roll to move each round. Carrying another person = automatic encumbrance.
          </div>
        </div>
      </div>

    </div>
  </div>


  <!-- ================================================================ -->
  <!-- TAB: PROFESSIONI -->
  <!-- ================================================================ -->
  <div id="tab-professioni" class="tab-content">

    <div data-it><div class="sec-heading"><span class="icon">🧑</span> Le 8 Professioni</div></div>
    <div data-en><div class="sec-heading"><span class="icon">🧑</span> The 8 Professions</div></div>

    <div data-it><p style="margin-bottom:1.5rem;font-size:0.88rem">La professione definisce il tuo passato, i talenti chiave e l'equipaggiamento iniziale. Ogni professione ha 6 specializzazioni con un <strong>Talento Gratuito</strong> ciascuna.</p></div>
    <div data-en><p style="margin-bottom:1.5rem;font-size:0.88rem">Your profession defines your background, key talents, and starting gear. Each profession has 6 specialties, each granting a <strong>Free Talent</strong>.</p></div>

    <div class="grid grid-2">

      <!-- ARTIST -->
      <div class="card teal">
        <div class="card-title">🎨 Artist</div>
        <div class="stat-row">
          <div class="stat-chip" data-it>Attr. chiave<span>EMP</span></div>
          <div class="stat-chip" data-en>Key Attr.<span>EMP</span></div>
          <div class="stat-chip" data-it>Talenti<span>Acrobat, Charmer, Cultural Savant, Renowned</span></div>
          <div class="stat-chip" data-en>Talents<span>Acrobat, Charmer, Cultural Savant, Renowned</span></div>
        </div>
        <div data-it>
          <p style="font-size:0.82rem;margin-bottom:0.6rem">Artista di Ship City — pittore, poeta, musicista, attore, editore o artigiano meccanico. Vive di arte e bellezza in un mondo grigio.</p>
          <table><thead><tr><th>D6</th><th>Specializzazione</th><th>Talento Gratuito</th></tr></thead>
          <tbody>
            <tr><td>1</td><td>Hull Painter</td><td>Zero-G Training</td></tr>
            <tr><td>2</td><td>Staircase Poet</td><td>Charmer</td></tr>
            <tr><td>3</td><td>Maidy Row Balladeer</td><td>Musician</td></tr>
            <tr><td>4</td><td>Alley Theater Actor</td><td>Disguise</td></tr>
            <tr><td>5</td><td>Occasional Publisher</td><td>Librarian</td></tr>
            <tr><td>6</td><td>Machine Artisan</td><td>Jury-Rig</td></tr>
          </tbody></table>
        </div>
        <div data-en>
          <p style="font-size:0.82rem;margin-bottom:0.6rem">Ship City artist — painter, poet, musician, actor, publisher or mechanical artisan. Lives on art and beauty in a gray world.</p>
          <table><thead><tr><th>D6</th><th>Specialty</th><th>Free Talent</th></tr></thead>
          <tbody>
            <tr><td>1</td><td>Hull Painter</td><td>Zero-G Training</td></tr>
            <tr><td>2</td><td>Staircase Poet</td><td>Charmer</td></tr>
            <tr><td>3</td><td>Maidy Row Balladeer</td><td>Musician</td></tr>
            <tr><td>4</td><td>Alley Theater Actor</td><td>Disguise</td></tr>
            <tr><td>5</td><td>Occasional Publisher</td><td>Librarian</td></tr>
            <tr><td>6</td><td>Machine Artisan</td><td>Jury-Rig</td></tr>
          </tbody></table>
        </div>
      </div>

      <!-- ENFORCER -->
      <div class="card red">
        <div class="card-title">⚔ Enforcer</div>
        <div class="stat-row">
          <div class="stat-chip" data-it>Attr. chiave<span>AGI</span></div>
          <div class="stat-chip" data-en>Key Attr.<span>AGI</span></div>
          <div class="stat-chip" data-it>Talenti<span>Weapon talents, Commander, Evasive, Medic</span></div>
          <div class="stat-chip" data-en>Talents<span>Weapon talents, Commander, Evasive, Medic</span></div>
        </div>
        <div data-it>
          <p style="font-size:0.82rem;margin-bottom:0.6rem">Soldato, guardia, investigatore o cacciatore di taglie. Esperto di combattimento e strumenti di distruzione.</p>
          <table><thead><tr><th>D6</th><th>Specializzazione</th><th>Talento Gratuito</th></tr></thead>
          <tbody>
            <tr><td>1</td><td>Zapti Constable</td><td>Interrogator</td></tr>
            <tr><td>2</td><td>Guild Militia</td><td>Lookout</td></tr>
            <tr><td>3</td><td>Fusillard Protector</td><td>Bodyguard</td></tr>
            <tr><td>4</td><td>Guild Investigator</td><td>Investigator</td></tr>
            <tr><td>5</td><td>Coriolite Guard</td><td>Polearms</td></tr>
            <tr><td>6</td><td>Bounty Hunter</td><td>Streetwise</td></tr>
          </tbody></table>
        </div>
        <div data-en>
          <p style="font-size:0.82rem;margin-bottom:0.6rem">Soldier, guard, investigator or bounty hunter. Expert in combat and all tools of destruction.</p>
          <table><thead><tr><th>D6</th><th>Specialty</th><th>Free Talent</th></tr></thead>
          <tbody>
            <tr><td>1</td><td>Zapti Constable</td><td>Interrogator</td></tr>
            <tr><td>2</td><td>Guild Militia</td><td>Lookout</td></tr>
            <tr><td>3</td><td>Fusillard Protector</td><td>Bodyguard</td></tr>
            <tr><td>4</td><td>Guild Investigator</td><td>Investigator</td></tr>
            <tr><td>5</td><td>Coriolite Guard</td><td>Polearms</td></tr>
            <tr><td>6</td><td>Bounty Hunter</td><td>Streetwise</td></tr>
          </tbody></table>
        </div>
      </div>

      <!-- ESOTERIC -->
      <div class="card">
        <div class="card-title">🔮 Esoteric</div>
        <div class="stat-row">
          <div class="stat-chip" data-it>Attr. chiave<span>INS</span></div>
          <div class="stat-chip" data-en>Key Attr.<span>INS</span></div>
          <div class="stat-chip" data-it>Talenti<span>Actor, Botanist, Cultural Savant, Librarian</span></div>
          <div class="stat-chip" data-en>Talents<span>Actor, Botanist, Cultural Savant, Librarian</span></div>
        </div>
        <div data-it>
          <p style="font-size:0.82rem;margin-bottom:0.6rem">Mistico, profeta, ideologo o reazionario. Ai margini della società, con visioni che gli altri non sanno vedere.</p>
          <div class="highlight" style="font-size:0.8rem">Equipaggiamento iniziale: polvere d'orchidea, carte stellari, pamphlet rivoluzionari o candele di smelling spice.</div>
        </div>
        <div data-en>
          <p style="font-size:0.82rem;margin-bottom:0.6rem">Mystic, prophet, ideologist or reactionary. On the fringe of society, with visions others cannot see.</p>
          <div class="highlight" style="font-size:0.8rem">Starting gear: orchid dust, star charts, revolutionary pamphlets, or smelling spice candles.</div>
        </div>
      </div>

      <!-- ODD JOBBER -->
      <div class="card orange">
        <div class="card-title">🔧 Odd Jobber</div>
        <div class="stat-row">
          <div class="stat-chip" data-it>Attr. chiave<span>STR</span></div>
          <div class="stat-chip" data-en>Key Attr.<span>STR</span></div>
        </div>
        <div data-it><p style="font-size:0.82rem">Factotum, lavoratore generico di Ship City. Sa fare un po' di tutto — dalla manutenzione al contrabbando.</p></div>
        <div data-en><p style="font-size:0.82rem">Jack-of-all-trades worker of Ship City. Can do a bit of everything — from maintenance to smuggling.</p></div>
      </div>

      <!-- ROUGHNECK -->
      <div class="card">
        <div class="card-title">⛏ Roughneck</div>
        <div class="stat-row">
          <div class="stat-chip" data-it>Attr. chiave<span>STR</span></div>
          <div class="stat-chip" data-en>Key Attr.<span>STR</span></div>
        </div>
        <div data-it><p style="font-size:0.82rem">Minatore, operaio pesante, lavoratore duro dei campi esterni. Conosce il terreno e la fatica meglio di chiunque altro.</p></div>
        <div data-en><p style="font-size:0.82rem">Miner, heavy laborer, hard worker of the outer fields. Knows hard terrain and exhaustion better than anyone.</p></div>
      </div>

      <!-- SCHOLAR -->
      <div class="card teal">
        <div class="card-title">📚 Scholar</div>
        <div class="stat-row">
          <div class="stat-chip" data-it>Attr. chiave<span>LOG</span></div>
          <div class="stat-chip" data-en>Key Attr.<span>LOG</span></div>
        </div>
        <div data-it><p style="font-size:0.82rem">Studioso, ricercatore, specialista delle rovine o dei Costruttori. Comprende glifi, artefatti e fenomeni spaziali.</p></div>
        <div data-en><p style="font-size:0.82rem">Scholar, researcher, ruin or Builder specialist. Understands glyphs, artifacts and space phenomena.</p></div>
      </div>

      <!-- SCOUNDREL -->
      <div class="card red">
        <div class="card-title">🗡 Scoundrel</div>
        <div class="stat-row">
          <div class="stat-chip" data-it>Attr. chiave<span>AGI</span></div>
          <div class="stat-chip" data-en>Key Attr.<span>AGI</span></div>
        </div>
        <div data-it><p style="font-size:0.82rem">Ladro, contrabbandiere, truffatore. Conosce i bassifondi di Ship City come le sue tasche.</p></div>
        <div data-en><p style="font-size:0.82rem">Thief, smuggler, con artist. Knows the underbelly of Ship City like the back of their hand.</p></div>
      </div>

      <!-- TRAVELER -->
      <div class="card orange">
        <div class="card-title">🚀 Traveler</div>
        <div class="stat-row">
          <div class="stat-chip" data-it>Attr. chiave<span>PER</span></div>
          <div class="stat-chip" data-en>Key Attr.<span>PER</span></div>
        </div>
        <div data-it><p style="font-size:0.82rem">Pilota, navigatore o esploratore spaziale. Ha visto più sistemi stellari di chiunque altro nella crew.</p></div>
        <div data-en><p style="font-size:0.82rem">Pilot, navigator or space explorer. Has seen more star systems than anyone else in the crew.</p></div>
      </div>

    </div>

    <!-- XP e CP -->
    <div class="grid grid-2" style="margin-top:1.5rem">
      <div class="card teal">
        <div class="card-title" data-it>📈 Punti Esperienza (XP)</div>
        <div class="card-title" data-en>📈 Experience Points (XP)</div>
        <div data-it>
          <p style="font-size:0.82rem;margin-bottom:0.6rem">Dopo ogni sessione, rispondi "sì" alle domande per guadagnare 1 XP ciascuna:</p>
          <ul style="font-size:0.82rem">
            <li>Hai partecipato alla sessione?</li>
            <li>Hai interpretato il tuo Quirk?</li>
            <li>Hai esplorato una location sconosciuta?</li>
            <li>Hai indagato un mistero?</li>
            <li>Hai istigato o partecipato a intrighi?</li>
            <li>Hai aiutato un altro Esploratore?</li>
            <li>Hai superato una sfida difficile?</li>
            <li>Hai interagito con la tua fazione tramite contatti?</li>
          </ul>
          <div class="highlight teal" style="margin-top:0.8rem">
            <strong>Costi:</strong> Nuovo talento (lv.1) = 5 XP · lv.2 = 10 XP · lv.3 = 15 XP
          </div>
        </div>
        <div data-en>
          <p style="font-size:0.82rem;margin-bottom:0.6rem">After each session, answer "yes" to each question for 1 XP:</p>
          <ul style="font-size:0.82rem">
            <li>Did you participate in the session?</li>
            <li>Did you roleplay your quirk?</li>
            <li>Did you explore an unknown location?</li>
            <li>Did you investigate a mystery?</li>
            <li>Did you instigate or partake in intrigue?</li>
            <li>Did you help another Explorer?</li>
            <li>Did you overcome a difficult challenge?</li>
            <li>Did you interact with your affiliated faction?</li>
          </ul>
          <div class="highlight teal" style="margin-top:0.8rem">
            <strong>Costs:</strong> New talent (lv.1) = 5 XP · lv.2 = 10 XP · lv.3 = 15 XP
          </div>
        </div>
      </div>

      <div class="card orange">
        <div class="card-title" data-it>🏅 Punti Crew (CP)</div>
        <div class="card-title" data-en>🏅 Crew Points (CP)</div>
        <div data-it>
          <p style="font-size:0.82rem;margin-bottom:0.6rem">1 CP per ogni "sì" dopo la sessione:</p>
          <ul style="font-size:0.82rem">
            <li>La crew ha affrontato una sfida insieme?</li>
            <li>Ha fatto un delve, un trek o un viaggio su Greatship?</li>
            <li>Ha trovato un nuovo Glifo o artefatto dei Costruttori?</li>
            <li>Ha ottenuto o promesso un favore a una fazione?</li>
            <li>Ha consegnato un artefatto a una fazione?</li>
            <li>Ha ricevuto aiuto dal Volatile in un momento disperato?</li>
          </ul>
          <div class="highlight" style="border-color:var(--orange);background:rgba(230,126,34,0.07);margin-top:0.8rem">
            <strong>Costi CP:</strong> Nuova manovra crew = 5 CP · Nuovo potere Volatile = 5 CP (stesso tipo) / 10 CP (tipo diverso) · +1 Salute/Energia Volatile = 5 CP
          </div>
        </div>
        <div data-en>
          <p style="font-size:0.82rem;margin-bottom:0.6rem">1 CP for each "yes" after the session:</p>
          <ul style="font-size:0.82rem">
            <li>Did the crew take on a challenge together?</li>
            <li>Did the crew do a delving, trek or Greatship voyage?</li>
            <li>Did the crew find a new Builder Glyph or artifact?</li>
            <li>Did the crew give or get promised a favor from a faction?</li>
            <li>Did the crew turn in an artifact to a faction?</li>
            <li>Did the crew gain aid from the Bird in desperate circumstances?</li>
          </ul>
          <div class="highlight" style="border-color:var(--orange);background:rgba(230,126,34,0.07);margin-top:0.8rem">
            <strong>CP Costs:</strong> New crew maneuver = 5 CP · New Bird power = 5 CP (same type) / 10 CP (another type) · +1 Bird Health/Energy = 5 CP
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ================================================================ -->
  <!-- TAB: TALENTI COMPLETI -->
  <!-- ================================================================ -->
  <div id="tab-talenti" class="tab-content">

    <div data-it><div class="sec-heading"><span class="icon">⭐</span> Tutti i Talenti & Manovre Crew</div></div>
    <div data-en><div class="sec-heading"><span class="icon">⭐</span> All Talents & Crew Maneuvers</div></div>

    <div class="grid grid-2">

      <div class="card red">
        <div class="card-title" data-it>⚔ Talenti da Combattimento</div>
        <div class="card-title" data-en>⚔ Combat Talents</div>
        <table>
          <thead><tr><th data-it>Talento</th><th data-en>Talent</th><th data-it>Lv.</th><th data-en>Lv.</th><th data-it>Effetto</th><th data-en>Effect</th></tr></thead>
          <tbody>
            <tr><td>Blade Fighter</td><td>1–3</td><td data-it>+1 dado/lv. mischia con lame</td><td data-en>+1 die/lv. close combat blades</td></tr>
            <tr><td>Bodyguard</td><td>1</td><td data-it>Interpose a Short range, tiro AGI</td><td data-en>Interpose at Short range, AGI roll</td></tr>
            <tr><td>Bowman</td><td>1–3</td><td data-it>+1 dado/lv. arco/balestra</td><td data-en>+1 die/lv. bow/crossbow</td></tr>
            <tr><td>Defender</td><td>1–3</td><td data-it>+1 dado/lv. parare attacchi mischia</td><td data-en>+1 die/lv. blocking close combat</td></tr>
            <tr><td>Demolitions Expert</td><td>1–3</td><td data-it>+1 dado/lv. esplosivi</td><td data-en>+1 die/lv. explosives</td></tr>
            <tr><td>Dirty Fighter</td><td>1</td><td data-it>Pugni nudi: danno base 2</td><td data-en>Unarmed: base damage 2</td></tr>
            <tr><td>Evasive</td><td>1–3</td><td data-it>+1 dado/lv. schivare a distanza</td><td data-en>+1 die/lv. dodging ranged</td></tr>
            <tr><td>Executioner</td><td>1</td><td data-it>Tira 2 dadi critico, scegli il risultato</td><td data-en>Roll 2 dice for crit, choose the result</td></tr>
            <tr><td>Fast Reflexes</td><td>1</td><td data-it>Pesca 2 carte iniziativa, scegli</td><td data-en>Draw 2 initiative cards, choose one</td></tr>
            <tr><td>Heavy Weapons</td><td>1–3</td><td data-it>+1 dado/lv. armi pesanti</td><td data-en>+1 die/lv. heavy weapons</td></tr>
            <tr><td>Pistoleer</td><td>1–3</td><td data-it>+1 dado/lv. pistole</td><td data-en>+1 die/lv. pistols</td></tr>
            <tr><td>Polearms</td><td>1–3</td><td data-it>+1 dado/lv. armi contundenti</td><td data-en>+1 die/lv. blunt weapons</td></tr>
            <tr><td>Pugilist</td><td>1–3</td><td data-it>+1 dado/lv. combattimento senz'armi</td><td data-en>+1 die/lv. unarmed combat</td></tr>
            <tr><td>Sharpshooter</td><td>1–3</td><td data-it>+1 dado/lv. fucili e carabine</td><td data-en>+1 die/lv. rifles and carbines</td></tr>
          </tbody>
        </table>
      </div>

      <div class="card teal">
        <div class="card-title" data-it>🗣 Talenti Sociali</div>
        <div class="card-title" data-en>🗣 Social Talents</div>
        <table>
          <thead><tr><th data-it>Talento</th><th data-en>Talent</th><th data-it>Lv.</th><th data-en>Lv.</th><th data-it>Effetto</th><th data-en>Effect</th></tr></thead>
          <tbody>
            <tr><td>Actor</td><td>1–3</td><td data-it>+1 dado/lv. bluffare / mentire</td><td data-en>+1 die/lv. bluffing / lying</td></tr>
            <tr><td>Agitator</td><td>1–3</td><td data-it>+1 dado/lv. EMP per convincere gruppi</td><td data-en>+1 die/lv. EMP to sway groups</td></tr>
            <tr><td>Barter</td><td>1–3</td><td data-it>+1 dado/lv. trattare o comprare</td><td data-en>+1 die/lv. trading or buying</td></tr>
            <tr><td>Charmer</td><td>1–3</td><td data-it>+1 dado/lv. EMP per farsi piacere</td><td data-en>+1 die/lv. EMP to be liked</td></tr>
            <tr><td>Cook</td><td>1–3</td><td data-it>+1 dado/lv. cucinare al campo</td><td data-en>+1 die/lv. cooking in the field</td></tr>
            <tr><td>Interrogator</td><td>1–3</td><td data-it>+1 dado/lv. estrarre informazioni</td><td data-en>+1 die/lv. extracting information</td></tr>
            <tr><td>Malicious</td><td>1</td><td data-it>1 disperazione per ogni 6 nel minacciare</td><td data-en>1 despair per 6 when threatening</td></tr>
            <tr><td>Mentalist</td><td>1–3</td><td data-it>+1 dado/lv. leggere qualcuno / bugie</td><td data-en>+1 die/lv. reading someone / lies</td></tr>
            <tr><td>Musician</td><td>1–3</td><td data-it>+1 dado/lv. EMP con strumenti musicali</td><td data-en>+1 die/lv. EMP with instruments</td></tr>
            <tr><td>Renowned</td><td>1</td><td data-it>Spingi i tiri EMP 2 volte</td><td data-en>Push EMP rolls twice</td></tr>
            <tr><td>Thug</td><td>1–3</td><td data-it>Usa STR invece di EMP per minacciare</td><td data-en>Use STR instead of EMP to threaten</td></tr>
          </tbody>
        </table>
      </div>

      <div class="card">
        <div class="card-title" data-it>📖 Talenti di Conoscenza</div>
        <div class="card-title" data-en>📖 Knowledge Talents</div>
        <table>
          <thead><tr><th data-it>Talento</th><th data-en>Talent</th><th data-it>Lv.</th><th data-en>Lv.</th><th data-it>Effetto</th><th data-en>Effect</th></tr></thead>
          <tbody>
            <tr><td>Archaeology</td><td>1–3</td><td data-it>Comprendere rovine</td><td data-en>Understand ruins</td></tr>
            <tr><td>Artifact Specialist</td><td>1–3</td><td data-it>Comprendere artefatti</td><td data-en>Understand artifacts</td></tr>
            <tr><td>Astrometry</td><td>1–3</td><td data-it>Fenomeni spaziali, orbite</td><td data-en>Space phenomena, orbits</td></tr>
            <tr><td>Botanist</td><td>1–3</td><td data-it>Piante, funghi, flora</td><td data-en>Plants, fungi, flora</td></tr>
            <tr><td>Cartographer</td><td>1–3</td><td data-it>Mappare e navigare</td><td data-en>Mapping and navigating</td></tr>
            <tr><td>Cultural Savant</td><td>1–3</td><td data-it>Costumi e abitudini culturali</td><td data-en>Customs and cultural habits</td></tr>
            <tr><td>Data Djinn</td><td>1–3</td><td data-it>Computer e terminali</td><td data-en>Computers and terminals</td></tr>
            <tr><td>Glyph Scholar</td><td>1–3</td><td data-it>Glifi e testi antichi</td><td data-en>Glyphs and old texts</td></tr>
            <tr><td>Historian</td><td>1–3</td><td data-it>Storia della Diaspora</td><td data-en>History of the Diaspora</td></tr>
            <tr><td>Investigator</td><td>1–3</td><td data-it>Cercare indizi</td><td data-en>Searching for clues</td></tr>
            <tr><td>Librarian</td><td>1–3</td><td data-it>Biblioteche e info-cube</td><td data-en>Libraries and info cubes</td></tr>
            <tr><td>Ruin Delver</td><td>1–3</td><td data-it>Guidare attraverso rovine</td><td data-en>Lead through ruins</td></tr>
            <tr><td>Teratology</td><td>1–3</td><td data-it>Conoscere le creature del Great Dark</td><td data-en>Know creatures of the Great Dark</td></tr>
            <tr><td>Quartermastery</td><td>1–3</td><td data-it>Allestire accampamenti</td><td data-en>Setting up camps</td></tr>
          </tbody>
        </table>
      </div>

      <div class="card orange">
        <div class="card-title" data-it>🏃 Furtività & Mobilità + Equipaggiamento</div>
        <div class="card-title" data-en>🏃 Stealth & Mobility + Equipment</div>
        <table>
          <thead><tr><th data-it>Talento</th><th data-en>Talent</th><th data-it>Lv.</th><th data-en>Lv.</th><th data-it>Effetto</th><th data-en>Effect</th></tr></thead>
          <tbody>
            <tr><td>Acrobat</td><td>1–3</td><td data-it>Salti, scalate, corsa</td><td data-en>Jumps, climbs, running</td></tr>
            <tr><td>Assassin</td><td>1–3</td><td data-it>Attacchi a sorpresa</td><td data-en>Sneak attacks</td></tr>
            <tr><td>Burglar</td><td>1–3</td><td data-it>Scassinare serrature</td><td data-en>Picking / breaking locks</td></tr>
            <tr><td>Disguise</td><td>1–3</td><td data-it>Travestimenti</td><td data-en>Disguises</td></tr>
            <tr><td>Hunter</td><td>1–3</td><td data-it>Cacciare creature</td><td data-en>Hunting creatures</td></tr>
            <tr><td>Lookout</td><td>1–3</td><td data-it>Individuare minacce</td><td data-en>Spotting threats</td></tr>
            <tr><td>Sixth Sense</td><td>1</td><td data-it>Non puoi essere sorpreso</td><td data-en>Cannot be surprised</td></tr>
            <tr><td>Stealthy</td><td>1–3</td><td data-it>Restare nascosti</td><td data-en>Staying hidden</td></tr>
            <tr><td>Streetwise</td><td>1–3</td><td data-it>Contatti e voci in città</td><td data-en>Contacts and rumors in the city</td></tr>
            <tr><td>Tracker</td><td>1–3</td><td data-it>Seguire tracce</td><td data-en>Following tracks</td></tr>
            <tr><td>Zero-G Training</td><td>1</td><td data-it>Nessuna penalità gravità zero</td><td data-en>No zero-g penalties</td></tr>
            <tr><td>Electro-Specialist</td><td>1–3</td><td data-it>Elettronica e computer</td><td data-en>Electronics and computers</td></tr>
            <tr><td>Jury-Rig</td><td>1–3</td><td data-it>Costruire / aggiustare macchinari</td><td data-en>Craft / jury-rig machinery</td></tr>
            <tr><td>Mechanic</td><td>1–3</td><td data-it>Riparare veicoli</td><td data-en>Repairing vehicles</td></tr>
            <tr><td>Scan Operator</td><td>1–3</td><td data-it>Scansionare zone per Blight</td><td data-en>Scan areas for Blight</td></tr>
          </tbody>
        </table>
      </div>

      <div class="card teal">
        <div class="card-title" data-it>❤ Recupero & Resilienza</div>
        <div class="card-title" data-en>❤ Recovery & Resilience</div>
        <table>
          <thead><tr><th data-it>Talento</th><th data-en>Talent</th><th data-it>Lv.</th><th data-en>Lv.</th><th data-it>Effetto</th><th data-en>Effect</th></tr></thead>
          <tbody>
            <tr><td>Blight Resistant</td><td>1–3</td><td data-it>+1 Cuore massimo per lv.</td><td data-en>+1 max Heart per lv.</td></tr>
            <tr><td>Commander</td><td>1–3</td><td data-it>+1 dado/lv. aiutare chi è abbattuto da disperazione</td><td data-en>+1 die/lv. help broken by despair</td></tr>
            <tr><td>Endurance</td><td>1–3</td><td data-it>Resistere vuoto, soffocamento, freddo</td><td data-en>Resist vacuum, suffocation, cold</td></tr>
            <tr><td>Field Surgeon</td><td>1–3</td><td data-it>+1 dado/lv. stabilizzare feriti critici</td><td data-en>+1 die/lv. stabilize critical injuries</td></tr>
            <tr><td>Hopeful</td><td>1–3</td><td data-it>+1 Speranza massima per lv.</td><td data-en>+1 max Hope per lv.</td></tr>
            <tr><td>Lone Wolf</td><td>1</td><td data-it>Puoi aiutare te stesso dalla disperazione (INS)</td><td data-en>Help yourself from despair (INS)</td></tr>
            <tr><td>Medic</td><td>1–3</td><td data-it>+1 dado/lv. curare chi è abbattuto da danno</td><td data-en>+1 die/lv. help broken by damage</td></tr>
            <tr><td>Nine Lives</td><td>1</td><td data-it>Scegli quale dado è decine sul D66 critico</td><td data-en>Choose which die is tens on D66 crit</td></tr>
            <tr><td>Nurse</td><td>1</td><td data-it>I pazienti guariscono 2 danni/turno invece di 1</td><td data-en>Patients heal 2 damage/shift instead of 1</td></tr>
            <tr><td>Reckless</td><td>1</td><td data-it>Spingi tiri AGI 2 volte</td><td data-en>Push AGI rolls twice</td></tr>
            <tr><td>Resilient</td><td>1–3</td><td data-it>Resistere fame, sete, malattie</td><td data-en>Resist hunger, thirst, disease</td></tr>
            <tr><td>Smart</td><td>1</td><td data-it>Spingi tiri LOG 2 volte</td><td data-en>Push LOG rolls twice</td></tr>
            <tr><td>Survivor</td><td>1</td><td data-it>Tiro STR ferita letale: stabilizzato dopo 1 turno</td><td data-en>STR roll on lethal crit: stabilized in 1 shift</td></tr>
            <tr><td>Tough</td><td>1–3</td><td data-it>+1 Salute massima per lv.</td><td data-en>+1 max Health per lv.</td></tr>
          </tbody>
        </table>
      </div>

      <!-- MANOVRE CREW -->
      <div class="card red">
        <div class="card-title" data-it>🎯 Manovre Crew (5 CP ciascuna)</div>
        <div class="card-title" data-en>🎯 Crew Maneuvers (5 CP each)</div>
        <div data-it><p style="font-size:0.8rem;margin-bottom:0.6rem">Ogni ruolo ha le sue manovre. Ognuna è usabile <strong>una sola volta per combattimento</strong>. Non consuma l'azione.</p></div>
        <div data-en><p style="font-size:0.8rem;margin-bottom:0.6rem">Each role has its maneuvers. Each is usable <strong>once per engagement</strong>. Does not use your action.</p></div>
        <table>
          <thead><tr>
            <th data-it>Ruolo</th><th data-en>Role</th>
            <th data-it>Manovra</th><th data-en>Maneuver</th>
            <th data-it>Effetto</th><th data-en>Effect</th>
          </tr></thead>
          <tbody>
            <tr><td rowspan="4"><span class="badge">DELVER</span></td>
              <td>Command</td><td data-it>Dà un'azione extra immediata a un altro Esploratore</td><td data-en>Gives another Explorer an extra full action immediately</td></tr>
            <tr><td>Escape Route</td><td data-it>Movimento gratuito di ritirata da un nemico</td><td data-en>Free retreat movement from an Engaged enemy</td></tr>
            <tr><td>Rally</td><td data-it>Tutti entro Medio recuperano 1 Speranza o una condizione</td><td data-en>All in Medium range restore 1 Hope or remove a condition</td></tr>
            <tr><td>Rope Master</td><td data-it>Lega un nemico (grappled, −2 dadi per liberarsi)</td><td data-en>Secures an enemy (grappled, −2 dice to break free)</td></tr>
            <tr><td rowspan="4"><span class="badge teal">SCOUT</span></td>
              <td>Bait & Switch</td><td data-it>Un nemico perde il suo turno questo round</td><td data-en>One enemy loses their turn this round</td></tr>
            <tr><td>Bird Call</td><td data-it>Usa un potere del Volatile senza azione</td><td data-en>Use a Bird power without spending an action</td></tr>
            <tr><td>One Step Ahead</td><td data-it>Scambia iniziativa con un Esploratore già andato</td><td data-en>Swap initiative with an Explorer who already acted</td></tr>
            <tr><td>Situational Awareness</td><td data-it>Schivata gratuita (reazione)</td><td data-en>Free dodge action (reaction)</td></tr>
            <tr><td rowspan="4"><span class="badge" style="border-color:var(--orange);color:var(--orange)">BURROW</span></td>
              <td>Demolition</td><td data-it>Una zona diventa ingombrata (richiede esplosivo)</td><td data-en>One zone becomes cluttered (needs explosive)</td></tr>
            <tr><td>Destabilize</td><td data-it>Distrugge un muro o confine di zona</td><td data-en>Destroys a wall or zone boundary</td></tr>
            <tr><td>Fearless</td><td data-it>Eviti automaticamente disperazione da creature orribili</td><td data-en>Automatically avoid despair from horrifying creatures</td></tr>
            <tr><td>Smoke Screen</td><td data-it>Riempie una zona di fumo (blocca la vista, 3 round)</td><td data-en>Fills a zone with smoke (blocks sight, 3 rounds)</td></tr>
            <tr><td rowspan="4"><span class="badge red">GUARD</span></td>
              <td>Concentrate Fire</td><td data-it>Tutti entro Medio +2 dadi contro un nemico</td><td data-en>All in Medium range +2 dice against one enemy</td></tr>
            <tr><td>Field Recovery</td><td data-it>Tu o un alleato recuperate 3 Salute (richiede MediDose)</td><td data-en>You or an ally recover 3 Health (needs MediDose)</td></tr>
            <tr><td>Flank</td><td data-it>+3 dadi base a un tiro di attacco</td><td data-en>+3 base dice to one attack roll</td></tr>
            <tr><td>Protect</td><td data-it>Intercetti un attacco di mischia destinato ad altri</td><td data-en>Intercept a close combat attack aimed at another</td></tr>
            <tr><td rowspan="4"><span class="badge" style="border-color:var(--teal);color:var(--teal)">ARCHÆO</span></td>
              <td>Analyze</td><td data-it>Tu o un alleato +2 dadi su un attacco specifico</td><td data-en>You or an ally +2 dice for one specific attack</td></tr>
            <tr><td>Feint</td><td data-it>Un alleato schiva gratis senza azione (reazione)</td><td data-en>An ally dodges for free without an action (reaction)</td></tr>
            <tr><td>Find Weak Spot</td><td data-it>Azzera l'armor rating nemico per 1 attacco</td><td data-en>Reduce enemy armor rating to 0 for 1 attack</td></tr>
            <tr><td>See Pattern</td><td data-it>+2 dadi su tutti i tiri contro una creatura questo round</td><td data-en>+2 dice on all rolls against a creature this round</td></tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <!-- ================================================================ -->
  <!-- TAB: IL VOLATILE -->
  <!-- ================================================================ -->
  <div id="tab-volatile" class="tab-content">

    <div data-it><div class="sec-heading"><span class="icon">🐦</span> Il Volatile (Garuda)</div></div>
    <div data-en><div class="sec-heading"><span class="icon">🐦</span> The Bird (Garuda)</div></div>

    <div class="grid grid-2">

      <div class="card teal">
        <div class="card-title" data-it>📋 Tipi di Volatile</div>
        <div class="card-title" data-en>📋 Bird Types</div>
        <table>
          <thead><tr>
            <th data-it>Tipo</th><th data-en>Type</th>
            <th data-it>Salute</th><th data-en>Health</th>
            <th data-it>Energia</th><th data-en>Energy</th>
            <th data-it>Potere Speciale</th><th data-en>Special Power</th>
          </tr></thead>
          <tbody>
            <tr><td><strong>Ward</strong></td><td>5</td><td data-it>2 — Affinità con poteri d'attacco</td><td data-en>2 — Affinity for attack powers</td><td>Raptor's Call</td></tr>
            <tr><td><strong>Guide</strong></td><td>4</td><td data-it>3 — Esplorazione e furtività</td><td data-en>3 — Scouting and stealth</td><td>Farsight</td></tr>
            <tr><td><strong>Specter</strong></td><td>3</td><td data-it>4 — Rapporto con le menti altrui</td><td data-en>4 — Rapport with other minds</td><td>Enshroud</td></tr>
          </tbody>
        </table>
        <div data-it>
          <div class="highlight teal" style="margin-top:0.8rem">
            <strong>Usare un potere:</strong> tiro INS (Bird Handler). Spendi Energia (1+) → i punti Energia spesi = dadi base extra. Il Volatile recupera tutta l'Energia dopo 1 Turno di riposo completo.
          </div>
          <p style="font-size:0.82rem;margin-top:0.6rem">Attacchi contro il Volatile: −2 dadi (bersaglio piccolo). A 0 Salute → abbattuto, nessun potere fino al prossimo turno. Un critico lo uccide (Phoenix Engine può resuscitarlo).</p>
        </div>
        <div data-en>
          <div class="highlight teal" style="margin-top:0.8rem">
            <strong>Using a power:</strong> INS roll (Bird Handler). Spend Energy (1+) → Energy points spent = extra base dice. Bird recovers all Energy after 1 full Shift of rest.
          </div>
          <p style="font-size:0.82rem;margin-top:0.6rem">Attacks vs Bird: −2 dice (small target). At 0 Health → broken, no powers until next shift. A crit kills it (Phoenix Engine can resurrect it).</p>
        </div>
      </div>

      <div class="card">
        <div class="card-title" data-it>⚡ Perdere Controllo (D6 + Energia spesa)</div>
        <div class="card-title" data-en>⚡ Losing Control (D6 + Energy spent)</div>
        <div data-it><p style="font-size:0.81rem;margin-bottom:0.5rem">Se spingi e ottieni un 1 sul Dado Base, oltre a perdere Speranza, tira D6 + Energia:</p></div>
        <div data-en><p style="font-size:0.81rem;margin-bottom:0.5rem">If you push and roll a 1 on a Base Die, besides losing Hope, roll D6 + Energy spent:</p></div>
        <table>
          <thead><tr><th>Risultato</th><th data-it>Conseguenza</th><th data-en>Consequence</th></tr></thead>
          <tbody>
            <tr><td>1–2</td><td data-it>Mind Link Break: Esploratore diventa Scosso</td><td data-en>Mind Link Break: Explorer becomes Shaken</td></tr>
            <tr><td>3–4</td><td data-it>Self-Preservation: Il Volatile si ritira, rifiuta comandi per 1 Tratto</td><td data-en>Self-Preservation: Bird retreats, refuses commands for 1 Stretch</td></tr>
            <tr><td>5–6</td><td data-it>Lightstorm Display: tutti nella zona diventano Distratti</td><td data-en>Lightstorm Display: all in the zone become Distracted</td></tr>
            <tr><td>7</td><td data-it>Temporal Drift: tutti nella zona agiscono per ultimi il prossimo round</td><td data-en>Temporal Drift: all in zone act last next round</td></tr>
            <tr><td>8</td><td data-it>Energy Drain: la crew perde D6 punti Supply</td><td data-en>Energy Drain: crew loses D6 Supply points</td></tr>
            <tr><td>9+</td><td data-it>Energy Surge: attacca tutti nella zona, 8 dadi base, danno 1</td><td data-en>Energy Surge: attacks everyone in zone, 8 base dice, damage 1</td></tr>
          </tbody>
        </table>
      </div>

      <div class="card orange">
        <div class="card-title" data-it>✨ Poteri Base (tutti i Volatili)</div>
        <div class="card-title" data-en>✨ Basic Powers (all Birds)</div>
        <table>
          <thead><tr>
            <th data-it>Potere</th><th data-en>Power</th>
            <th data-it>Effetto</th><th data-en>Effect</th>
          </tr></thead>
          <tbody>
            <tr><td><strong>Attack</strong></td><td data-it>Danno 3, soglia critica 6, gittata Lungo</td><td data-en>Damage 3, crit threshold 6, Long range</td></tr>
            <tr><td><strong>Defend</strong></td><td data-it>Reazione: para o schiva un attacco per un Esploratore</td><td data-en>Reaction: block or dodge an attack for an Explorer</td></tr>
            <tr><td><strong>Clear Blight</strong></td><td data-it>Azzera il Blight in una zona per 1 turno (+1 per 6 extra)</td><td data-en>Clears Blight from one zone for 1 shift (+1 per extra 6)</td></tr>
            <tr><td><strong>Blight Scan</strong></td><td data-it>Vola avanti (4 zone) e scansiona il Blight. <em>Non costa Energia.</em></td><td data-en>Flies ahead (4 zones) and scans Blight. <em>No Energy cost.</em></td></tr>
            <tr><td><strong>Soak Blight</strong></td><td data-it>Reazione: assorbe tutto il Blight di un'ondata prima che colpisca</td><td data-en>Reaction: absorbs all Blight from a surge before it hits</td></tr>
            <tr><td><strong>Glow</strong></td><td data-it>Illumina la zona e le adiacenti per 1 turno</td><td data-en>Illuminates the zone and adjacent ones for 1 shift</td></tr>
          </tbody>
        </table>
      </div>

      <div class="card red">
        <div class="card-title" data-it>🌟 Poteri Avanzati (selezionati)</div>
        <div class="card-title" data-en>🌟 Advanced Powers (selected)</div>
        <table>
          <thead><tr>
            <th data-it>Potere</th><th data-en>Power</th>
            <th data-it>Tipo</th><th data-en>Type</th>
            <th data-it>Effetto</th><th data-en>Effect</th>
          </tr></thead>
          <tbody>
            <tr><td><strong>Fetch</strong></td><td data-it>Tutti</td><td data-en>All</td><td data-it>Recupera un oggetto visibile fino a Estremo</td><td data-en>Fetches a visible object up to Extreme range</td></tr>
            <tr><td><strong>Farsight</strong></td><td data-it>Guide</td><td data-en>Guide</td><td data-it>Il compagno vede ciò che il Volatile vede (zone × 2 dai 6)</td><td data-en>Companion sees what the Bird sees (zones = 6s × 2)</td></tr>
            <tr><td><strong>Dimensional Flitting</strong></td><td data-it>Tutti</td><td data-en>All</td><td data-it>Apre un portale a un luogo visitato (1 round, umano o più piccolo)</td><td data-en>Opens portal to a past location (1 round, human size or smaller)</td></tr>
            <tr><td><strong>Enshroud</strong></td><td data-it>Specter</td><td data-en>Specter</td><td data-it>Protegge un Esploratore dal Blight per 1 Tratto (reazione)</td><td data-en>Fully protects an Explorer from Blight for 1 Stretch (reaction)</td></tr>
            <tr><td><strong>Flicker Field</strong></td><td data-it>Tutti</td><td data-en>All</td><td data-it>Protegge da tutti gli attacchi a distanza fino a fine round</td><td data-en>Protects from all ranged attacks until the end of round</td></tr>
            <tr><td><strong>Glyph Warden</strong></td><td data-it>Tutti</td><td data-en>All</td><td data-it>Reazione: blocca l'effetto di un Glifo su un Esploratore</td><td data-en>Reaction: blocks a Glyph effect on an Explorer</td></tr>
            <tr><td><strong>Illusionary Veil</strong></td><td data-it>Guide</td><td data-en>Guide</td><td data-it>Nasconde un Esploratore dalla vista (anche scanner) per 1 Tratto</td><td data-en>Hides an Explorer from sight (incl. scanners) for 1 Stretch</td></tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <!-- ================================================================ -->
  <!-- TAB: FAZIONI -->
  <!-- ================================================================ -->
  <div id="tab-fazioni" class="tab-content">

    <div data-it><div class="sec-heading"><span class="icon">🏛</span> Fazioni & Gilde di Ship City</div></div>
    <div data-en><div class="sec-heading"><span class="icon">🏛</span> Factions & Guilds of Ship City</div></div>

    <div class="grid grid-2">

      <div class="card teal">
        <div class="card-title">🔭 Navigators Guild</div>
        <div data-it>
          <p style="font-size:0.83rem">La fazione più importante del sistema Jumuah — il governo de facto di Ship City. Mix di accademici pragmatici e scienziati mistici.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>Guidata dall'<strong>Arcimandrità</strong> (attuale: il vecchissimo Poliatres)</li>
            <li>Gestisce l'<strong>Astrolaab</strong>, la torre che si estende fino allo spazio</li>
            <li>Calcola rotte e gestisce le spedizioni con i Greatship</li>
            <li>Usa i Garuda per l'esplorazione; li regola con legge severa</li>
          </ul>
        </div>
        <div data-en>
          <p style="font-size:0.83rem">The most important faction in Jumuah — the de facto government of Ship City. A mix of pragmatic power brokers and idealistic mystic scientists.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>Led by the <strong>Archimandrite</strong> (current: the very elderly Poliatres)</li>
            <li>Controls the <strong>Astrolaab</strong>, the tower that stretches into space</li>
            <li>Calculates routes and manages Greatship expeditions</li>
            <li>Uses Garuda extensively; regulates them with strict law</li>
          </ul>
        </div>
      </div>

      <div class="card orange">
        <div class="card-title">⚙ Machinists Guild</div>
        <div data-it>
          <p style="font-size:0.83rem">I custodi della colossale macchina che è Ship City. Si autodefiniscono guardiani del <em>Cherolab</em>, il motore che non muore mai.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>Artigiani, meccanici e i migliori artisti della città</li>
            <li>I loro <strong>hull painter</strong> decorano le navi con affreschi mozzafiato</li>
            <li>Operano nelle <strong>Turbine Halls</strong> nelle profondità di Ship City</li>
            <li>Fondamentali: senza di loro le navi non volano</li>
          </ul>
        </div>
        <div data-en>
          <p style="font-size:0.83rem">Caretakers of the colossal machine that is Ship City. They call it the <em>Cherolab</em>, the engine that never dies.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>Craftsmen, mechanics and the greatest artists of the city</li>
            <li>Their <strong>hull painters</strong> decorate ships with breathtaking frescoes</li>
            <li>Operate in the <strong>Turbine Halls</strong> deep inside Ship City</li>
            <li>Essential: without them, no ships fly</li>
          </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-title">🌿 Gardeners Guild</div>
        <div data-it>
          <p style="font-size:0.83rem">I più piccoli tra i Grandi, ma fondamentali. Senza di loro non ci sarebbero piante né cibo.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>Gestiscono i <strong>Cave Gardens</strong> e la Foresta di Alabastro</li>
            <li>Controllano discreta parte della vita notturna e dei ristoranti</li>
            <li>Si vocifera collaborino con il <strong>Black Toad</strong> per la distribuzione di droghe</li>
            <li>Alcuni radicali credono che le piante siano il vero gioiello della civiltà</li>
          </ul>
        </div>
        <div data-en>
          <p style="font-size:0.83rem">Smallest of the majors, but essential. Without them, no plants and no food.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>Manage the <strong>Cave Gardens</strong> and the Alabaster Forest</li>
            <li>Control much of the city's nightlife and restaurants</li>
            <li>Rumored to cooperate with the <strong>Black Toad</strong> to distribute drugs</li>
            <li>Radicals claim plants are the true jewel of Jumuahn civilization</li>
          </ul>
        </div>
      </div>

      <div class="card red">
        <div class="card-title">🎭 Coriolites</div>
        <div data-it>
          <p style="font-size:0.83rem">Famiglie ancestrali che vivono nell'<strong>Inner Sanctum</strong>. Si considerano i legittimi eredi del potere, in attesa di tornare all'Orizzonte Vecchio.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>Nessun leader unico — il teologo mascherato <strong>The Sadaalian</strong> è una sorta di simbolo</li>
            <li>Ossessionati da riti, profezie e artefatti preziosi (compresi i Garuda rari)</li>
            <li>I <strong>Profeti della Stella Cieca</strong> — gruppo radicale collegato ai Corioliti — compie attacchi contro la comunità degli esploratori</li>
          </ul>
        </div>
        <div data-en>
          <p style="font-size:0.83rem">Ancestral families living in the <strong>Inner Sanctum</strong>. They see themselves as the rightful inheritors of power, waiting to return to the Old Horizon.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>No single leader — the masked theocrat <strong>The Sadaalian</strong> is a figurehead</li>
            <li>Obsessed with rituals, prophecies, and rare artifacts (including rare Garuda)</li>
            <li>The <strong>Prophets of the Unseeing Star</strong> — a radical group linked to Coriolites — attacks the exploring community</li>
          </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-title">🐸 Black Toad</div>
        <div data-it>
          <p style="font-size:0.83rem">L'organizzazione criminale di Ship City. Struttura quasi settaria, tatuaggio del rospo nascosto sul corpo dei membri.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>Contrabbando, estorsione, traffici illeciti dall'<strong>Hull Town</strong></li>
            <li>La misteriosa leader <strong>The Athenian</strong> si nasconde nell'Hull Town</li>
            <li>Tentacoli ovunque — anche nelle fazioni "rispettabili"</li>
            <li>Opera nelle Colonie Esterne oltre che a Ship City</li>
          </ul>
        </div>
        <div data-en>
          <p style="font-size:0.83rem">Ship City's criminal organization. Near-sect-like structure; members wear a hidden toad tattoo.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>Smuggling, extortion, illicit trades from <strong>Hull Town</strong></li>
            <li>The mysterious leader <strong>The Athenian</strong> hides in Hull Town</li>
            <li>Tentacles everywhere — even in "respectable" factions</li>
            <li>Operates in the Outer Colonies as well as Ship City</li>
          </ul>
        </div>
      </div>

      <div class="card teal">
        <div class="card-title">🔍 Explorers Guild</div>
        <div data-it>
          <p style="font-size:0.83rem">La gilda più giovane, fondata da <strong>Master Moska</strong>. Il datore di lavoro dei personaggi giocanti.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>Quartier generale: <strong>The Outpost</strong>, un vecchio pub riconvertito</li>
            <li>Grido di battaglia: <em>"Esplorare o perire!"</em></li>
            <li>I delver operano in crew indipendenti, iscritte nel registro di Moska</li>
            <li>Accesso al <strong>The Vault</strong>, il bar esclusivo della gilda</li>
            <li>La gilda possiede navette e rover assegnati alle crew</li>
          </ul>
        </div>
        <div data-en>
          <p style="font-size:0.83rem">The youngest guild, founded by <strong>Master Moska</strong>. The employer of the player characters.</p>
          <ul style="font-size:0.82rem;margin-top:0.5rem">
            <li>HQ: <strong>The Outpost</strong>, a repurposed old pub</li>
            <li>Rallying cry: <em>"Explore or perish!"</em></li>
            <li>Delvers operate as independent crews registered with Moska</li>
            <li>Access to <strong>The Vault</strong>, the guild's exclusive bar</li>
            <li>The guild owns shuttles and rovers assigned to crews</li>
          </ul>
        </div>
      </div>

      <div class="card orange">
        <div class="card-title" data-it>⛏ Fazioni Minori</div>
        <div class="card-title" data-en>⛏ Lesser Factions</div>
        <div data-it>
          <ul style="font-size:0.82rem">
            <li><strong>Mining Combine</strong> — la "quarta gilda" non ufficiale. Controlla l'estrazione di gas nobile dai Campi Esterni. Senza il loro gas, Ship City si ferma.</li>
            <li><strong>Wreckers</strong> — pirati e sabotatori. I loro trasmettitori di disturbo ghiacciano il sangue. Ciò che Ship City costruisce, i Wreckers distruggono.</li>
            <li><strong>Profeti della Stella Cieca</strong> — radicali Corioliti che attaccano la comunità esploratrice. Obiettivo: fermare l'intero progetto di Ship City.</li>
          </ul>
        </div>
        <div data-en>
          <ul style="font-size:0.82rem">
            <li><strong>Mining Combine</strong> — the unofficial "fourth guild." Controls noble gas extraction from the Outer Fields. Without their gas, Ship City stops.</li>
            <li><strong>Wreckers</strong> — pirates and saboteurs. Their jamming transmitters freeze the blood. What Ship City builds, the Wreckers destroy.</li>
            <li><strong>Prophets of the Unseeing Star</strong> — Coriolite radicals who attack the exploring community. Goal: stop the entire Ship City project.</li>
          </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-title" data-it>🏙 Quartieri di Ship City</div>
        <div class="card-title" data-en>🏙 Districts of Ship City</div>
        <div data-it>
          <table>
            <thead><tr><th>Quartiere</th><th>Descrizione</th></tr></thead>
            <tbody>
              <tr><td><strong>Hull Town</strong></td><td>Superficie esterna, vicoli e tunnel. Base del Black Toad.</td></tr>
              <tr><td><strong>The Chasm</strong></td><td>Abisso vertiginoso, mercato degli uccelli, kiteflyer, spezierie.</td></tr>
              <tr><td><strong>The Haze</strong></td><td>Zona pericolosa intermedia — meglio non soffermarsi.</td></tr>
              <tr><td><strong>Cave Gardens</strong></td><td>Campi fioriti dei Giardinieri. Meravigliosamente inaspettati.</td></tr>
              <tr><td><strong>Turbine Halls</strong></td><td>Sale industriali fumose dei Macchinisti.</td></tr>
              <tr><td><strong>Inner Sanctum</strong></td><td>Cuore di Ship City. Caverne dei riti Corioliti.</td></tr>
              <tr><td><strong>Aluminum Bay</strong></td><td>Porto affollato. I Greatship attraccano qui.</td></tr>
              <tr><td><strong>Astrolaab</strong></td><td>Torre dei Navigatori. Si estende fino allo spazio.</td></tr>
            </tbody>
          </table>
        </div>
        <div data-en>
          <table>
            <thead><tr><th>District</th><th>Description</th></tr></thead>
            <tbody>
              <tr><td><strong>Hull Town</strong></td><td>Outer surface, rickety alleys and tunnels. Black Toad home.</td></tr>
              <tr><td><strong>The Chasm</strong></td><td>Dizzying drop, bird market, kiteflyers, spice smells.</td></tr>
              <tr><td><strong>The Haze</strong></td><td>Dangerous middle zone — best not to dwell here.</td></tr>
              <tr><td><strong>Cave Gardens</strong></td><td>Gardeners' blooming fields. Surprisingly beautiful.</td></tr>
              <tr><td><strong>Turbine Halls</strong></td><td>Smog-filled industrial halls of the Machinists.</td></tr>
              <tr><td><strong>Inner Sanctum</strong></td><td>Ship City's dusty heart. Coriolite ritual caves.</td></tr>
              <tr><td><strong>Aluminum Bay</strong></td><td>Bustling harbour. The Greatships dock here.</td></tr>
              <tr><td><strong>Astrolaab</strong></td><td>Navigators' tower. Stretches all the way into space.</td></tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <!-- ================================================================ -->
  <!-- TAB: CONSIGLI -->
  <!-- ================================================================ -->
  <div id="tab-consigli" class="tab-content">

    <div data-it><div class="sec-heading"><span class="icon">💡</span> Consigli per Giocatori e GM</div></div>
    <div data-en><div class="sec-heading"><span class="icon">💡</span> Tips for Players & GMs</div></div>

    <div class="grid grid-2">

      <div class="card teal">
        <div class="card-title" data-it>🎮 Consigli per i Giocatori</div>
        <div class="card-title" data-en>🎮 Player Tips</div>
        <div data-it>
          <ul>
            <li><strong>Forzare con saggezza:</strong> ogni 1 su un Dado Base ti costa 1 Speranza. Forza solo quando conta davvero.</li>
            <li><strong>Collabora:</strong> fino a 3 alleati possono aiutarti (+1 dado ciascuno). I tiri di gruppo sono fondamentali.</li>
            <li><strong>Tieni d'occhio il Cuore:</strong> il Blight è subdolo — una manifestazione può essere permanente.</li>
            <li><strong>Usa il Cimelio:</strong> una volta a sessione puoi forzare gratuitamente. Non sprecarlo.</li>
            <li><strong>Il Quirk conta:</strong> interpretare bene il Quirk ti farà guadagnare più esperienza.</li>
            <li><strong>Il Volatile è prezioso:</strong> la creatura aliena può aiutarti in modi unici. Proteggila.</li>
            <li><strong>Non tirare sempre:</strong> il gioco funziona meglio se i tiri sono riservati ai momenti drammatici.</li>
            <li><strong>Supply limitato:</strong> un delve tipico per 4 persone richiede 30-60 punti. Pianifica in anticipo.</li>
          </ul>
        </div>
        <div data-en>
          <ul>
            <li><strong>Push wisely:</strong> each 1 on a Base Die costs 1 Hope. Only push when it really matters.</li>
            <li><strong>Collaborate:</strong> up to 3 allies can help you (+1 die each). Group rolls are fundamental.</li>
            <li><strong>Watch your Heart:</strong> Blight is insidious — a manifestation can be permanent.</li>
            <li><strong>Use your Keepsake:</strong> once per session, you can push for free. Don't waste it.</li>
            <li><strong>The Quirk matters:</strong> playing your Quirk well earns more experience.</li>
            <li><strong>The Bird is precious:</strong> the alien creature can help you in unique ways. Protect it.</li>
            <li><strong>Don't always roll:</strong> the game works best when rolls are reserved for dramatic moments.</li>
            <li><strong>Limited Supply:</strong> a typical delving for 4 needs 30–60 Supply points. Plan ahead.</li>
          </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-title" data-it>🎲 Consigli per il GM</div>
        <div class="card-title" data-en>🎲 GM Tips</div>
        <div data-it>
          <ul>
            <li><strong>Non abusare dei tiri:</strong> riserva le prove per situazioni con posta in gioco reale. Se l'esito non conta, non far tirare.</li>
            <li><strong>Usa i livelli Blight in modo creativo:</strong> il Blight non è solo danno — è atmosfera, tensione, trasformazione.</li>
            <li><strong>PNG minori muoiono ai critici:</strong> i PNG secondari vengono eliminati quando il danno supera la soglia critica, senza tabella D66.</li>
            <li><strong>Costruisci pressione con il tempo:</strong> usa round, tratti e turni per creare urgenza nelle situazioni di crisi.</li>
            <li><strong>Difficoltà implicita:</strong> non annunci mai la difficoltà di un'azione. Si tira o non si tira.</li>
            <li><strong>L'iniziativa è narrativa:</strong> lo scambio di carte può ribaltare situazioni tattiche — incoraggia i giocatori a usarlo.</li>
            <li><strong>Speranza come risorsa:</strong> i giocatori possono donarsi Speranza a vicenda — crea momenti di solidarietà.</li>
          </ul>
        </div>
        <div data-en>
          <ul>
            <li><strong>Don't over-roll:</strong> reserve checks for situations with real stakes. If the outcome doesn't matter, don't roll.</li>
            <li><strong>Use Blight levels creatively:</strong> Blight isn't just damage — it's atmosphere, tension, transformation.</li>
            <li><strong>Minor NPCs die at crits:</strong> minor NPCs are taken out when damage exceeds the crit threshold — no D66 table needed.</li>
            <li><strong>Build pressure with time:</strong> use rounds, stretches and shifts to create urgency in crisis situations.</li>
            <li><strong>Implicit difficulty:</strong> never announce an action's difficulty. Either roll or don't.</li>
            <li><strong>Initiative is narrative:</strong> card exchanges can flip tactical situations — encourage players to use them.</li>
            <li><strong>Hope as a resource:</strong> players can donate Hope to each other — creates solidarity moments.</li>
          </ul>
        </div>
      </div>

      <div class="card orange">
        <div class="card-title" data-it>🌑 Ambientazione — Ship City e il Great Dark</div>
        <div class="card-title" data-en>🌑 Setting — Ship City & the Great Dark</div>
        <div data-it>
          <ul>
            <li><strong>Ship City:</strong> metropoli-asteroide ai confini dello spazio conosciuto. Costruita dai resti delle navi della Diaspora.</li>
            <li><strong>La Diaspora:</strong> gruppo di rifugiati fuggiti dal Terzo Orizzonte durante una guerra, diretti verso il segnale del leggendario Nadir.</li>
            <li><strong>Il Great Dark:</strong> lo spazio inesplorato del Lost Horizon — pieno di rovine, aberrazioni e misteri.</li>
            <li><strong>Il Slipstream:</strong> fenomeno che permette di viaggiare attraverso il sistema Jumuah.</li>
            <li><strong>La Gilda degli Esploratori:</strong> organizzazione fondata da Master Moska per coordinare l'esplorazione delle rovine.</li>
            <li><strong>Ruoli nella Gilda:</strong> Delver, Scout, Burrower, Guard — ogni crew ne ha uno di ogni tipo.</li>
          </ul>
        </div>
        <div data-en>
          <ul>
            <li><strong>Ship City:</strong> asteroid-metropolis at the edge of known space. Built from the remnants of the Diaspora's fleet.</li>
            <li><strong>The Diaspora:</strong> refugees who fled the Third Horizon during a war, seeking the signal of the legendary Nadir.</li>
            <li><strong>The Great Dark:</strong> the unexplored space of the Lost Horizon — full of ruins, aberrations and mysteries.</li>
            <li><strong>The Slipstream:</strong> phenomenon that allows travel through the Jumuah system.</li>
            <li><strong>The Explorers Guild:</strong> an organization founded by Master Moska to coordinate ruin exploration.</li>
            <li><strong>Guild roles:</strong> Delver, Scout, Burrower, Guard — each crew has one of each.</li>
          </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-title" data-it>🔄 Riepilogo Flusso di Gioco</div>
        <div class="card-title" data-en>🔄 Gameplay Flow Summary</div>
        <div data-it>
          <ol class="steps">
            <li>Il GM descrive la situazione.</li>
            <li>I giocatori dichiarano le loro intenzioni.</li>
            <li>Se la situazione è incerta e le conseguenze sono importanti → si tira.</li>
            <li>Scegli attributo + talento applicabile + gear bonus.</li>
            <li>Tira i dadi. Almeno un 6 = successo.</li>
            <li>Successi multipli migliorano l'effetto (danno extra, informazioni extra, ecc.).</li>
            <li>Se fallisci e vuoi provare ancora → spingi il tiro (una sola volta). Attenzione agli 1!</li>
            <li>Il GM narra le conseguenze.</li>
          </ol>
        </div>
        <div data-en>
          <ol class="steps">
            <li>The GM describes the situation.</li>
            <li>Players declare their intentions.</li>
            <li>If the outcome is uncertain and stakes are real → roll.</li>
            <li>Choose attribute + applicable talent + gear bonus.</li>
            <li>Roll dice. At least one 6 = success.</li>
            <li>Multiple successes improve the effect (extra damage, extra info, etc.).</li>
            <li>If you fail and want to try again → push the roll (once only). Watch out for 1s!</li>
            <li>The GM narrates the consequences.</li>
          </ol>
        </div>
      </div>

    </div>
  </div>

  <footer>
    <span data-it>Coriolis: The Great Dark — Cheatsheet di riferimento · Basato su Quickstart & Corebook · Non ufficiale</span>
    <span data-en>Coriolis: The Great Dark — Reference Cheatsheet · Based on Quickstart & Corebook · Unofficial</span>
  </footer>

</div><!-- /wrapper -->

<script src="assets/js/cheatsheet.js"></script>
</body>
</html>
