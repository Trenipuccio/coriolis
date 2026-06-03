<?php
/**
 * Coriolis: The Great Dark — Character Generator API
 * Returns JSON with a randomly generated character
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// ─── Load data ───────────────────────────────────────────────────────────────
$dataPath = __DIR__ . '/../assets/data.json';
if (!file_exists($dataPath)) {
    http_response_code(500);
    echo json_encode(['error' => 'Data file not found']);
    exit;
}

$data = json_decode(file_get_contents($dataPath), true);

// ─── Input ────────────────────────────────────────────────────────────────────
$mode       = $_GET['mode']       ?? 'normal';      // normal | solo | custom
$lang       = $_GET['lang']       ?? 'en';          // en | it
$profId     = $_GET['prof']       ?? null;           // 1-8 or null (random)
$originId   = $_GET['origin']     ?? null;           // D66 key or null

// ─── Helpers ─────────────────────────────────────────────────────────────────

function d6(): int { return random_int(1, 6); }
function d8(): int { return random_int(1, 8); }

function rollD66(): int {
    $tens = random_int(1, 6);
    $ones = random_int(1, 6);
    return (int)($tens * 10 + $ones);
}

function pickRandom(array $arr) {
    if (empty($arr)) return null;
    return $arr[array_rand($arr)];
}

function pickByD66(array $table): array {
    // Roll D66 and find closest key (handles sparse tables like 11,13,15,21...)
    $keys = array_keys($table);
    sort($keys);
    $roll = rollD66();

    $best = $keys[0];
    foreach ($keys as $k) {
        if ((int)$k <= $roll) $best = $k;
        else break;
    }
    return [(int)$best, $table[$best]];
}

function pickByD6(array $table) {
    $keys = array_keys($table);
    sort($keys);
    $roll = d6();
    $best = $keys[0];
    foreach ($keys as $k) {
        if ((int)$k <= $roll) $best = $k;
        else break;
    }
    return $table[$best];
}

// ─── Roll Attributes (point buy) ─────────────────────────────────────────────
function rollAttributes(int $points): array {
    // All start at 2, distribute remaining points (max 5 per attribute)
    $attrs = ['STR' => 2, 'AGI' => 2, 'LOG' => 2, 'PER' => 2, 'INS' => 2, 'EMP' => 2];
    $pool = $points - 12; // 12 is base (6 × 2)
    $names = array_keys($attrs);

    while ($pool > 0) {
        shuffle($names);
        $bumped = false;
        foreach ($names as $a) {
            if ($attrs[$a] < 5 && $pool > 0) {
                $attrs[$a]++;
                $pool--;
                $bumped = true;
                break;
            }
        }
        if (!$bumped) break;
    }
    return $attrs;
}

// ─── Calculate derived stats ──────────────────────────────────────────────────
function derivedStats(array $attrs, string $mode, string $carry): array {
    $str = $attrs['STR'];
    $agi = $attrs['AGI'];
    $log = $attrs['LOG'];
    $per = $attrs['PER'];
    $ins = $attrs['INS'];
    $emp = $attrs['EMP'];

    $carryVal = ($carry === 'STR+6') ? $str + 6 :
                (($carry === 'STR+4') ? $str + 4 : $str + 4);

    return [
        'health'   => $str + $agi,
        'hope'     => $log + $emp,
        'heart'    => $ins + $per,
        'carry'    => $carryVal,
    ];
}

// ─── Capital ──────────────────────────────────────────────────────────────────
function rollCapital(string $formulaKey, array $formulas, ?string $bonusStr, bool $isSolo): array {
    $f = $formulas[$formulaKey] ?? $formulas['starting_capital_formula_1'];
    $total = 0;
    for ($i = 0; $i < $f['dice']; $i++) $total += d6();
    $total *= $f['mult'];

    $bonus = 0;
    if ($isSolo && $bonusStr) {
        // D6 × 500
        if (preg_match('/D6\s*[×x]\s*(\d+)/', $bonusStr, $m)) {
            $bonus = d6() * (int)$m[1];
        }
    }
    return [
        'base'    => $total,
        'bonus'   => $bonus,
        'total'   => $total + $bonus,
        'formula' => $f['formula'] . ($isSolo && $bonus ? ' + ' . $bonusStr : ''),
    ];
}

// ─── Main generation ─────────────────────────────────────────────────────────

$gameMode = $data['game_modes'][$mode] ?? $data['game_modes']['normal'];
$points   = (int)$gameMode['points'];
$startXP  = (int)$gameMode['xp'];
$isSolo   = ($mode === 'solo');
$isCustom = ($mode === 'custom');

// 1. ORIGIN
$origins   = $data['origins'];
$originKeys = array_keys($origins);
if ($originId && isset($origins[$originId])) {
    $chosenOriginKey = $originId;
    $origin = $origins[$originId];
    $originRoll = (int)$originId;
} else {
    [$originRoll, $originData] = pickByD66($origins);
    $chosenOriginKey = (string)$originRoll;
    $origin = $originData;
}

// 2. PROFESSION
$professions = $data['professions'];
if ($profId && isset($professions[$profId])) {
    $profRoll  = (int)$profId;
    $profession = $professions[$profId];
} else {
    $profRoll  = d8();
    $profId    = (string)$profRoll;
    $profession = $professions[$profId] ?? $professions['1'];
}

// Name for this profession
$namesForProf = $data['prof_names'][$profId] ?? $data['prof_names']['1'];
$chosenName   = pickRandom($namesForProf);

// Equipment for this profession
$equipForProf = $data['prof_equip'][$profId] ?? $data['prof_equip']['1'];
$chosenEquip  = pickRandom($equipForProf);

// Specialty for this profession
$specsForProf = $data['prof_specs'][$profId] ?? $data['prof_specs']['1'];
$specRoll     = d6();
$specIdx      = min($specRoll - 1, count($specsForProf) - 1);
$chosenSpec   = $specsForProf[$specIdx];

// 3. ATTRIBUTES
$attrs = rollAttributes($points);

// Bonus to key attribute of profession
$keyAttrMap = [
    'Empathy'    => 'EMP',
    'Agility'    => 'AGI',
    'Insight'    => 'INS',
    'Strength'   => 'STR',
    'Logic'      => 'LOG',
    'Perception' => 'PER',
];
$keyAttrFull = $profession['key_attr'] ?? 'Empathy';
$keyAttrCode = $keyAttrMap[$keyAttrFull] ?? 'EMP';
if ($attrs[$keyAttrCode] < 5) $attrs[$keyAttrCode]++;

// 4. DERIVED STATS
$derived = derivedStats($attrs, $mode, $gameMode['carry'] ?? 'STR+4');

// 5. CAPITAL
$capitalFormulas = $data['capital_formulas'];
$capitalMap      = $data['capital_map'];
$capitalFormulaKey = $capitalMap[$origin['location']] ?? 'starting_capital_formula_1';
$capital = rollCapital($capitalFormulaKey, $capitalFormulas, $gameMode['capital_bonus'] ?? null, $isSolo);

// 6. QUIRK
[$quirkRoll, $quirk] = pickByD66($data['quirks']);

// 7. KEEPSAKE
[$keepsakeRoll, $keepsake] = pickByD66($data['keepsakes']);

// 8. APPEARANCE
[$appearanceRoll, $appearance] = pickByD66($data['appearances']);

// 9. REASON
[$reasonRoll, $reason] = pickByD66($data['reasons']);

// 10. SOLO-ONLY: Background, Blight Scar, Moniker
$background = null;
$blightScar = null;
$moniker    = null;

if ($isSolo) {
    // Background
    $bgRoll = d6();
    $background = $data['backgrounds'][(string)$bgRoll] ?? null;

    // Blight Scar
    [$scarRoll, $scarData] = pickByD66($data['blight_scars']);
    $blightScar = $scarData;
    $blightScar['roll'] = $scarRoll;

    // Moniker (prefix + suffix, each D66)
    [$prefixRoll, $prefix] = pickByD66($data['moniker_prefixes']);
    [$suffixRoll, $suffix] = pickByD66($data['moniker_suffixes']);
    $moniker = [
        'prefix'      => $prefix,
        'suffix'      => $suffix,
        'full'        => $prefix . $suffix,
        'prefix_roll' => $prefixRoll,
        'suffix_roll' => $suffixRoll,
    ];
}

// ─── Specialty translations ───────────────────────────────────────────────────
$specTransIT = [
    // Artist
    'Hull Painter' => [
        'name' => 'Pittore di Scafi',
        'desc' => 'Dove altri vedono il mondo a tinte di grigio, tu lo vedi immerso in colori vivaci. Fontane blu ceruleo nei Giardini, il tetto rosso sangue del Sancta Sanctorum, l\'ambra dorata del campo magnetico di Ship City. Hai trovato lavoro come pittore di scafi, portando vita alle carcasse dei vecchi navigatori spaziali. Il lavoro era pericoloso e la paga bassa, ma trovavi soddisfazione nel portare colore al vuoto del Grande Buio.',
    ],
    'Staircase Poet' => [
        'name' => 'Poeta delle Scale',
        'desc' => 'Hai sempre avuto il dono della parola, e fu sui ripidi gradini del Baratro che trovasti la tua vocazione. Era quando stavi sui gradini con il vento tra i capelli e la folla intorno che ti sentivi vivo/a. Guadagnavi a malapena per vivere, ma potevi andare e venire come volevi, incontravi amici per la vita e forse anche uno o due nemici.',
    ],
    'Maidy Row Balladeer' => [
        'name' => 'Cantastorie di Maidy Row',
        'desc' => 'Da quando eri solo un monello, canticchiavi sempre qualche motivetto. Non appena mettesti le mani sulla cittra del vicino, ti mettesti a suonarla. E Ship City, per quanto cupa, aveva disperatamente bisogno di persone come te. Le tue canzoni – ballate rassicuranti, inni trascinanti o ritornelli spensierati – aiutavano la gente ad andare avanti. Si innamoravano, sognavano un futuro migliore e, per un momento, dimenticavano di vivere in una città alla fine del nulla.',
    ],
    'Alley Theater Actor' => [
        'name' => 'Attore del Teatro di Vicolo',
        'desc' => 'Sei sempre stato/a un po\' un birichino. Che tu imitassi venditori, agenti o pattuglie della Gilda, non ci volle molto a capire il tuo vero dono: recitare. Prima che te ne accorgessi, eri un habitué dei piccoli teatri di vicolo nel Baratro. Cominciasti con ruoli secondari, ma presto ti ritrovasti come protagonista. Come molti nella scena, diventasti familiare con il vino d\'erba e l\'occasionale tiro, approfondendo i ruoli e cercando ispirazione per la prossima esibizione.',
    ],
    'Occasional Publisher' => [
        'name' => 'Editore Occasionale',
        'desc' => 'La penna è più potente di un fusilardo – o almeno lo è la stampa. Da adolescente urlavi a squarciagola nelle caotiche strade del Serpentine vendendo l\'ultimo pamphlet di pettegolezzi. Col tempo ti sei fatto/a strada – da compositore tipografico a scrittore ad assistente editore – e hai imparato il delicato equilibrio del buon editore: rendere le storie abbastanza succose da attirare attenzione senza ritorsioni, ma abbastanza degne di nota da eclissare i fogli della concorrenza.',
    ],
    'Machine Artisan' => [
        'name' => 'Artigiano delle Macchine',
        'desc' => 'Mechanical Row era sempre il tuo quartiere preferito – i suoni dei martelli, delle macchine a molla e lo scricchiolio di ingranaggi. Costruendo semplici automi, congegni di illuminazione o oggetti più pratici come imbracature di sollevamento o scalpelli meccanici, hai presto ampliato il tuo talento – fino a ottenere commissioni su misura e creare dispositivi sempre più brillanti.',
    ],
    // Enforcer
    'Zapti Constable' => [
        'name' => 'Agente Zapti',
        'desc' => 'La legge è superiore a tutto, almeno la legge della Gilda. E tu eri la legge, il suo lungo braccio. Nominato/a dalle Gilde, gestivi autonomamente un quartiere, pattugliando, parlando con i residenti o fronteggiando i delinquenti. A volte dovevi intervenire ed estrarre la rivoltella fusilarda, e nei casi più rari persino chiamare la milizia della Gilda come rinforzo.',
    ],
    'Guild Militia' => [
        'name' => 'Milizia della Gilda',
        'desc' => 'Le Gilde controllavano Ship City, e tu ne eri l\'esecutore. Quando qualcosa necessitava protezione, sorveglianza o recupero per la Gilda, tu e i tuoi compagni ve ne occupavate. Potevi fronteggiare qualsiasi opposizione, ma la maggior parte delle volte non ce n\'era. La maggior parte dei giorni pattugliavi semplicemente – lavoro noioso, routinario e monotono.',
    ],
    'Fusillard Protector' => [
        'name' => 'Protettore con Fusilardo',
        'desc' => 'La protezione era la tua vita. La fornivi direttamente scudando il cliente dagli attacchi di teppisti o squadre di demolizione, oppure indirettamente eliminando le minacce prima che causassero danni. Il tuo maneggio del fusilardo era senza precedenti. La combinazione del fusilardo con armatura e scudo faceva di te una forza formidabile in ogni situazione.',
    ],
    'Guild Investigator' => [
        'name' => 'Investigatore della Gilda',
        'desc' => 'Le cose non sono sempre come sembrano – lo sapevi per esperienza. Risolvevi i problemi più complessi della Gilda, crimini dall\'interno o dall\'esterno. Ti piaceva pensare di essere tra i migliori, ma la verità stava nel mezzo, anche se in realtà risolvevi alcuni casi. Non bastava per andare avanti, quindi facevi lavori privati di lato e accettavi commissioni da mecenati.',
    ],
    'Coriolite Guard' => [
        'name' => 'Guardia Coriolita',
        'desc' => 'Fare la guardia alle famiglie non era un compito semplice. Non si trattava solo di sorvegliare – richiedeva padroneggiare la nobile arte della presentazione, marciare in formazione e mantenere la giusta compostezza durante ricevimenti ed eventi. Hai imparato a fare tutto con stile, tenendo affilate le tue abilità. Bilanciando entrambe le cose con facilità, hai raggiunto l\'eccellenza.',
    ],
    'Bounty Hunter' => [
        'name' => 'Cacciatore di Taglie',
        'desc' => 'Le taglie abbondano nel Lost Horizon, e ne hai approfittato. Criminali violenti, truffatori e i onnipresenti rospi erano sempre bersagli liberi. Dovevi essere scaltro/a, intelligente e ben introdotto/a, senza temere di ricorrere alla violenza. La caccia ti portò in tutto Jumuah, dai vicoli di Ship City alle grotte della Luna Hasrah. Alla fine, ciò che ti spingeva era il brivido più che la giustizia.',
    ],
    // Esoteric
    'Spice Engineer' => [
        'name' => 'Ingegnere delle Spezie',
        'desc' => 'La polvere d\'orchidea cambiò tutto, e tu sapevi come farla funzionare. Nel tuo laboratorio improvvisato, nascosto in qualche vicolo dimenticato, sperimentavi con ingredienti raccolti da giardinieri, esploratori e reduci. Alcune delle tue miscele fallivano, ma erano solo piccoli contrattempi nel tuo cammino verso il successo.',
    ],
    'Bird Warden' => [
        'name' => 'Custode degli Uccelli',
        'desc' => 'Gli uccelli erano tutto per te. Li capivi, o almeno così pensavano gli altri. In realtà ci volevano molte congetture per imparare i loro comportamenti. Con la tua affinità per le cose di cui eri responsabile – ornitiari, uccelli di nave e altre creature, non sempre uccelli a dire il vero – prendevi il tuo lavoro sul serio, eccome.',
    ],
    'Coriolite Seer' => [
        'name' => 'Veggente Coriolita',
        'desc' => 'Potevi predire il futuro. O almeno nel modo in cui un Coriolita lo interpretava – con molte possibilità e nulla di realmente giusto o sbagliato. Usavi diversi strumenti: foglie di tè, vecchie ossa, pseudo-algebra o semplici dadi. Certo, nelle tue mani non erano normali. Erano pieni di verità e, beh, possibilità.',
    ],
    'Revolutionary Prophet' => [
        'name' => 'Profeta Rivoluzionario',
        'desc' => 'Eri il profeta delle masse, colui che avrebbe aiutato a liberarsi dal controllo delle Gilde – o almeno così era la teoria. I tuoi strumenti erano la voce, la retorica infuocata e il fusilardo al fianco, anche se era un difettoso che non avresti mai usato. Se le cose fossero andate come pianificato, avresti guidato il popolo verso la liberazione – ammesso di non finire in prigione prima.',
    ],
    'Toad Dreamer' => [
        'name' => 'Sognatore del Rospo',
        'desc' => 'La verità era là fuori – appena oltre la tua portata. A meno che non usassi la polvere d\'orchidea per spostare le probabilità a tuo favore. Hai sempre cercato qualcosa che sembrava trovarsi nei sogni evocati dalla polvere. Sei entrato/a nel Rospo Nero sperando di scoprire di più, sempre a caccia della prossima epifania. Non un dipendente, ma completamente dedito/a alla causa. Un giorno avresti trovato la verità. O così credevi. Forse.',
    ],
    'Rim Zealot' => [
        'name' => 'Zelota del Margine',
        'desc' => 'Non c\'era futuro a Jumuah. Tu e pochi altri avevate la visione e l\'audacia di suggerirlo. Ma era più facile per te là fuori, al Margine. Vedevi le Grandinavi partire ma non portavano mai nulla con sé, riportavano solo le ricchezze nel sistema. Toccava a te far capire alla gente delle Colonie che tenevano il futuro tra le loro mani callose. Lasciare Jumuah ed espandere le colonie verso un futuro migliore.',
    ],
    // Odd Jobber
    'Guild Clerk' => [
        'name' => 'Impiegato della Gilda',
        'desc' => 'Diciamolo chiaramente – odiavi il tuo lavoro. Soprattutto perché non eri molto bravo/a a farlo. Lo avevi ottenuto solo perché tua madre aveva un contatto nella Gilda. Ora smistavi la posta e gestivi vari compiti per un arrogante maestro della Gilda. Il tuo sogno era esplorare l\'universo. Disegnavi mappe stellari durante le pause, aspettando di salire un giorno su una nave esploratrice.',
    ],
    'Stair Peddler' => [
        'name' => 'Venditore delle Scale',
        'desc' => 'Lavoravi sui ripidi gradini del Baratro ogni mattina, giorno e notte. A volte dormivi persino lì, avvolto/a in una coperta con la magnifica vista delle luci scintillanti tutto intorno. Vendevi ciò che potevi e alla fine diventavi piuttosto bravo/a. Ma soprattutto osservavi le persone intorno a te, buone e cattive.',
    ],
    'Ice Trader' => [
        'name' => 'Commerciante di Ghiaccio',
        'desc' => 'Sai qualcosa sul ghiaccio. Sulla sua struttura, composizione e peso. Ne conosci l\'importanza. Dopotutto, lo hai commerciato per molto tempo. Assicurandoti che i capitani dei cargo portassero il carico alla Baia in tempo, vendendo obbligazioni sul ghiaccio a Gilde e mercanti. Hai imparato che chiunque controlli il flusso di ghiaccio, controlla la gente.',
    ],
    'Alley Cook' => [
        'name' => 'Cuoco di Vicolo',
        'desc' => 'Potevi fare uno stufato con quasi qualsiasi cosa, cucinare funghi alla perfezione direttamente dalle pareti delle caverne, e grigliare gustosi spiedini di quei fastidiosi prana-critters. Certo, dovevi spostare il tuo piccolo banco ogni due settimane quando gli Zapti si stancavano di te, e la paga non era buona. Ma con quello che avevi, facevi del tuo meglio.',
    ],
    'Coriolite Servant' => [
        'name' => 'Servitore Coriolita',
        'desc' => 'Ne hai viste di cerimonie pompose, rituali meticolosi e abbigliamenti elaborati, eccome. Eppure, lavorare come servitore di un nobile coriolita aveva i suoi vantaggi. Vivevi in un vero palazzo nella penombra del Sancta Sanctorum, potevi banchettare con gli avanzi delle costose cene del tuo padrone e imparavi molto sui modi del Vecchio Orizzonte.',
    ],
    'Artifact Dealer' => [
        'name' => 'Trafficante di Artefatti',
        'desc' => 'Sei sempre stato/a interessato/a alle cose. Gli oggetti belli fatti a mano instillano un senso di calma nella tua anima. Così hai imparato tutto quello che potevi su di loro e presto sapevi più del tuo venditore locale di cocci. Gli scaffali del tuo piccolo negozio hanno visto artefatti da ogni parte della Sfera Cartografata, ognuno con la sua storia. Li hai venduti tutti da tempo, ma li ricordi ancora. A volte li sogni.',
    ],
    // Roughneck
    'Hull Guard' => [
        'name' => 'Guardia dello Scafo',
        'desc' => 'Passare lunghe ore sullo scafo di una nave, come una cirripede incrostata, era la tua vita. Sempre in allerta per le turbolenze dello Slipstream o il debole bagliore della radiazione di Cherenkov, la tua vigilanza salvava equipaggi e navi. Ma il lungo tempo nel Buio ti cambiò, rendendoti sensibile alle luci forti, ai rumori e ai sapori intensi. Ora trovi conforto nelle ombre, dove un angolo buio sembra casa.',
    ],
    'Wreck Diver' => [
        'name' => 'Sommozzatore nei Relitti',
        'desc' => 'Avevi il talento di individuare punti di accesso e decifrare schemi solo guardando un vecchio relitto. Per te, ogni relitto era un intrigante puzzle spaziale. Infilandoti negli spazi angusti senza danneggiare l\'esoscheletro, eri sempre il/la primo/a a trovare e assicurare tesori. Con attrezzi per tagliare, fare leva e piegare le piastre dello scafo, dimostravi la tua abilità nell\'arte pratica dello smontaggio dei relitti.',
    ],
    'Vacuum Welder' => [
        'name' => 'Saldatore nel Vuoto',
        'desc' => 'Ti piace fondere le cose. Ti è sempre piaciuto. Hai quasi bruciato la casa della tua infanzia quando hai \'saldato\' il fusilardo di tuo padre alla cucina a gas. Ma hai imparato e sei diventato/a un maledetto genio. Nella tua mente eri come un guerriero antico, brandendo la torcia come un\'arma. Sei diventato/a un saldatore freelance per i grandi – le Gilde e simili. Più la missione era pericolosa, meglio era.',
    ],
    'Deep Miner' => [
        'name' => 'Minatore delle Profondità',
        'desc' => 'Sei sempre stato/a diffidente dei cieli stellati. Tutto quel vuoto. Da bambino/a costruivi una fortezza sotto il letto, scavando poi attraverso il pavimento verso il vicino di sotto. Dopo una terrificante prova sugli asteroidi, ti sentivi finalmente a casa. Scavare, fare cunicoli e far esplodere fino al cuore di tutto. Le ricchezze non ti attraggono: è la strada verso il basso e l\'abbraccio solido delle pareti che ti fa battere il cuore.',
    ],
    'Crane Rat' => [
        'name' => 'Topo delle Gru',
        'desc' => 'Eri sempre destinato/a ad arrampicarti. Sebbene i tuoi ricordi siano vaghi, i tuoi compagni lo ricordano bene – scalare scale tra i distretti o inseguire ladri sui tetti. Senza una vera direzione, finisti ai porti e alla Baia, dove trovasti la tua vocazione con i topi delle gru. Arrampicarsi, saltare e fissare il carico divenne la tua routine, con o senza esoscheletro.',
    ],
    'Machine Tender' => [
        'name' => 'Manutentore di Macchine',
        'desc' => 'Artigiano non pensatore, dicevano di te. Sempre con il naso immerso in qualche gadget rotto. Le tue dita smontavano e rimontavano abilmente qualsiasi macchina, scheda o aggeggio davanti a te. La teoria non era per te. Avevi il talento di far funzionare le cose, e salisti progressivamente da kite a pompe idroponiche, a reattori e persino generatori di gravità.',
    ],
    // Scholar
    'Guild Archivist' => [
        'name' => 'Archivista della Gilda',
        'desc' => 'Perché rischiare i pericoli del Lost Horizon quando un tesoro di conoscenze giaceva nascosto sotto i tuoi piedi? Capisti presto che le Gilde sapevano più di quanto lasciassero trapelare. Tutte quelle informazioni dovevano essere conservate e gestite correttamente. Chi meglio di te? Archiviare, catalogare e organizzare divenne la tua missione, e la portasti avanti con eccellenza.',
    ],
    'Algebraist Apprentice' => [
        'name' => 'Apprendista Algebrista',
        'desc' => 'Da piccolo/a hai sempre saputo che c\'è qualcosa di più nell\'Orizzonte. Qualcosa dietro tutto. Quando studiasti la vecchia arte dell\'al-jabr, scopristi i fili che tengono insieme l\'universo. Ti immergevi nei vecchi tomi, scarabocchiavi calcoli su ogni superficie e, alla fine, diventasti un Algebrista. Quando indossasti il tradizionale berretto, diventasti qualcuno di importanza. Il tuo lavoro significava qualcosa. Lo significa ancora.',
    ],
    'Slipstream Cartographer' => [
        'name' => 'Cartografo dello Slipstream',
        'desc' => 'Da bambino/a creavi mappe dei vicoli del tuo quartiere e organizzavi cacce al tesoro per gli amici. Tuo padre diceva che i tuoi scarabocchi erano geniali (non lo erano) e pagò il Vecchio Fourad per insegnarti la cartografia. Era un noioso millantatore, ma le sue mappe del Vecchio Orizzonte ti facevano girare la testa. Guardavi le stelle e ti prefiggevi di raggiungere quei territori lontani e inesplorati.',
    ],
    'Diaspora Historian' => [
        'name' => 'Storico della Diaspora',
        'desc' => 'Il Vecchio Orizzonte è interessante a modo suo, ma il vero fondamento della società moderna è la Diaspora stessa. Le persone sarebbero stupite di quanto si possa ricondurre a certi individui dell\'equipaggio originale. Hai scritto ampiamente sull\'argomento ed è persino stato/a pubblicato/a su alcune riviste minori. Eppure, così tanto rimane da scoprire. Forse un giorno tornerai al tuo soggetto.',
    ],
    'Cave Botanist' => [
        'name' => 'Botanico delle Caverne',
        'desc' => 'Fiori e piante ti hanno sempre perplesso/a. Il potere di un seme nel diventare albero, il potere di un fungo nel diffondere la sua rete di micelio e lo strano potere del Blight nel sovvertire tutto. Lavorando nei Giardini delle Caverne da bambino/a, hai imparato le basi dell\'orticoltura e dell\'idroponica. Viaggiare verso altri sistemi ti ha esposto all\'universo più profondo della botanica e del Blight.',
    ],
    'Builder Archaeologist' => [
        'name' => 'Archeologo dei Costruttori',
        'desc' => 'Non c\'è nulla di più importante che capire i monumenti dei Costruttori. Leggere nei pamphlet le notizie di spedizioni lontane, setacciare le biblioteche di Ship City per tutti i testi sulla nuova archeologia. Finalmente poter esaminare i cocci sotto la tutela della maestra archeologa Sunna, lo sapevi: dovevi vedere le rovine con i tuoi occhi.',
    ],
    // Scoundrel
    'Dust Runner' => [
        'name' => 'Corriere della Polvere',
        'desc' => 'Lo chiamano il Blight una maledizione, ma lo è davvero? Ha reso la tua vita più eccitante, questo è certo. Trasportare la Polvere per i Rospi era una scelta facile. Prendi un pacchetto. Consegnalo. Vieni pagato/a. Semplice. Le Gilde ti odiano e ti danno la caccia, ma non è colpa tua se i loro membri vogliono cavalcare la Nebbia Rossa. Domanda e offerta. Non ti cattureranno mai – sei troppo furbo/a, loro troppo lenti.',
    ],
    'Tech Smuggler' => [
        'name' => 'Contrabbandiere di Tecnologia',
        'desc' => 'Ci sono troppe regole in questo posto. Le quarantene della Gilda per i cocci sono uno scherzo. Paura dell\'infestazione da marciume? Pfft! Hanno solo paura della concorrenza. E i pomposi Corioliti custodiscono la tecnologia del Vecchio Mondo come se fosse loro. Stai contrabbandando cocci dalle miniere e tecnologia del Vecchio Orizzonte dal Cimitero da anni e nulla è andato storto. Beh, nulla di importante…',
    ],
    'Guild Spy' => [
        'name' => 'Spia della Gilda',
        'desc' => 'Gli imperi non si costruirono in un giorno, e neanche le Gilde. Il potere e la gloria della Gilda furono costruiti da persone come te – disposti a fare il passo in più per ottenere informazioni che mantenevano la Gilda un passo avanti. Era sempre per il bene comune. La maggior parte delle persone era troppo ignorante per capirlo. Ma eri felice di lavorare nell\'ombra, piantando i semi per un futuro migliore.',
    ],
    'Alley Thug' => [
        'name' => 'Teppista di Vicolo',
        'desc' => 'Sei sempre stato/a bravo/a con le mani. Il tuo uno-due era leggendario tra gli amici da bambino/a. Non sei cattivo/a, sai solo cosa funziona. Ma sei un ottimo/a picchiatore/trice se la situazione lo richiede. Bouncer, esecutore, recuperatore di crediti – non sei schizzinoso/a. La gente ti chiama uno strumento, ma non te ne importa. Ti vogliono quando le cose si mettono brutte.',
    ],
    'Hull Cutter' => [
        'name' => 'Tagliatore di Scafi',
        'desc' => 'Tua madre ti ha insegnato come tagliare una nave, e maneggiavi gli attrezzi come un coltello da macellaio. Tu e i tuoi compagni zigzagavate nei nebbiosı porti di Ship City, strappando attrezzatura dalle navi per venderla al mercato nero. Avevi occhio per ciò che era di valore e per i punti deboli di una nave. Non avevi scrupoli a rubare, ma le navette della Gilda avevano sempre il bottino migliore.',
    ],
    'Con Artist' => [
        'name' => 'Artista della Truffa',
        'desc' => 'Le persone erano fin troppo credulone. Era come se volessero essere ingannate. Volevano fidarsi di te, anche quando sapevano che non avrebbero dovuto, e bramavano intrattenimento. Chi eri tu per negarlo loro? Eri un/una artista, con una gamma di personaggi a tua disposizione, ognuno perfetto per una diversa esibizione.',
    ],
    // Traveler
    'Tugship Pilot' => [
        'name' => 'Pilota di Rimorchiatore',
        'desc' => 'Navigare nella miasma tra Ship City e Hull Town, o guidare Grandinavi e Sloop nei moli della Baia di Alluminio – questo era il tuo lavoro quotidiano. Svolgevi i tuoi compiti con un solido e goffo Rimorchiatore appartenente a una delle grandi compagnie di spedizione. Dopo una giornata di lavoro, ti rilassavi in una delle cantinas della Baia, fumando una lunga pipa come tutti i navigatori spaziali.',
    ],
    'Hull Warden' => [
        'name' => 'Custode dello Scafo',
        'desc' => 'Che si trattasse di camminare con una lanterna attraverso i vasti depositi delle Grandinavi o di strisciare attraverso le prese d\'aria accanto al vuoto gelido, riuscivi sempre a rilevare perdite o tubature difettose prima che diventassero pericolose. Avevi imparato a distinguere il suono di scricchiolii sani e bulloni ben oliati dai rivetti fratturati e dal sinistro sussurro dell\'atmosfera che fuoriusciva.',
    ],
    'Guild Surveyor' => [
        'name' => 'Topografo della Gilda',
        'desc' => 'Il Sistema Jumuah è pieno di tesori nascosti, che siano nelle profondità del Buio, tra nuvole di relitti o sulle lune rocciose di Amalum. Armato/a di scanner e ottimetri, scrutavi e rivendicavi per le Gilde di Ship City tutto ciò che trovavi. Era un lavoro solitario ma appagante, sapendo di essere essenziale per la sopravvivenza della Diaspora.',
    ],
    'Kite Handler' => [
        'name' => 'Operatore di Kite',
        'desc' => 'Le macchine semplici erano solo strumenti, da lasciare ai lavoratori. Tu, tuttavia, hai imparato a operare i kite – i congegni intricati e quasi intelligenti creati dai Macchinisti. Lavoravano nelle miniere del Margine o servivano come simulacri logici nelle profondità dei mainframe delle Grandinavi. I kite, nella tua modesta opinione, erano più affidabili degli uccelli e quasi altrettanto sofisticati.',
    ],
    'Lighthouse Keeper' => [
        'name' => 'Custode del Faro',
        'desc' => 'Qualcuno doveva indicare la via nel buio. Quel qualcuno eri tu. Le rotte spaziali del sistema Jumuah non si mantenevano da sole. Manutenevi le boe radio, seminavi le riserve di ossigeno e alimentavi il vecchio reattore per tenere accesa la luce nel tuo faro su asteroide. Di tanto in tanto ricevevi qualche visitatore o incontravi corpi congelati che galleggiavano – ma la maggior parte del tempo eri solo tu e il fuoco fatuo della luce di Shalenko.',
    ],
    'Asteroid Hauler' => [
        'name' => 'Trasportatore di Asteroidi',
        'desc' => 'Radunare massi attraverso la vasta distesa dello spazio era il tuo lavoro piuttosto umile – eppure lo facevi con fervore al timone della tua nave. Usando gli artigli rinforzati e i morsetti del campo magnetico, guidavi ghiaccio, minerali e meteoroidi al trasportatore più vicino diretto a Ship City. Quando non rimbalzavi pietre davanti a te, trovavi conforto nella silenziosa solitudine del Buio vuoto.',
    ],
];

// ─── Translations ─────────────────────────────────────────────────────────────
$translations = [
    'it' => [
        'attribute_names' => [
            'STR' => 'Forza', 'AGI' => 'Agilità', 'LOG' => 'Logica',
            'PER' => 'Percezione', 'INS' => 'Intuizione', 'EMP' => 'Empatia',
        ],
        'derived_names' => [
            'health' => 'Salute', 'hope' => 'Speranza', 'heart' => 'Cuore', 'carry' => 'Carico Max',
        ],
        'key_attr' => [
            'Empathy' => 'Empatia', 'Agility' => 'Agilità', 'Insight' => 'Intuizione',
            'Strength' => 'Forza', 'Logic' => 'Logica', 'Perception' => 'Percezione',
        ],
        'profession_names' => [
            'Artist'    => 'Artista',
            'Enforcer'  => 'Esecutore',
            'Esoteric'  => 'Esoterico',
            'Odd Jobber'=> 'Tuttofare',
            'Roughneck' => 'Duro',
            'Scholar'   => 'Studioso',
            'Scoundrel' => 'Furfante',
            'Traveler'  => 'Viaggiatore',
        ],
        'mode_names' => [
            'normal' => 'Normale', 'solo' => 'Solitario', 'custom' => 'Personalizzato',
        ],
    ],
];

// ─── Build response ───────────────────────────────────────────────────────────
$response = [
    'lang'   => $lang,
    'mode'   => $mode,
    'points' => $points,
    'start_xp' => $startXP,

    'name' => [
        'first' => $chosenName['first'] ?? '—',
        'last'  => $chosenName['last']  ?? '—',
        'full'  => trim(($chosenName['first'] ?? '') . ' ' . ($chosenName['last'] ?? '')),
    ],

    'origin' => [
        'roll'     => $originRoll,
        'location' => $origin['location'],
        'desc'     => $origin['desc'],
        'talent'   => $origin['talent'],
    ],

    'profession' => [
        'roll'      => $profRoll,
        'id'        => (int)$profId,
        'name'      => $profession['name'],
        'name_it'   => $translations['it']['profession_names'][$profession['name']] ?? $profession['name'],
        'key_attr'  => $profession['key_attr'],
        'key_attr_it' => $translations['it']['key_attr'][$profession['key_attr']] ?? $profession['key_attr'],
        'talents'   => $profession['talents'] ?? [],
        'specialty' => [
            'roll'    => $specRoll,
            'name'    => $chosenSpec['name'],
            'name_it' => $specTransIT[$chosenSpec['name']]['name'] ?? null,
            'desc'    => $chosenSpec['desc'],
            'desc_it' => $specTransIT[$chosenSpec['name']]['desc'] ?? null,
            'talent'  => $chosenSpec['talent'],
        ],
        'equipment' => $chosenEquip,
    ],

    'attributes' => $attrs,
    'attr_labels' => [
        'en' => ['STR'=>'Strength','AGI'=>'Agility','LOG'=>'Logic',
                 'PER'=>'Perception','INS'=>'Insight','EMP'=>'Empathy'],
        'it' => $translations['it']['attribute_names'],
    ],

    'derived' => $derived,
    'derived_labels' => [
        'en' => ['health'=>'Health','hope'=>'Hope','heart'=>'Heart','carry'=>'Max Carry'],
        'it' => $translations['it']['derived_names'],
    ],

    'capital' => $capital,

    'quirk'      => ['roll' => $quirkRoll,      'value' => $quirk],
    'keepsake'   => ['roll' => $keepsakeRoll,    'value' => $keepsake],
    'appearance' => ['roll' => $appearanceRoll,  'value' => $appearance],
    'reason'     => ['roll' => $reasonRoll,      'value' => $reason],

    'background' => $background,
    'blight_scar'=> $blightScar,
    'moniker'    => $moniker,
];

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
