<?php

return [
    'title' => 'Shop',
    'welcome' => 'Willkommen im Shop!',

    'buy' => 'Kaufen',

    'free' => 'Kostenlos',

    'periods' => [
        'hours' => 'stunden',
        'days' => 'tage',
        'weeks' => 'wochen',
        'months' => 'monate',
        'years' => 'jahre',
    ],

    'fields' => [
        'balance' => 'Bilanz',
        'category' => 'Kategorie',
        'code' => 'Code',
        'commands' => 'Befehle',
        'currency' => 'Währung',
        'discount' => 'Rabatt',
        'expire_date' => 'Ablaufdatum',
        'gateways' => 'Zahlungsmittel',
        'global_limit' => 'Globales Kauflimit',
        'original_balance' => 'Ursprüngliche Bilanz',
        'package' => 'Paket',
        'packages' => 'Pakete',
        'payment_id' => 'Zahlungs-ID',
        'payments' => 'Zahlungen',
        'price' => 'Preis',
        'quantity' => 'Anzahl',
        'renewal_date' => 'Datum der Verlängerung',
        'required' => 'Erforderlich',
        'required_packages' => 'Erforderliche Pakete',
        'required_roles' => 'Erforderliche Rolle',
        'role' => 'Nach Kauf zu setzende Rolle',
        'start_date' => 'Anfangsdatum',
        'subscription' => 'Abonnement',
        'subscription_id' => 'Abonnement-ID',
        'total' => 'Gesamt',
        'user_id' => 'Benutzer-ID',
        'user_limit' => 'Kauflimit für Benutzer',
    ],

    'actions' => [
        'subscribe' => 'Abonnieren',
        'move' => 'Verschieben',
    ],

    'goal' => [
        'title' => 'Ziel des Monats',
        'progress' => ':count% abgeschlossen',
    ],

    'recent' => [
        'title' => 'Letzte Zahlungen',
        'empty' => 'Keine kürzlichen Zahlungen',
    ],

    'top' => [
        'title' => 'Top Kunde',
    ],

    'cart' => [
        'title' => 'Warenkorb',
        'success' => 'Dein Kauf wurde erfolgreich abgeschlossen.',
        'guest' => 'Du musst angemeldet sein, um einen Kauf tätigen zu können.',
        'empty' => 'Dein Warenkorb ist leer.',
        'checkout' => 'Zur Kasse',
        'clear' => 'Warenkorb leeren',
        'pay' => 'Zahlen',
        'back' => 'Zurück zum Shop',
        'total' => 'Gesamt: :total',
        'payable_total' => 'Zu zahlender Gesamtbetrag: :total',
        'credit' => 'Guthaben',

        'confirm' => [
            'title' => 'Bezahlen?',
            'price' => 'Bist Du sicher, dass Du diesen Wagen für :price kaufen möchtest.',
        ],

        'errors' => [
            'money' => 'Du hast nicht genug Guthaben, um diesen Kauf zu tätigen.',
            'execute' => 'Während der Zahlung ist ein unerwarteter Fehler aufgetreten, Dein Kauf wurde erstattet.',
        ],
    ],

    'coupons' => [
        'title' => 'Gutscheine',
        'add' => 'Gutschein hinzufügen',
        'error' => 'Dieser Gutschein existiert nicht, ist abgelaufen oder kann nicht mehr verwendet werden.',
        'cumulate' => 'Du kannst diesen Coupon nicht mit einem anderen Coupon verwenden.',
    ],

    'payment' => [
        'title' => 'Zahlung',
        'manual' => 'Manuelle Zahlung',

        'empty' => 'Derzeit sind keine Zahlungsmethoden verfügbar.',

        'info' => 'Kauf #:id auf :website',
        'subscription' => ':package - Abonnement (Benutzer #:user)',
        'error' => 'Die Zahlung konnte nicht abgeschlossen werden.',

        'success' => 'Nach Abschluss der Zahlung erhälst Du Deinen Kauf in weniger als einer Minute im Spiel.',
        'pending' => 'Die Zahlung steht noch aus. Du erhältst deinen Kauf im Spiel, sobald die Zahlung bestätigt wurde.',

        'webhook' => 'Neue Zahlung im Shop',
        'webhook_info' => 'Gesamt: :total, ID: :id (:gateway)',
        'webhook_chargeback' => 'Zahlungsrückbuchung im Shop',
        'webhook_refund' => 'Zahlungserstattung im Shop',
    ],

    'categories' => [
        'empty' => 'Diese Kategorie ist leer.',
    ],

    'packages' => [
        'limit' => 'Du hast das maximal mögliche für diese Pakete gekauft.',
        'requirements' => 'Du hast nicht die Voraussetzungen, um dieses Paket zu kaufen.',
        'cumulate' => 'Du kannst dieses Paket nicht mit einem anderen aus der gleichen Kategorie zusammen kaufen.',
    ],

    'offers' => [
        'gateway' => 'Zahlungsart',
        'amount' => 'Menge',

        'empty' => 'Derzeit sind keine Angebote verfügbar.',
    ],

    'profile' => [
        'payments' => 'Deine Zahlungen',
        'subscriptions' => 'Deine Abonnements',
        'money' => 'Guthaben: :balance',
    ],

    'giftcards' => [
        'title' => 'Geschenkkarten',
        'error' => 'Dieser Gutschein existiert nicht, ist abgelaufen oder kann nicht mehr verwendet werden.',
        'add' => 'Eine Geschenkkarte hinzufügen',
        'notification' => 'Du hast eine Geschenkkarte erhalten, der Code lautet :code (:balance).',
        'pending' => 'Es wurde bereits eine Zahlung für diese Geschenkkarte gestartet. Schließe die Zahlung ab oder warte ein paar Minuten.',
    ],
];
