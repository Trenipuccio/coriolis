<?php
/**
 * Coriolis: The Great Dark — JS Configuration endpoint
 * Serves language-specific constants as a proper JS file.
 * Usage: <script src="assets/js/config.php?lang=it"></script>
 */
header('Content-Type: application/javascript; charset=utf-8');
header('Cache-Control: public, max-age=3600');

$lang = $_GET['lang'] ?? 'en';
if (!in_array($lang, ['en', 'it'], true)) $lang = 'en';

$t = include __DIR__ . '/../../includes/translations_' . $lang . '.php';

$transIT = [
    'quirks' => [
        'Always fidgets with something'      => 'Armeggia sempre con qualcosa',
        'Triple checks everything'           => 'Controlla tutto tre volte',
        'Always perfumed'                    => 'Sempre profumato/a',
        'Thrill seeker'                      => 'In cerca di emozioni forti',
        'Overly polite'                      => 'Eccessivamente educato/a',
        'Very superstitious'                 => 'Molto superstizioso/a',
        'Wears makeup'                       => 'Indossa il trucco',
        'Always eating'                      => 'Mangia sempre',
        'Very sleepy'                        => 'Sempre assonnato/a',
        'Easily distracted'                  => 'Si distrae facilmente',
        'Constantly reading'                 => 'Legge in continuazione',
        'Says "hmm" a lot'                   => 'Dice "hmm" spesso',
        'Smokes too much'                    => 'Fuma troppo',
        'Sniffs cirra-cirra to calm nerves'  => 'Annusa cirra-cirra per calmarsi',
        'Easily amazed'                      => 'Si stupisce facilmente',
        'Developed sense of fashion'         => 'Senso della moda molto sviluppato',
        'Eye-catching tattoo'                => 'Tatuaggio appariscente',
        'Fond of jewelry'                    => 'Appassionato/a di gioielli',
    ],
    'appearances' => [
        'Intense stare'                 => 'Sguardo intenso',
        'Unruly hair'                   => 'Capelli indomiti',
        'Frayed scarf'                  => 'Sciarpa sfilacciata',
        'Turban'                        => 'Turbante',
        'Patterned shirt'               => 'Camicia con motivi',
        'Jacket with many pockets'      => 'Giacca con molte tasche',
        'Long facial scar'              => 'Lunga cicatrice sul viso',
        'Shaved head'                   => 'Testa rasata',
        'Kohl-lined eyes'               => 'Occhi bordati di kohl',
        'Leather coat'                  => 'Cappotto di pelle',
        'Intricate face tattoo'         => 'Tatuaggio facciale intricato',
        'Henna tattooed hands'          => 'Mani tatuate con henna',
        'Patterned scarf covering face' => 'Sciarpa decorata che copre il viso',
        'Embroidered cape'              => 'Mantello ricamato',
        'Swirling tunic'                => 'Tunica con motivi vorticosi',
        'Ancient coin in necklace'      => 'Moneta antica in collana',
        'Crimson robe'                  => 'Veste cremisi',
        'Long black jacket'             => 'Lunga giacca nera',
    ],
    'talents' => [
        'Stealthy'          => 'Furtivo',
        'Miner'             => 'Minatore',
        'Endurance'         => 'Resistenza',
        'Actor'             => 'Attore',
        'Acrobat'           => 'Acrobata',
        'Sleight of Hand'   => 'Gioco di Mano',
        'Exo-Specialist'    => 'Specialista Esoscheletro',
        'Exo- Specialist'   => 'Specialista Esoscheletro',
        'Mechanic'          => 'Meccanico',
        'Botanist'          => 'Botanico',
        'Cultural Savant'   => 'Conoscitore Culturale',
        'Librarian'         => 'Bibliotecario',
        'Renowned'          => 'Rinomato',
        'Charmer'           => 'Affascinante',
        'Any combat talent' => 'Qualsiasi talento da combattimento',
        'Commander'         => 'Comandante',
        'Evasive'           => 'Elusivo',
        'Medic'             => 'Medico',
        'Investigator'      => 'Investigatore',
        'Smart'             => 'Intelligente',
        'Teratology'        => 'Teratologia',
        'Lookout'           => 'Vedetta',
        'Driver'            => 'Pilota',
        'Zero-G Training'   => 'Addestramento Microgravità',
        'Zero- G Training'  => 'Addestramento Microgravità',
        'Scan Operator'     => 'Operatore Scanner',
        'Force'             => 'Forza Bruta',
        'Jury-Rig'          => 'Rimediare',
        'Jury- Rig'         => 'Rimediare',
        'Streetwise'        => 'Conoscitore della Strada',
        'Interrogator'      => 'Interrogatore',
        'Bodyguard'         => 'Guardia del Corpo',
        'Polearms'          => 'Armi ad Asta',
        'Musician'          => 'Musicista',
        'Disguise'          => 'Travestimento',
        'Intuition'         => 'Intuizione',
        'Laboratorist'      => 'Laboratorista',
        'Bird- Handler'     => 'Addestratore di Volatili',
        'Bird-Handler'      => 'Addestratore di Volatili',
        'Shuttle Pilot'     => 'Pilota di Navetta',
    ],
    'professions' => [
        'Artist'     => 'Artista',
        'Enforcer'   => 'Esecutore',
        'Esoteric'   => 'Esoterico',
        'Odd Jobber' => 'Tuttofare',
        'Roughneck'  => 'Duro',
        'Scholar'    => 'Studioso',
        'Scoundrel'  => 'Furfante',
        'Traveler'   => 'Viaggiatore',
    ],
    'keyAttrs' => [
        'Empathy'    => 'Empatia',
        'Agility'    => 'Agilità',
        'Insight'    => 'Intuizione',
        'Strength'   => 'Forza',
        'Logic'      => 'Logica',
        'Perception' => 'Percezione',
    ],
    'attrNames' => [
        'STR' => 'Forza',
        'AGI' => 'Agilità',
        'LOG' => 'Logica',
        'PER' => 'Percezione',
        'INS' => 'Intuizione',
        'EMP' => 'Empatia',
    ],
    'derivedNames' => [
        'health' => 'Salute',
        'hope'   => 'Speranza',
        'heart'  => 'Cuore',
        'carry'  => 'Carico Max',
    ],
    'reasons' => [
        "It was your childhood dream."                         => 'Era il sogno della tua infanzia.',
        "You want to find out what's out there."               => "Vuoi scoprire cosa c'è là fuori.",
        "You read all of the zinti novels. Several times."     => 'Hai letto tutti i romanzi zinti. Più volte.',
        "You had a thirst for knowledge."                      => 'Avevi sete di conoscenza.',
        "A close friend talked you into it."                   => 'Un amico intimo ti ha convinto.',
        "You met a very persuasive recruiter down in the Bay." => 'Hai incontrato un reclutatore molto persuasivo nella Baia.',
        "You were always restless."                            => 'Sei sempre stato/a irrequieto/a.',
        "You needed the money."                                => 'Avevi bisogno di soldi.',
        "You wanted to escape the drudgery of everyday life."  => 'Volevi fuggire dalla monotonia della vita quotidiana.',
        "You promised a parent on their deathbed."             => 'Hai promesso a un genitore sul letto di morte.',
        "To escape disgrace."                                  => 'Per sfuggire alla vergogna.',
        "You had to pay a debt."                               => 'Dovevi saldare un debito.',
        "You always chased thrills."                           => 'Hai sempre inseguito le emozioni forti.',
        "You wanted to see the inside of a Greatship."         => "Volevi vedere l'interno di una Grandenave.",
        "You were fascinated by the mystery of the Builders."  => 'Eri affascinato/a dal mistero dei Costruttori.',
        "You wanted to impress someone you loved."             => 'Volevi impressionare qualcuno che amavi.',
        "You were hunted by someone bad, this was a way out."  => "Qualcuno di pericoloso ti dava la caccia, questa era una via d'uscita.",
        "Ship City simply felt too small for you."             => 'Ship City ti sembrava semplicemente troppo piccola.',
    ],
    'origins' => [
        'Orphanage'      => 'Orfanotrofio',
        'Minig Colony'   => 'Colonia Mineraria',
        'Far Colonies'   => 'Colonie Lontane',
        'Aluminium Bay'  => 'Baia di Alluminio',
        'The Dome'       => 'La Cupola',
        'The Haze'       => 'La Foschia',
        'Hull Town'      => 'Hull Town',
        'Turbine Halls'  => 'Sale delle Turbine',
        'Cave Gardens'   => 'Giardini delle Caverne',
        'Inner Sanctum'  => 'Sancta Sanctorum',
        'The Lighthouse' => 'Il Faro',
        'Scavenger Herd' => 'Orda di Predatori',
        'Greatship'      => 'Grandenave',
    ],
    'origin_descs' => [
        'The decrepit halls of an Orphanage'               => 'I decrepiti corridoi di un Orfanotrofio',
        'In the depths of a Mining Colony'                  => 'Nelle profondità di una Colonia Mineraria',
        'Under the sunless sky of the Far Colonies'         => 'Sotto il cielo senza sole delle Colonie Lontane',
        'Among the alleys and shanties of Aluminum Bay'     => 'Tra i vicoli e le baracche della Baia di Alluminio',
        'Under the iron sky of the Dome'                    => 'Sotto il cielo di ferro della Cupola',
        'Somewhere in the eternal fog of the Haze'          => 'Da qualche parte nella nebbia eterna della Foschia',
        'Among the hulks and wrecks of Hull Town'           => 'Tra i relitti e i rottami di Hull Town',
        'Deep inside the factory city of the Turbine Halls' => 'Nelle profondità della città-fabbrica delle Sale delle Turbine',
        'In the purple meadows of the Cave Gardens'         => 'Nei prati viola dei Giardini delle Caverne',
        'In the eternal dusk of the Inner Sanctum'          => 'Nella penombra eterna del Sancta Sanctorum',
        'In the Lighthouse on the edge of the dark'         => "Nel Faro ai confini dell'oscurità",
        'Among the hulks of a Scavenger Herd'               => "Tra i relitti di un'Orda di Predatori",
        'In the depths of a Greatship'                      => 'Nelle profondità di una Grandenave',
    ],
    'keepsakes' => [
        'Model of the Greatship Hammurabi'                                                       => 'Modello della Grandenave Hammurabi',
        'Recruiting pamphlet for the cult of the Lady with a Thousand Eyes, smells of perfume'   => 'Volantino del culto della Signora dai Mille Occhi, profumato',
        'Worn silver coin from the Old Horizon'                                                  => "Moneta d'argento consumata del Vecchio Orizzonte",
        'Ceremonial Coriolite dagger'                                                            => 'Pugnale cerimoniale coriolita',
        'Piece of a Builder shard'                                                               => 'Frammento di un coccio dei Costruttori',
        'Pouch with cirra-cirra leaves'                                                          => 'Sacchetto con foglie di cirra-cirra',
        'Well- read zinti novel: Ninhulam – The Golden Star'                                     => 'Romanzo zinti sgualcito: Ninhulam – La Stella d\'Oro',
        'Small statuette depicting the Uncreated Spirit'                                         => 'Piccola statuetta dello Spirito Increato',
        'Yellowed article from the Jumuah Gazette'                                               => 'Articolo ingiallito della Gazzetta di Jumuah',
        'Picture plate of a loved one'                                                           => 'Lastra fotografica di una persona cara',
        'Medallion depicting the Coriolite Traveler icon'                                        => 'Medaglione con l\'icona del Viaggiatore Coriolita',
        'Dog eared book: Mind- expanding Fungi Recipes Vol. IV by J.W. Markatalam'              => 'Libro sgualcito: Ricette di Funghi Psicoattivi Vol. IV di J.W. Markatalam',
        'Engraved brass harmonica from Dabaran'                                                  => 'Armonica di ottone incisa da Dabaran',
        'Out of date star chart by master Algebraist Zouridian'                                  => 'Mappa stellare obsoleta del maestro Algebrista Zouridian',
        'Commemorative amulet celebrating the Three Captains'                                    => 'Amuleto commemorativo dei Tre Capitani',
        'Engraved smoking pipe'                                                                  => 'Pipa da fumo incisa',
        'Well used journal'                                                                      => 'Diario molto usato',
        'Old automaton doll, can crawl but not walk'                                             => 'Vecchia bambola automa, può strisciare ma non camminare',
        'Dried and very rare purple kifu flower'                                                 => 'Fiore kifu viola essiccato e rarissimo',
        'Tame prana-rat named Zozo'                                                              => 'Prana-ratto addomesticato di nome Zozo',
        "Flask of makh spirits, brewed in the Turbine Halls in '77"                             => "Fiaschetta di liquore makh, distillato nelle Sale delle Turbine nel '77",
        'Signed biography by veteran delver Jereman: Into the Unknown'                          => "Biografia autografata del veterano Jereman: Verso l'Ignoto",
        'Rock in shifting hues found in the Great Vault of Xu'                                   => 'Roccia dai colori cangianti trovata nel Grande Caveau di Xu',
        'Wooden box with colors and paintbrush'                                                  => 'Scatola di legno con colori e pennello',
        'Small music box playing The First and Last Star'                                        => 'Piccolo carillon che suona La Prima e Ultima Stella',
        "Kuan Theater programme, season of '86. Signed by actor: To my darling"                 => "Programma del Teatro Kuan, stagione dell'86. Firmato dall'attore: Alla mia cara",
        'Glass bottle with miniature forest'                                                     => 'Bottiglia di vetro con foresta in miniatura',
        'Bronze medal issued by Navigators Guild Youth League "Junior Algebraist Meritus"'       => 'Medaglia di bronzo della Lega Giovanile della Gilda dei Navigatori "Junior Algebrista Meritus"',
        'Broken Dabarani bone mask'                                                              => "Maschera d'osso dabarana rotta",
        'Sealed glass sphere with an ink-black Blight lily'                                      => 'Sfera di vetro sigillata con un giglio del Blight nero',
        'Old deed to a repurposed ship-dwelling in Hull Town, missing the address.'              => 'Vecchio atto di proprietà di un\'abitazione a Hull Town, senza indirizzo.',
        "Children's book belonging to a missed sibling: My first Garden"                         => 'Libro per bambini di un fratello/sorella mancante: Il Mio Primo Giardino',
        "Letter from uncle that went missing in the Serpentine in '79"                          => "Lettera di uno zio scomparso nel Serpentine nel '79",
        'Worn travel edition of classic game Shroom!'                                            => 'Edizione da viaggio consumata del gioco classico Shroom!',
        'An old fusillard bullet in a necklace'                                                  => 'Un vecchio proiettile di fusilardo in una collana',
        'A supposed Builder artifact, inert and broken'                                          => 'Un presunto artefatto dei Costruttori, inerte e rotto',
    ],
    'backgrounds' => [
        'Your crew abandoned you in the heart of a delve, leaving you to die alone. Fueled by spite, you survived.'
            => 'Il tuo equipaggio ti ha abbandonato nel cuore di una spedizione, lasciandoti morire solo/a. Spinto/a dal rancore, sei sopravvissuto/a.',
        'Your crew succumbed to the lure of a rare artifact, turning on each other. Amid the violence that followed, only you remained.'
            => "Il tuo equipaggio ha ceduto al fascino di un raro artefatto, rivoltandosi l'uno contro l'altro. Tra la violenza che ne seguì, solo tu sei rimasto/a.",
        'Three delves. Three crews. All dead, except you. No crew will accept you now.'
            => 'Tre spedizioni. Tre equipaggi. Tutti morti, tranne te. Nessun equipaggio ti accetterà ora.',
        "You emerged from an expedition alone, with no memory of what happened to your crew. Since then, alone in the quiet dark of a delve, you experience occasional flashbacks. They are just fragments, but you'll eventually piece together what happened."
            => "Sei emerso/a da una spedizione solo/a, senza ricordo di cosa sia accaduto al tuo equipaggio. Da allora hai occasionali flashback nel buio silenzioso. Sono solo frammenti, ma alla fine ricostruirai cosa è successo.",
        'Your crew went on a delve while you were laid up with an injury. They never returned. Now, you hear their incessant voices, calling your name. Calling you into the dark.'
            => "Il tuo equipaggio è partito per una spedizione mentre eri bloccato/a da un infortunio. Non sono mai tornati. Ora senti le loro voci incessanti che chiamano il tuo nome nel buio.",
        "You've seen a vision of the fate that waits for you. It's best if you're alone when it happens."
            => "Hai visto una visione del destino che ti attende. È meglio essere solo/a quando accadrà.",
    ],
    'blight_scar_names' => [
        'Ghost Limb'        => 'Arto Fantasma',
        'Void Gaze'         => 'Sguardo del Vuoto',
        'Umbral Aura'       => 'Aura Umbrale',
        'Phosphorous Veins' => 'Vene Fosforescenti',
        'Thunder Blood'     => 'Sangue Tonante',
        'Stoneskin'         => 'Pelle di Pietra',
        'Translucent Skin'  => 'Pelle Traslucida',
        'Magnetized'        => 'Magnetizzato/a',
        'Parasitic Growth'  => 'Crescita Parassitaria',
        'Extra Digits'      => 'Dita Extra',
        'Third Eye'         => 'Terzo Occhio',
        'Spirit of Rot'     => 'Spirito del Marciume',
        'Second Voice'      => 'Seconda Voce',
        'Arcane Brands'     => 'Marchi Arcani',
        'Deathly Pallor'    => 'Pallore Mortale',
        'Skeletal Barbs'    => 'Spine Scheletriche',
        'Revenant'          => 'Revenant',
    ],
    'blight_scar_effects' => [
        'An arm or leg appears spectral or hazy, with bones, tendons, and veins visible through the ghostly appendage.'
            => 'Un braccio o una gamba appare spettrale e nebuloso, con ossa, tendini e vene visibili attraverso l\'appendice fantasma.',
        'Your eyes are black and dotted with star-like pinpoints of light, devoid of pupil or iris.'
            => 'I tuoi occhi sono neri e punteggiati di luci simili a stelle, privi di pupilla o iride.',
        'Wisps of smoke-like shadows wreathe your form, obscuring your figure in unnatural darkness.'
            => 'Strisce di ombre fumose avvolgono la tua figura, oscurandola in un\'oscurità innaturale.',
        'Veins and arteries glow with a wavering, neon light beneath your skin.'
            => 'Vene e arterie brillano di una luce al neon tremolante sotto la tua pelle.',
        'Electricity crackles along your skin, arcing outward from you with jolting snaps.'
            => 'L\'elettricità crepita lungo la tua pelle, irradiandosi da te con schiocchi elettrici.',
        'Your flesh has dried and hardened, becoming gray, cracked, and stone-like.'
            => 'La tua carne si è seccata e indurita, diventando grigia, screpolata e simile alla pietra.',
        'The inner workings of your body can be glimpsed through your strangely glass-like skin.'
            => 'Il funzionamento interno del tuo corpo può essere intravisto attraverso la tua pelle stranamente vitrea.',
        'Metal groans as you pass, drawn toward you inexplicably.'
            => 'Il metallo cigola al tuo passaggio, inspiegabilmente attratto verso di te.',
        'Plantlife, fungi, or some other parasitic lifeform winds through your anatomy, emerging in horrific clusters on the surface of your skin.'
            => 'Piante, funghi o altre forme di vita parassitarie si intrecciano nella tua anatomia, emergendo in grappoli orribili sulla superficie della pelle.',
        'Additional fingers lend you a dexterity both inhuman and unnerving.'
            => 'Le dita aggiuntive ti conferiscono una destrezza disumana e inquietante.',
        'An extra eye peers from your forehead, back of your skull, or center of your palm.'
            => 'Un occhio extra sbuca dalla tua fronte, dalla nuca o dal centro del palmo.',
        'A writhing darkness precedes your steps, desiccating nearby plantlife and lending an unmistakable stench of decay to the air.'
            => "Un'oscurità contorta precede i tuoi passi, disseccando la vegetazione vicina e diffondendo nell'aria un inconfondibile odore di decomposizione.",
        'You speak with two voices simultaneously – one your own, the other something else entirely.'
            => 'Parli con due voci simultaneamente – una tua, l\'altra qualcosa di completamente diverso.',
        'Builder glyphs in mutable forms etch every inch of your skin.'
            => 'Glifi dei Costruttori in forme mutevoli incidono ogni centimetro della tua pelle.',
        'Were it not for the breath filling your lungs, you might appear dead–pale, gaunt, and exuding an unnatural cold.'
            => 'Se non fosse per il respiro che riempie i tuoi polmoni, sembreresti morto/a – pallido/a, emaciato/a e con un freddo innaturale.',
        'Horns, spines, or jutting joints emerge from your skin in bony protrusions.'
            => 'Corna, spine o articolazioni sporgenti emergono dalla tua pelle in protuberanze ossee.',
        'You died once already – maybe more than once. But the universe isn\'t done with you yet.'
            => "Sei già morto/a una volta – forse più di una. Ma l'universo non ne ha ancora finito con te.",
    ],
];

$config = [
    'loading'   => $t['loading'],
    'error'     => $t['error_msg'],
    'rukh'      => $t['rukh'],
    'rollLabel' => $t['roll_label'],
    'freeTalent'=> $t['free_talent'],
    'keyAttr'   => $t['key_attr_label'],
    'points'    => $t['points_label'],
    'xpLabel'   => $t['xp_label'],
    'modeNames' => [
        'normal' => $t['mode_normal'],
        'solo'   => $t['mode_solo'],
        'custom' => $t['mode_custom'],
    ],
];

echo '/* Coriolis Generator — auto-generated config, lang=' . $lang . " */\n";
echo 'const LANG     = ' . json_encode($lang,    JSON_UNESCAPED_UNICODE) . ";\n";
echo 'const T        = ' . json_encode($config,   JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . ";\n";
echo 'const TRANS_IT = ' . json_encode($transIT,  JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . ";\n";
