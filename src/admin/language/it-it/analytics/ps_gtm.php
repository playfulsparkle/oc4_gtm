<?php
// Heading
$_['heading_title']                = 'Playful Sparkle - Google Tag Manager';
$_['heading_getting_started']      = 'Inizio';
$_['heading_setup']                = 'Impostazione di Google Tag Manager';
$_['heading_troubleshot']          = 'Risoluzione dei problemi comuni';
$_['heading_faq']                  = 'Domande frequenti';
$_['heading_contact']              = 'Contatta il supporto';

// Text
$_['text_extension']                = 'Estensioni';
$_['text_edit']                     = 'Modifica Google Tag Manager';
$_['text_success']                  = 'Successo: Hai modificato Google Tag Manager!';
$_['text_group_ad_settings']        = 'Impostazioni pubblicitarie';
$_['text_group_analytics_settings'] = 'Impostazioni di analisi';
$_['text_group_security_settings']  = 'Impostazioni di sicurezza';
$_['text_group_advanced_settings']  = 'Impostazioni avanzate';
$_['text_getting_started']          = '<p><strong>Panoramica:</strong> L\'estensione Playful Sparkle - Google Tag Manager per OpenCart 4.x ti consente di gestire e distribuire facilmente i tag di marketing nel tuo negozio OpenCart senza alcuna competenza di programmazione. Con questa estensione, puoi semplificare la configurazione del tracciamento, migliorando l\'analisi e l\'efficienza del marketing.</p><p><strong>Requisiti:</strong> Assicurati di avere un account Google Tag Manager, un ID di misurazione valido e di utilizzare una versione compatibile di OpenCart 4.x+, PHP 7.4+.</p>';
$_['text_setup']                    = '<p><strong>Impostare Google Tag Manager:</strong> Accedi al tuo <a href="https://tagmanager.google.com" target="_blank" rel="noopener noreferrer">account Google Tag Manager</a>, crea un nuovo contenitore per il tuo sito web se non l\'hai già fatto, e recupera il tuo ID di misurazione. Quindi, inserisci questo ID nel campo designato nelle impostazioni dell\'estensione Playful Sparkle - Google Tag Manager nel tuo negozio OpenCart.</p>';
$_['text_troubleshot']              = '<ul><li><strong>Il formato dell’ID GTM non è corretto</strong><br>Il messaggio "Il formato dell’ID GTM non è corretto. Si assicuri che segua il formato GTM-XXXXXXXX." indica che l’ID del contenitore GTM inserito non corrisponde al formato richiesto.<br><strong>Soluzione:</strong> Acceda al suo account Google Tag Manager, apra il contenitore, copi l’ID del contenitore visualizzato nell’intestazione, quindi lo incolli nelle impostazioni dell’estensione.<br><strong>Verifica:</strong> L’ID deve iniziare con <strong>GTM-</strong> e, dopo il trattino, deve contenere solo lettere maiuscole e numeri.</li>
<li><strong>Manca &lt;noscript&gt;&lt;iframe&gt; sullo storefront</strong><br>Se lo snippet &lt;noscript&gt;&lt;iframe&gt; non è presente nel codice sorgente della pagina, la modifica potrebbe non essere stata applicata oppure la struttura del tema potrebbe non includere il tag richiesto.<br><strong>Soluzione:</strong><br>Verifichi il template del tema attivo e si assicuri che contenga un tag <strong>&lt;body&gt;</strong> valido. L’inserimento di GTM dipende da tale tag.<br><strong>Verifica:</strong> Apra lo storefront, visualizzi il codice sorgente, cerchi <strong>googletagmanager.com/ns.html</strong> e confermi che il blocco &lt;noscript&gt; sia presente.</li>
<li><strong>Nessun evento viene tracciato in GTM o GA</strong><br>Se il negozio si carica ma non vede hit, trigger o eventi in Google Tag Manager o Google Analytics, il tracciamento è generalmente bloccato da un ID GTM non valido o da un tag GA configurato in modo errato all’interno del contenitore GTM.<br><strong>Soluzione:</strong><ol><li>Confermi che l’ID GTM nell’estensione corrisponda esattamente all’ID del suo contenitore.</li><li>In Google Tag Manager, apra il contenitore e verifichi la configurazione di GA4.</li><li>Confermi che il <strong>Measurement ID</strong> (formato <strong>G-XXXXXXXXXX</strong>) sia corretto nelle impostazioni del tag GA4.</li><li>Utilizzi <strong>GTM Preview (Tag Assistant)</strong> per confermare che i tag vengano attivati alla visualizzazione pagina e sugli eventi.</li></ol><br><strong>Verifica:</strong> In GTM Preview dovrebbe vedere l’attivazione del tag GA. In GA Realtime o DebugView dovrebbe vedere utenti attivi o eventi di debug.</li></ul>';
$_['text_faq']                      = '<details><summary>Cosa fare se non vedo i miei tag attivarsi in Google Tag Manager?</summary>Assicurati che l\'ID di misurazione sia corretto e verifica che i tag siano pubblicati e configurati correttamente con i giusti trigger.</details><details><summary>Come posso verificare se l\'estensione sta funzionando?</summary>Utilizza l\'estensione <a href="https://tagassistant.google.com/" target="_blank" rel="noopener noreferrer">Google Tag Assistant</a> per Chrome o la modalità di anteprima in Google Tag Manager per confermare che i tuoi tag si attivano come previsto.</details><details><summary>Questa estensione è compatibile con altre estensioni?</summary>Anche se generalmente compatibile, si consiglia di testarla con altre estensioni installate sul tuo sito per evitare conflitti. Se riscontri problemi, verifica la presenza di eventuali problemi di compatibilità noti.</details><details><summary>Come risolvere i problemi comuni dei tag?</summary>Consulta la guida alla risoluzione dei problemi di Google Tag Manager per ottenere aiuto sui problemi comuni dei tag e le migliori pratiche per la configurazione.</details>';
$_['text_contact']                  = '<p>Per ulteriore assistenza, contatta il nostro team di supporto:</p><ul><li><strong>Contatto:</strong> <a href="mailto:%s">%s</a></li><li><strong>Documentazione:</strong> <a href="%s" target="_blank" rel="noopener noreferrer">Documentazione utente</a></li></ul>';
$_['text_gcm_info']                 = 'Per utilizzare questa funzionalità, assicurati di avere un banner dei cookie installato. Questa estensione imposta uno stato di consenso di base per impostazione predefinita, ma il banner dei cookie è responsabile dell\'aggiornamento del consenso per consentire la raccolta dei dati.';

// Tab
$_['tab_general']                   = 'Generale';
$_['tab_gcm']                       = 'Modalità di consenso Google (GCM)';
$_['tab_help_and_support']          = 'Aiuto e supporto';

// Entry
$_['entry_status']                  = 'Stato';
$_['entry_gtm_id']                  = 'ID di misurazione';
$_['entry_gcm_status']              = 'Abilita GCM';
$_['entry_ad_storage']              = 'Archiviazione pubblicitaria';
$_['entry_ad_user_data']            = 'Dati utenti pubblicitari';
$_['entry_ad_personalization']      = 'Personalizzazione pubblicitaria';
$_['entry_analytics_storage']       = 'Archiviazione analitica';
$_['entry_functionality_storage']   = 'Archiviazione funzionalità';
$_['entry_personalization_storage'] = 'Archiviazione personalizzazione';
$_['entry_security_storage']        = 'Archiviazione sicurezza';
$_['entry_wait_for_update']         = 'Attendi l\'aggiornamento';
$_['entry_ads_data_redaction']      = 'Redazione dei dati pubblicitari';
$_['entry_url_passthrough']         = 'Passaggio URL';
$_['entry_strict']                  = 'Rigoroso';
$_['entry_balanced']                = 'Bilanciato';
$_['entry_custom']                  = 'Personalizzato';
$_['entry_gcm_profiles']            = 'Profili GCM';

// Help
$_['help_ad_storage']               = 'Controlla se è consentito l\'archiviazione dei dati per scopi pubblicitari, come il tracciamento dei clic sugli annunci o delle conversioni.';
$_['help_ad_user_data']             = 'Determina se i dati sugli utenti che interagiscono con gli annunci vengono archiviati, migliorando le capacità di targeting pubblicitario.';
$_['help_ad_personalization']       = 'Consente di personalizzare gli annunci in base ai dati dell\'utente, fornendo pubblicità più rilevanti.';
$_['help_analytics_storage']        = 'Abilita l\'archiviazione dei dati per scopi analitici, aiutando a tracciare le prestazioni del sito e il comportamento degli utenti.';
$_['help_functionality_storage']    = 'Consente di archiviare i dati per supportare funzionalità, come preferenze utente o caratteristiche del sito che migliorano l\'esperienza utente.';
$_['help_personalization_storage']  = 'Controlla l\'archiviazione dei dati per personalizzare l\'esperienza dell\'utente, come contenuti o impostazioni consigliate.';
$_['help_security_storage']         = 'Garantisce l\'archiviazione dei dati relativi alla sicurezza, come la prevenzione delle frodi e il controllo dell\'accesso sicuro.';
$_['help_wait_for_update']          = 'Imposta il tempo (in millisecondi) da attendere prima di aggiornare lo stato del consenso, garantendo che tutte le impostazioni siano applicate.';
$_['help_ads_data_redaction']       = 'Redige i dati utente relativi agli annunci, garantendo la privacy nascondendo alcune informazioni identificabili.';
$_['help_url_passthrough']          = 'Permette al URL di passare attraverso i controlli del consenso, utile per tracciare percorsi specifici degli utenti senza archiviare dati personali.';
$_['help_gcm_status']               = 'Abilita la Modalità di Consenso Google, consentendo al tuo sito di regolare il comportamento dei tag di Google in base alle impostazioni di consenso dell\'utente. Questa modalità fornisce un tracciamento rispettoso della privacy, consentendo l\'analisi e la pubblicità in conformità con le preferenze di consenso.';
$_['help_gtm_id_locate']            = 'Per trovare il tuo Measurement ID per il tuo <a href="https://tagmanager.google.com" target="_blank" rel="external noopener noreferrer">account Google Tag Manager</a>, cerca l\'ID in cima alla dashboard del workspace: inizierà con "GTM-" seguito da una serie unica di lettere e numeri, come "GTM-XXXXXXXX". <a href="https://support.google.com/analytics/answer/12270356?hl=en" target="_blank" rel="external noopener noreferrer">Istruzioni dettagliate qui</a>.';

// Error
$_['error_permission']              = 'Attenzione: Non hai il permesso per modificare le impostazioni di Google Tag Manager!';
$_['error_gtm_id']                  = 'Il campo ID di misurazione è obbligatorio. Inserisci il tuo ID di misurazione.';
$_['error_gtm_id_invalid']          = 'Il formato dell\'ID di misurazione è errato. Assicurati che segua il formato GTM-XXXXXXXX.';
$_['error_wait_for_update']         = 'Il valore di Attendi l\'aggiornamento deve essere un numero compreso tra 0 e 10000 millisecondi.';
