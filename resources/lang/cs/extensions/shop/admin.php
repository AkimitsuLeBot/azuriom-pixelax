<?php

return [
    'nav' => [
        'title' => 'Obchod',
        'settings' => 'Nastavení',
        'packages' => 'Balíčky',
        'gateways' => 'Brány',
        'offers' => 'Akční nabídky',
        'coupons' => 'Kupóny',
        'giftcards' => 'Dárkové karty',
        'discounts' => 'Slevy',
        'payments' => 'Platby',
        'subscriptions' => 'Předplatná',
        'variables' => 'Proměnné',
        'purchases' => 'Objednávky',
        'statistics' => 'Statistiky',
    ],

    'permissions' => [
        'settings' => 'Správa nastavení obchodu',
        'packages' => 'Správa balíčků a kategorií obchodu',
        'gateways' => 'Správa platebních bran obchodu',
        'promotions' => 'Správa kuponů a slev obchodu',
        'giftcards' => 'Správa dárkových poukazů obchodu',
        'payments' => 'Vytváření a správa plateb/nákupů a předplatných v obchodě',
    ],

    'categories' => [
        'title' => 'Kategorie',
        'edit' => 'Upravit kategoriii :category',
        'create' => 'Vytvořit kategorii',

        'parent' => 'Nadřazená kategorie',
        'delete_error' => 'Kategorie s balíčky nemůže být odstraněna.',

        'cumulate' => 'Kumulovat nákupy v této kategorii',
        'cumulate_info' => 'Uživatelé, kteří si již zakoupili balíček v této kategorii, získají slevu a zaplatí pouze rozdíl při kupování dražšího balíčku.',
        'single_purchase' => 'Omezit uživateli nákup na jeden balíček z této kategorie',
        'enable' => 'Povolit kategorii',
    ],

    'offers' => [
        'title' => 'Akční nabídky',
        'edit' => 'Upravit nabídku :offer',
        'create' => 'Vytvořit nabídku',

        'enable' => 'Povolit tuto nabídku',
    ],

    'coupons' => [
        'title' => 'Kupóny',
        'edit' => 'Upravit kupón :coupon',
        'create' => 'Vytvořit kupón',

        'global' => 'Měl by být kupón aktivní po celém obchodě?',
        'cumulate' => 'Povolit použití tohoto kupónu s jinými kupóny',
        'user_limit' => 'Limit uživatelů',
        'global_limit' => 'Globální limit',
        'active' => 'Aktivní',
        'usage' => 'V limitu používání',
        'enable' => 'Povolit kupón',
    ],

    'giftcards' => [
        'title' => 'Dárkové karty',
        'edit' => 'Upravit dárkovou kartu :giftcard',
        'create' => 'Vytvořit dárkovou kartu',

        'global_limit' => 'Globální limit',
        'active' => 'Aktivní',
        'enable' => 'Povolit dárkovou kartu',
        'link' => 'Odkaz pro sdílení',
        'pending' => 'Platba čeká, zůstatek ještě nemusel být aktualizován.',
    ],

    'discounts' => [
        'title' => 'Slevy',
        'edit' => 'Upravit slevu :discount',
        'create' => 'Vytvořit slevu',

        'global' => 'Měla by být sleva aktivní po celém obchodě?',
        'active' => 'Aktivní',
        'enable' => 'Povolit slevu',
        'restricted' => 'Omezit tuto slevu pouze na určité role',
    ],

    'packages' => [
        'title' => 'Balíčky',
        'edit' => 'Upravit baklíček :package',
        'create' => 'Vytvořit balíček',

        'every' => 'každý',
        'after' => 'za',

        'updated' => 'Balíčky byly aktualizovány.',

        'variables' => 'Vlastní proměnné',
        'role' => 'Role k nastavení při vypršení balíčku',
        'money' => 'Peníze k udělení uživateli po nákupu',
        'has_giftcard' => 'Vytvořit dárkovou kartu po nákupu a dát ji uživateli',
        'giftcard_balance' => 'Zůstatek dárkové karty',
        'giftcard_fixed' => 'Pevná částka',
        'giftcard_dynamic' => 'Cena balíčku',
        'command' => 'Příkaz nesmí začínat znakem <code>/</code>. Pro jméno hráče můžete použít <code>{player}</code>. Pro hry ze služby Steam můžete použít také <code>{steam_id}</code> a <code>{steam_id_32}</code>. Další dostupné proměnné jsou: :placeholders.',
        'has_user_limit' => 'Přidat individuální limit nákupu na uživatele pro tento balíček',
        'has_global_limit' => 'Přidat globální limit nákupu pro tento balíček',
        'limit_period' => 'Limitní období',
        'limits_no_expired' => 'Při vypočítávání limitů nákupu vyloučit balíčky, které vypršely',
        'no_period' => 'Žádné období',
        'custom_price' => 'Umožnit uživateli zvolit si cenu (cena balíčku poté bude minimem)',
        'enable_quantity' => 'Povolit množství',

        'billing' => 'Typ fakturace',
        'billing_period' => 'Fakturační období',
        'one_off' => 'Jednorázová platba',
        'subscription' => 'Předplatné s automatickým obnovením',
        'subscription_info' => 'Ujistěte se, že vaše platební brána podporuje předplatné. Po vytvoření předplatného bude uživateli účtována stejná cena, dokud předplatné nezruší (případná sleva aktivní při první platbě se uplatní při dalších platbách).',
        'expiring' => 'Jednorázová platba s vypršením',
        'expiring_info' => 'Produkt bude po zadané době automaticky odstraněn.',
        'scheduler' => 'Pro používání předplatných musíte nastavit úlohy CRON, pro více informací viz <a href="https://azuriom.com/docs/faq" target="_blank" rel="noopener norefferer">často kladené dotazy</a>.',

        'create_category' => 'Vytvořit kategorii',
        'create_package' => 'Vytvořit balíček',

        'enable' => 'Povolit tento balíček',
    ],

    'commands' => [
        'online' => 'Před provedením příkazu počkejte, než bude hráč online (vyžaduje AzLink)',
        'offline' => 'Vykonat příkaz přímo, bez ohledu na to, zda je hráč online',
        'servers' => 'Pro vytvoření příkazu musíte přidat alespoň jeden server.',

        'trigger' => 'Spouštěč příkazu',
        'command' => 'Příkaz',
        'condition' => 'Podmínka k provedení příkazu',

        'triggers' => [
            'purchase' => 'Počáteční nákup',
            'expiration' => 'Po vypršení platnosti',
            'refund' => 'Platba vrácena',
            'chargeback' => 'Zpětné zúčtování',
            'renewal' => 'Obnovení předplatného',
        ],
    ],

    'gateways' => [
        'title' => 'Brány',
        'edit' => 'Úprava brány :gateway',
        'create' => 'Přidat bránu',

        'current' => 'Současné brány',
        'add' => 'Přidat novou bránu',
        'info' => 'Pokud máte problémy s platbou při používání Cloudflare nebo firewallu, zkuste následovat kroky v <a href="https://azuriom.com/docs/faq" target="_blank" rel="noopener norefferer">často kladených dotazech</a>.',

        'country' => 'Země',
        'sandbox' => 'Volný režim',
        'api-key' => 'Klíč API',
        'public-key' => 'Veřejný klíč',
        'private-key' => 'Soukromý klíč',
        'secret-key' => 'Tajný klíč',
        'endpoint-secret' => 'Podpisový klíč',
        'service-id' => 'ID služby',
        'client-id' => 'ID klienta',
        'merchant-id' => 'ID obchodníka',
        'project-id' => 'ID projektu',
        'webhook_id' => 'ID webhooku',
        'website_id' => 'ID webu',
        'env' => 'Prostředí',

        'subscription' => 'Tato platební brána podporuje automatické obnovení předplatného.',
        'no_subscription' => 'Tato platební brána nepodporuje automatické obnovení předplatného.',

        'paypal_email' => 'E-mailová adresa PayPal účtu',
        'paypal_info' => 'Ujistěte se, že zadáváte <strong>hlavní</strong> e-mailovou adresu účtu PayPal.',
        'paypal_checkout' => 'Ve vaší nástěnce PayPal v API aplikaci vytvořte webhook s adresou URL <code>:url</code> a vyberte události <code>:events</code>.',
        'stripe_info' => 'Ve vaší nástěnce Stripe nastavte adresu URL webhooku na <code>:url</code> a vyberte události: <code>:events</code>.',
        'paymentwall_info' => 'Na nástěnce PaymentWall musíte nastavit pingback URL na <code>:url</code>.',
        'xsolla' => 'Na nástěnce Xsolla musíte nastavit URL webhooku na <code>:url</code>, povolit \'Transaction external ID\' v nastavení \'Pay Station\', otestovat webhooky a poté povolit \'Checkout\' v nastavení \'Pay Station\'.',
        'skrill_email' => 'E-mailová adresa Skrill',
        'skrill_secret' => 'Tajné slovo',
        'skrill_info' => 'ID webu a tajné slovo lze nalézt v panelu Skrillu v kategorii „Vývojářská nastavení“.',

        'enable' => 'Povolit bránu',
    ],

    'payments' => [
        'title' => 'Platby',
        'show' => 'Platba č. :payment',

        'info' => 'Informace o platbě',
        'items' => 'Zakoupené položky',

        'card' => 'Platby v obchodě',

        'status' => [
            'pending' => 'Nevyřízeno',
            'expired' => 'Expirováno',
            'chargeback' => 'Zpětné zúčtování',
            'completed' => 'Dokončeno',
            'refunded' => 'Vráceno',
            'error' => 'Chyba',
        ],
    ],

    'purchases' => [
        'title' => 'Objednávky',
    ],

    'subscriptions' => [
        'title' => 'Předplatná',
        'show' => 'Předplatné #:subscription',

        'info' => 'Informace o předplatném',
        'error' => 'Pro pokračování musíte zrušit přidružená předplatná a počkat, než vyprší.',

        'status' => [
            'active' => 'Aktivní',
            'canceled' => 'Zrušené',
            'expired' => 'Vypršelo',
        ],
    ],

    'settings' => [
        'title' => 'Nastavení obchodu',
        'enable_home' => 'Povolit domovskou stránku obchodu',
        'home_message' => 'Zpráva na domovské obrazovce',
        'use_site_money' => 'Povolit nákupy pomocí měny webu.',
        'use_site_money_info' => 'Pokud je povoleno, lze si balíčky v obchodě zakoupit pouze pomocí webových peněz. Aby si uživatelé mohli připsat peníze na svůj účet, můžete nastavit nabídky v obchodě.',
        'webhook' => 'URL Discord webhooku',
        'webhook_info' => 'Když uživatel vykoná platbu, bude vytvořeno oznámení na tento webhook. Ponechte prázdné pro zakázání',
        'commands' => 'Globální příkazy',
        'recent_payments' => 'Limit nedávných plateb k zobrazení v postranní liště (nastavte na 0 pro zakázání)',
        'display_amount' => 'Zobrazit útratu v nedávných platbách a nejlepšího zákazníka',
        'top_customer' => 'Zobrazit nejlepšího měsíčního zákazníka v postranní liště',

        'terms_required' => 'Požadovat po uživatelích, aby před zakoupením přijali podmínky služby',
        'terms' => 'Podmínky služby',
        'terms_info' => 'Odkazy ve formátu Markdown, například: <code>Souhlasím s [obchodními podmínkami](https://example.com/terms).</code>',
    ],

    'variables' => [
        'title' => 'Proměnné',
        'edit' => 'Úprava proměnné :variable',
        'create' => 'Vytvořit proměnnou',

        'info' => 'Proměnné jsou vlastní pole, která lze přidat do balíčků. Lze je použít k tomu, abyste se při nákupu balíčku zeptali uživatele na další informace.',

        'name' => 'Interní název proměnné, nelze po vytvoření změnit.',
        'required' => 'Má být tato proměnná povinná?',
        'options' => 'Možnosti',

        'text' => 'Text',
        'number' => 'Číslo',
        'email' => 'E-mail',
        'checkbox' => 'Zaškrtávací pole',
        'dropdown' => 'Rozbalovací nabídka',
    ],

    'logs' => [
        'shop-gateways' => [
            'created' => 'Vytvořena brána #:id',
            'updated' => 'Upravena brána #:id',
            'deleted' => 'Odstraněna brána #:id',
        ],

        'shop-packages' => [
            'created' => 'Vytvořen balíček #:id',
            'updated' => 'Upraven balíček #:id',
            'deleted' => 'Odstraněn balíček #:id',
        ],

        'shop-offers' => [
            'created' => 'Vytvořena nabídka #:id',
            'updated' => 'Upravena nabídka #:id',
            'deleted' => 'Odstraněna nabídka #:id',
        ],

        'shop-giftcards' => [
            'used' => 'Použita dárková karta #:id (:amount)',
        ],
    ],

    'statistics' => [
        'title' => 'Statistiky',
        'total' => 'Celkem',
        'recent' => 'Nedávné platby',
        'count' => 'Počet plateb',
        'estimated' => 'Odhadované příjmy',
        'month' => 'Platby během tohoto měsíce',
        'month_estimated' => 'Odhadované příjmy tento měsíc',
    ],

];
