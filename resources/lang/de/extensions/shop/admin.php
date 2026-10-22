<?php

return [
    'nav' => [
        'title' => 'Shop',
        'settings' => 'Einstellungen',
        'packages' => 'Pakete',
        'gateways' => 'Zahlungsmittel',
        'offers' => 'Angebote',
        'coupons' => 'Gutscheine',
        'giftcards' => 'Geschenkkarten',
        'discounts' => 'Rabatte',
        'payments' => 'Zahlungen',
        'subscriptions' => 'Abonnements',
        'variables' => 'Variablen',
        'purchases' => 'Einkäufe',
        'statistics' => 'Statistiken',
    ],

    'permissions' => [
        'settings' => 'Shop-Einstellungen verwalten',
        'packages' => 'Shop-Pakete und Kategorien verwalten',
        'gateways' => 'Shop-Zahlungs-Gateways verwalten',
        'promotions' => 'Shop-Gutscheine und Rabatte verwalten',
        'giftcards' => 'Shop-Geschenkkarten verwalten',
        'payments' => 'Shop-Zahlungen/Einkäufe und Abonnements erstellen und anzeigen',
    ],

    'categories' => [
        'title' => 'Kategorien',
        'edit' => 'Kategorie :category bearbeiten',
        'create' => 'Kategorie erstellen',

        'parent' => 'Übergeordnete Kategorie',
        'delete_error' => 'Eine Kategorie mit Paketen kann nicht gelöscht werden.',

        'cumulate' => 'Käufe in dieser Kategorie kumulieren',
        'cumulate_info' => 'Benutzer, die bereits ein Paket dieser Kategorie gekauft haben, erhalten einen Rabatt und zahlen beim Kauf eines teureren Pakets nur die Differenz.',
        'single_purchase' => 'Beschränke den Nutzer auf den Kauf eines einzigen Pakets aus dieser Kategorie',
        'enable' => 'Kategorie aktivieren',
    ],

    'offers' => [
        'title' => 'Angebote',
        'edit' => 'Angebot :offer bearbeiten',
        'create' => 'Angebot erstellen',

        'enable' => 'Dieses Angebot aktivieren',
    ],

    'coupons' => [
        'title' => 'Gutscheine',
        'edit' => 'Gutschein :coupon bearbeiten',
        'create' => 'Gutschein erstellen',

        'global' => 'Soll der Gutschein im gesamten Shop aktiv sein?',
        'cumulate' => 'Erlauben, diesen Gutschein mit anderen Gutscheinen zu verwenden',
        'user_limit' => 'Benutzerlimit',
        'global_limit' => 'Globales Limit',
        'active' => 'Aktiv',
        'usage' => 'Unter Nutzungsgrenze',
        'enable' => 'Gutschein aktivieren',
    ],

    'giftcards' => [
        'title' => 'Geschenkkarten',
        'edit' => 'Die Geschenkkarte :giftcard bearbeiten',
        'create' => 'Eine Geschenkkarte erstellen',

        'global_limit' => 'Globale Grenze',
        'active' => 'Aktiv',
        'enable' => 'Geschenkkarte aktivieren',
        'link' => 'Link zum Teilen',
        'pending' => 'Eine Zahlung ist noch ausstehend, der Kontostand wurde möglicherweise noch nicht aktualisiert.',
    ],

    'discounts' => [
        'title' => 'Rabatte',
        'edit' => 'Rabatt :discount bearbeiten',
        'create' => 'Rabatt erstellen',

        'global' => 'Soll der Rabatt im gesamten Shop aktiv sein?',
        'active' => 'Aktiv',
        'enable' => 'Rabatt aktivieren',
        'restricted' => 'Diesen Rabatt nur auf bestimmte Rollen beschränken',
    ],

    'packages' => [
        'title' => 'Pakete',
        'edit' => 'Paket :package bearbeiten',
        'create' => 'Paket erstellen',

        'every' => 'jedes',
        'after' => 'nach',

        'updated' => 'Die Pakete wurden aktualisiert.',

        'variables' => 'Benutzerdefinierte Variablen',
        'role' => 'Zu setzende Rolle, wenn das Paket abläuft',
        'money' => 'Geld, das der Nutzer nach dem Kauf erhält',
        'has_giftcard' => 'Erstelle nach dem Kauf eine Geschenkkarte und gib sie dem Nutzer',
        'giftcard_balance' => 'Guthaben der Geschenkkarte',
        'giftcard_fixed' => 'Fester Betrag',
        'giftcard_dynamic' => 'Preis des Pakets',
        'command' => 'Der Befehl darf nicht mit <code>/</code> beginnen. Du kannst <code>{player}</code> für den Spielernamen verwenden. Für Steam-Spiele kannst du zudem <code>{steam_id}</code> und <code>{steam_id_32}</code> verwenden. Die anderen verfügbaren Platzhalter sind: :Platzhalter.',
        'has_user_limit' => 'Füge ein individuelles Kauflimit pro Benutzer für dieses Paket hinzu',
        'has_global_limit' => 'Füge ein globales Kauflimit für dieses Paket hinzu',
        'limit_period' => 'Zeitraum begrenzen',
        'limits_no_expired' => 'Abgelaufene Pakete bei der Berechnung der Kauflimits ausschließen',
        'no_period' => 'Kein Zeitraum',
        'custom_price' => 'Erlaube dem Nutzer, den zu zahlenden Preis zu wählen (der Paketpreis ist dann das Minimum)',
        'enable_quantity' => 'Menge aktivieren',

        'billing' => 'Abrechnungsart',
        'billing_period' => 'Abrechnungszeitraum',
        'one_off' => 'Einmalige Zahlung',
        'subscription' => 'Abonnement mit automatischer Erneuerung',
        'subscription_info' => 'Vergewissere dich, dass dein Zahlungsgateway Abonnements unterstützt. Wenn ein Abonnement erstellt wird, wird dem Nutzer derselbe Preis berechnet, bis das Abonnement gekündigt wird (jeder Rabatt, der bei der ersten Zahlung aktiv ist, wird auf die nächsten Zahlungen angewendet).',
        'expiring' => 'Einmalige Zahlung mit Ablaufdatum',
        'expiring_info' => 'Das Produkt wird nach dem angegebenen Zeitraum automatisch entfernt.',
        'scheduler' => 'Du musst CRON Tasks einrichten, um Abonnements zu verwenden. Weitere Informationen findest du in den <a href=„https://azuriom.com/docs/faq“ target=„_blank“ rel=„noopener norefferer“>FAQ</a>.',

        'create_category' => 'Kategorie erstellen',
        'create_package' => 'Paket erstellen',

        'enable' => 'Paket aktivieren',
    ],

    'commands' => [
        'online' => 'Warten, bis der Spieler online ist, bevor der Befehl ausgeführt wird (benötigt AzLink)',
        'offline' => 'Führe den Befehl direkt aus, egal ob der Spieler online ist oder nicht',
        'servers' => 'Du musst mindestens einen Server hinzufügen, um einen Befehl zu erstellen.',

        'trigger' => 'Befehlsauslöser',
        'command' => 'Befehl',
        'condition' => 'Bedingung für die Ausführung des Befehls',

        'triggers' => [
            'purchase' => 'Erstmaliger Kauf',
            'expiration' => 'Nach Ablauf',
            'refund' => 'Rückerstattete Zahlung',
            'chargeback' => 'Rückbuchung',
            'renewal' => 'Verlängerung des Abonnements',
        ],
    ],

    'gateways' => [
        'title' => 'Gateways',
        'edit' => 'Gateway :gateway bearbeiten',
        'create' => 'Gateway hinzufügen',

        'current' => 'Aktuelle Gateways',
        'add' => 'Neues Gateway hinzufügen',
        'info' => 'Wenn du Probleme mit Zahlungen hast, wenn du Cloudflare oder eine Firewall verwendest, versuche es mit den Schritten in der <a href="https://azuriom.com/docs/faq" target="_blank" rel="noopener norefferer">FAQ</a>.',

        'country' => 'Land',
        'sandbox' => 'Testmodus',
        'api-key' => 'API-Schlüssel',
        'public-key' => 'Öffentlicher Schlüssel',
        'private-key' => 'Privater Schlüssel',
        'secret-key' => 'Geheimer Schlüssel',
        'endpoint-secret' => 'Unterzeichnung Geheimnis',
        'service-id' => 'Service-ID',
        'client-id' => 'Kunden-ID',
        'merchant-id' => 'Händler-ID',
        'project-id' => 'Projekt-ID',
        'webhook_id' => 'Webhook-ID',
        'website_id' => 'Website ID',
        'env' => 'Umgebung',

        'subscription' => 'Dieses Zahlungsgateway unterstützt automatische Abonnementverlängerung.',
        'no_subscription' => 'Dieses Zahlungsgateway unterstützt keine automatische Abonnementverlängerung.',

        'paypal_email' => 'PayPal-E-Mail-Adresse',
        'paypal_info' => 'Bitte stelle sicher, dass du die <strong>Haupt</strong>-E-Mail-Adresse deines PayPal-Kontos eingibst.',
        'paypal_checkout' => 'Erstelle auf dem PayPal-Dashboard in deiner API-Anwendung einen Webhook mit der URL <code>:url</code> und wähle die Events <code>:events</code> aus.',
        'stripe_info' => 'Auf dem Stripe Dashboard musst Du die Webhook-URL auf <code>:url</code> setzen und die Events <code>:events</code> auswählen.',
        'paymentwall_info' => 'Auf dem PaymentWall-Dashboard musst Du die Pingback-URL auf <code>:url</code>.',
        'xsolla' => 'Im Xsolla-Dashboard musst du die Webhook-URL auf <code>:url</code> setzen, in den Einstellungen für \'Pay Station\' die Option \'Transaction external ID\' aktivieren, die Webhooks testen und dann in der \'Pay Station\' die Einstellungen für \'Checkout\' aktivieren.',
        'skrill_email' => 'Skrill E-Mail-Adresse',
        'skrill_secret' => 'Geheimwort',
        'skrill_info' => 'Die Website-ID und das Geheimwort findest Du im Dashboard unter "Entwickler Einstellungen".',

        'enable' => 'Gateway aktivieren',
    ],

    'payments' => [
        'title' => 'Zahlungen',
        'show' => 'Zahlung #:payment',

        'info' => 'Zahlungsinformationen',
        'items' => 'Gekaufte Artikel',

        'card' => 'Shop-Zahlungen',

        'status' => [
            'pending' => 'Ausstehend',
            'expired' => 'Abgelaufen',
            'chargeback' => 'Rückbuchung',
            'completed' => 'Abgeschlossen',
            'refunded' => 'Zurückerstattet',
            'error' => 'Fehler',
        ],
    ],

    'purchases' => [
        'title' => 'Einkäufe',
    ],

    'subscriptions' => [
        'title' => 'Abonnements',
        'show' => 'Abonnement #:subscription',

        'info' => 'Abonnementinformationen',
        'error' => 'Um fortzufahren, musst du die zugehörigen Abonnements kündigen und auf deren Ablauf warten.',

        'status' => [
            'active' => 'Aktiv',
            'canceled' => 'Storniert',
            'expired' => 'Abgelaufen',
        ],
    ],

    'settings' => [
        'title' => 'Shop-Einstellungen',
        'enable_home' => 'Startseite des Shops aktivieren',
        'home_message' => 'Startseiten-Nachricht',
        'use_site_money' => 'Käufe mit der Site-Währung ermöglichen.',
        'use_site_money_info' => 'Wenn aktiviert, können die Pakete im Shop nur mit Website-Geld gekauft werden. Damit Nutzer ihr Konto gutschreiben können, kannst du Angebote im Shop einrichten.',
        'webhook' => 'Discord Webhook URL',
        'webhook_info' => 'Wenn ein Benutzer eine Zahlung leistet, erstellt er eine Benachrichtigung auf diesem Webhook. Zum Deaktivieren leer lassen',
        'commands' => 'Globale Befehle',
        'recent_payments' => 'Limit für letzte Zahlungen zur Anzeige in der Seitenleiste (zum Deaktivieren auf 0 setzen)',
        'display_amount' => 'Anzeige der Ausgaben der letzten Zahlungen und des Top-Kunden',
        'top_customer' => 'Monatlichen Top-Kunden in der Seitenleiste anzeigen',

        'terms_required' => 'Benutzer müssen vor dem Kauf die Nutzungsbedingungen akzeptieren',
        'terms' => 'Nutzungsbedingungen',
        'terms_info' => 'Links im Markdown Format, zum Beispiel: <code>Ich akzeptiere die [Nutzungsbedingungen](https://example.com/terms) des Shops.</code>',
    ],

    'variables' => [
        'title' => 'Variablen',
        'edit' => 'Variable :variable bearbeiten',
        'create' => 'Variable erstellen',

        'info' => 'Variablen sind benutzerdefinierte Felder, die zu Paketen hinzugefügt werden können. Sie können verwendet werden, um zusätzliche Informationen vom Benutzer beim Kauf eines Pakets zu verlangen.',

        'name' => 'Der interne Name der Variablen kann nach der Erstellung nicht geändert werden.',
        'required' => 'Solle diese Variable zwingend erforderlich sein?',
        'options' => 'Optionen',

        'text' => 'Text',
        'number' => 'Nummer',
        'email' => 'E-Mail',
        'checkbox' => 'Auswahlfeld',
        'dropdown' => 'Auswahlliste',
    ],

    'logs' => [
        'shop-gateways' => [
            'created' => 'Gateway erstellt #:id',
            'updated' => 'Gateway aktualisiert #:id',
            'deleted' => 'Gateway gelöscht #:id',
        ],

        'shop-packages' => [
            'created' => 'Erstelltes Paket #:id',
            'updated' => 'Paket aktualisiert #:id',
            'deleted' => 'Paket gelöscht #:id',
        ],

        'shop-offers' => [
            'created' => 'Erstelltes Angebot #:id',
            'updated' => 'Aktualisierte Angebotsnummer #:id',
            'deleted' => 'Gelöschtes Angebot #:id',
        ],

        'shop-giftcards' => [
            'used' => 'Verwendete Geschenkkarte #:id (:amount)',
        ],
    ],

    'statistics' => [
        'title' => 'Statistiken',
        'total' => 'Gesamt',
        'recent' => 'Letzte Zahlungen',
        'count' => 'Anzahl Zahlungen',
        'estimated' => 'Geschätzte Einnahmen',
        'month' => 'Zahlungen in diesem Monat',
        'month_estimated' => 'Geschätzte Einnahmen in diesem Monat',
    ],

];
