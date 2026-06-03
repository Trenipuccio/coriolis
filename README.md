# Coriolis: The Great Dark — Web App
## Cheatsheet + Generatore di Personaggio

### Struttura / Structure

```
coriolis/
├── index.php                      ← Cheatsheet (9 tab, bilingue IT/EN)
├── generator.php                  ← Generatore di personaggio (bilingue IT/EN)
│
├── api/
│   └── generate.php               ← API JSON — genera il personaggio
│
├── assets/
│   ├── css/
│   │   ├── cheatsheet.css         ← Stili cheatsheet (include pulsante generatore)
│   │   └── generator.css          ← Stili generatore personaggio
│   ├── js/
│   │   ├── cheatsheet.js          ← Tab navigation (showTab)
│   │   ├── config.php             ← Endpoint PHP→JS: serve LANG, T, TRANS_IT
│   │   └── generator.js           ← Logica generatore (fetch, render, reroll, copy)
│   └── data.json                  ← Database personaggio (estratto dall'Excel)
│
├── includes/
│   ├── translations_en.php        ← Stringhe UI in inglese
│   └── translations_it.php        ← Stringhe UI in italiano
│
└── README.md
```

### Principi architetturali

| Regola                       | Come è applicata                                                                              |
|------------------------------|-----------------------------------------------------------------------------------------------|
| **CSS in file dedicato**     | `assets/css/*.css` — zero `<style>` in qualsiasi pagina                                       |
| **JS in file dedicato**      | `assets/js/*.js` — zero logica inline                                                         |
| **Config PHP→JS**            | `assets/js/config.php?lang=it` serve costanti come JS puro                                    |
| **Traduzioni centralizzate** | `includes/translations_*.php` usate da tutte le pagine PHP                                    |
| **Lingua server-side**       | `?lang=en` (default) → `<body class="lang-en">` → CSS nasconde/mostra `[data-it]`/`[data-en]` |
| **API separata**             | `api/generate.php` — JSON puro, nessun HTML                                                   |

---

## Esecuzione in locale

L'app non richiede Apache/Nginx: gira direttamente con il server integrato di PHP.

### Windows

1. **Installa PHP**
   - Scarica il pacchetto *Non Thread Safe* da [windows.php.net/download](https://windows.php.net/download/)
   - Estrai in una cartella tipo `C:\php`
   - Aggiungi `C:\php` alla variabile d'ambiente `PATH`
     (`Pannello di controllo → Sistema → Variabili d'ambiente → Path → Modifica`)
   - Verifica: apri un nuovo terminale e digita `php -v`

2. **Avvia il server**

   ```bat
   cd C:\percorso\alla\cartella\coriolis
   php -S localhost:8080
   ```

3. **Apri nel browser**
   - `http://localhost:8080/` — Cheatsheet (inglese)
   - `http://localhost:8080/?lang=it` — Cheatsheet (italiano)
   - `http://localhost:8080/generator.php` — Generatore (inglese)
   - `http://localhost:8080/generator.php?lang=it` — Generatore (italiano)

---

### Linux (Debian/Ubuntu)

1. **Installa PHP**

   ```bash
   sudo apt update
   sudo apt install php-cli
   ```

   Verifica: `php -v`

2. **Avvia il server**

   ```bash
   cd /percorso/alla/cartella/coriolis
   php -S localhost:8080
   ```

3. **Apri nel browser**
   - `http://localhost:8080/`
   - `http://localhost:8080/?lang=it`
   - `http://localhost:8080/generator.php`
   - `http://localhost:8080/generator.php?lang=it`

---

### Linux (Fedora/RHEL/CentOS)

```bash
sudo dnf install php-cli
cd /percorso/alla/cartella/coriolis
php -S localhost:8080
```

---

> **Requisiti minimi:** PHP 7.4+ — nessuna estensione aggiuntiva, nessun database.

---

### Navigazione

```
index.php  ──[pulsante Genera Personaggio]──►  generator.php
                                                      │
                                                api/generate.php
```

Il cheatsheet include un pulsante prominente "Genera Personaggio" che apre
il generatore mantenendo la lingua corrente.
