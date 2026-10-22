<?php

return [
    'nav' => [
        'title' => 'Toko',
        'settings' => 'Pengaturan',
        'packages' => 'Paket',
        'gateways' => 'Gateaway',
        'offers' => 'Promo',
        'coupons' => 'Kupon',
        'giftcards' => 'Gift Card',
        'discounts' => 'Diskon',
        'payments' => 'Pembayaran',
        'subscriptions' => 'Subscriptions',
        'variables' => 'Variables',
        'purchases' => 'Pembelian',
        'statistics' => 'Statistik',
    ],

    'permissions' => [
        'settings' => 'Manage shop settings',
        'packages' => 'Manage shop packages and categories',
        'gateways' => 'Manage shop payment gateways',
        'promotions' => 'Manage shop coupons and discounts',
        'giftcards' => 'Manage shop gift cards',
        'payments' => 'Create and view shop payments/purchases and subscriptions',
    ],

    'categories' => [
        'title' => 'Kategori',
        'edit' => 'Edit kategori :category',
        'create' => 'Buat kategori',

        'parent' => 'Induk Kategori',
        'delete_error' => 'Kategori dengan paket tidak dapat dihapus.',

        'cumulate' => 'Hitung pembelian di kategori ini',
        'cumulate_info' => 'User yang sudah membeli paket pada kategori ini akan mendapatkan diskon dan hanya akan membayar selisih jika pembelian paket lebih mahal.',
        'single_purchase' => 'Limit the user to purchasing a single package from this category',
        'enable' => 'Aktifkan kategori',
    ],

    'offers' => [
        'title' => 'Promo',
        'edit' => 'Edit promo :offer',
        'create' => 'Buat promo',

        'enable' => 'Aktifkan promo ini',
    ],

    'coupons' => [
        'title' => 'Kupon',
        'edit' => 'Edit kupon :coupon',
        'create' => 'Buat kupon',

        'global' => 'Haruskah kupon aktif di semua toko?',
        'cumulate' => 'Ijinkan menggunakan kupon ini dengan kupon lainnya',
        'user_limit' => 'Batas pengguna',
        'global_limit' => 'Batas global',
        'active' => 'Aktif',
        'usage' => 'Under usage limit',
        'enable' => 'Aktifkan kupon',
    ],

    'giftcards' => [
        'title' => 'Gift Card',
        'edit' => 'Edit gift card :giftcard',
        'create' => 'Buat gift card',

        'global_limit' => 'Limitasi Global',
        'active' => 'Aktif',
        'enable' => 'Aktifkan gift card',
        'link' => 'Shareable link',
        'pending' => 'A payment is pending, the balance might not be updated yet.',
    ],

    'discounts' => [
        'title' => 'Diskon',
        'edit' => 'Edit diskon :discount',
        'create' => 'Buat diskon',

        'global' => 'Apakah diskon harus aktif di semua toko?',
        'active' => 'Aktif',
        'enable' => 'Aktifkan diskon',
        'restricted' => 'Restrict this discount to certain roles only',
    ],

    'packages' => [
        'title' => 'Paket',
        'edit' => 'Edit paket :package',
        'create' => 'Buat paket',

        'every' => 'every',
        'after' => 'after',

        'updated' => 'Paket telah di perbarui.',

        'variables' => 'Custom variables',
        'role' => 'Role to set when the package expires',
        'money' => 'Money to give to the user after purchase',
        'has_giftcard' => 'Create a giftcard after the purchase and give it to the user',
        'giftcard_balance' => 'Giftcard balance',
        'giftcard_fixed' => 'Fixed amount',
        'giftcard_dynamic' => 'Price of the package',
        'command' => 'The command must not start with <code>/</code>. You can use <code>{player}</code> for the player name. For Steam games, you can also use <code>{steam_id}</code> and <code>{steam_id_32}</code>. The others available placeholders are: :placeholders.',
        'has_user_limit' => 'Add an individual purchase limit per user for this package',
        'has_global_limit' => 'Add a global purchase limit for this package',
        'limit_period' => 'Limit period',
        'limits_no_expired' => 'Exclude expired packages when calculating purchase limits',
        'no_period' => 'No period',
        'custom_price' => 'Allow the user to choose the price to pay (the package price will then be the minimum)',
        'enable_quantity' => 'Aktifkan Qty',

        'billing' => 'Billing type',
        'billing_period' => 'Billing period',
        'one_off' => 'One-off payment',
        'subscription' => 'Subscription with automatic renewal',
        'subscription_info' => 'Make sure your payment gateway supports subscriptions. When a subscription is created, the user will be charged the same price until the subscription is canceled (any discount active during the first payment will be applied to the next payments).',
        'expiring' => 'One-off payment with expiration',
        'expiring_info' => 'The product will be automatically removed after the specified period.',
        'scheduler' => 'You must set up CRON tasks to use subscriptions, see the <a href="https://azuriom.com/docs/faq" target="_blank" rel="noopener norefferer">FAQ</a> for more information.',

        'create_category' => 'Buat kategori',
        'create_package' => 'Buat paket',

        'enable' => 'Aktifkan paket ini',
    ],

    'commands' => [
        'online' => 'Wait for the player to be online before executing the command (requires AzLink)',
        'offline' => 'Execute the command directly, whether the player is online or not',
        'servers' => 'You need to add at least one server to create a command.',

        'trigger' => 'Command trigger',
        'command' => 'Command',
        'condition' => 'Condition to execute the command',

        'triggers' => [
            'purchase' => 'Initial Purchase',
            'expiration' => 'After Expiration',
            'refund' => 'Payment Refunded',
            'chargeback' => 'Chargeback',
            'renewal' => 'Subscription Renewal',
        ],
    ],

    'gateways' => [
        'title' => 'Gateaway',
        'edit' => 'Edit gateway :gateway',
        'create' => 'Tambah gateway',

        'current' => 'Gateway sekarang',
        'add' => 'Tambah gateway baru',
        'info' => 'Jika kamu mendapati masalah dengan pembayaran ketika memakai Cloudflare atau firewall, coba ikuti beberapa langkah pada <a href="https://azuriom.com/docs/faq" target="_blank" rel="noopener norefferer">FAQ</a>.',

        'country' => 'Negara',
        'sandbox' => 'Sandbox',
        'api-key' => 'API key',
        'public-key' => 'Public key',
        'private-key' => 'Private key',
        'secret-key' => 'Secret key',
        'endpoint-secret' => 'Signing Secret',
        'service-id' => 'Service ID',
        'client-id' => 'Client ID',
        'merchant-id' => 'Merchant ID',
        'project-id' => 'Project ID',
        'webhook_id' => 'Webhook ID',
        'website_id' => 'Website ID',
        'env' => 'Environment',

        'subscription' => 'This payment gateway supports automatic subscription renewal.',
        'no_subscription' => 'This payment gateway does not support automatic subscription renewal.',

        'paypal_email' => 'Alamat Email PayPal',
        'paypal_info' => 'Please make sure to input the <strong>primary</strong> email address of the PayPal account.',
        'paypal_checkout' => 'On the PayPal dashboard, in your API application, create a webhook with URL <code>:url</code> and select the events <code>:events</code>.',
        'stripe_info' => 'On the Stripe dashboard you need to set the webhook URL to <code>:url</code> and select the events: <code>:events</code>.',
        'paymentwall_info' => 'Di dasbor PaymentWall kamu perlu mengatur URL pingback ke <code>:url</code>.',
        'xsolla' => 'Di dasbor Xsolla kamu perlu mengatur URL webhook ke <code>:url</code>, aktifkan \'Transaction external ID\' di pengaturan \'Pay station\', uji coba webhooks dan aktifkan \'Checkout di pengaturan \'Pay Station\'.',
        'skrill_email' => 'Skrill Email Address',
        'skrill_secret' => 'Secret Word',
        'skrill_info' => 'The website ID and the Secret Word can be found in the Skrill dashboard under "Developer Settings".',

        'enable' => 'Aktifkan gateway',
    ],

    'payments' => [
        'title' => 'Pembayaran',
        'show' => 'Pembayaran #:payment',

        'info' => 'Informasi pembayaran',
        'items' => 'Item yang dibeli',

        'card' => 'Pembayaran toko',

        'status' => [
            'pending' => 'Tertunda',
            'expired' => 'Kadaluwarsa',
            'chargeback' => 'Chargeback',
            'completed' => 'Selesai',
            'refunded' => 'Dikembalikan',
            'error' => 'Error',
        ],
    ],

    'purchases' => [
        'title' => 'Pembelian',
    ],

    'subscriptions' => [
        'title' => 'Subscriptions',
        'show' => 'Subscription #:subscription',

        'info' => 'Subscription information',
        'error' => 'To continue, you must cancel associated subscriptions and wait for their expiration.',

        'status' => [
            'active' => 'Active',
            'canceled' => 'Canceled',
            'expired' => 'Expired',
        ],
    ],

    'settings' => [
        'title' => 'Pengaturan toko',
        'enable_home' => 'Aktifkan halaman depan toko',
        'home_message' => 'Pesan halaman depan',
        'use_site_money' => 'Aktifkan pembelian dengan mata uang website.',
        'use_site_money_info' => 'Jika aktif, paket pada toko akan hanya bisa dibeli menggunakan uang virtual. Untuk meminta user memiliki saldo di akun mereka, kamu bisa memberikan penawaran di toko.',
        'webhook' => 'Discord Webhook URL',
        'webhook_info' => 'Saat pengguna melakukan pembayaran, notifikasi akan dibuat di webhook ini. Biarkan kosong untuk menonaktifkan',
        'commands' => 'Perintah global',
        'recent_payments' => 'Limit tampilan pembayaran terakhir di sidear (set ke 0 untuk menonaktifkan)',
        'display_amount' => 'Display amount spend in recent payments and top customer',
        'top_customer' => 'Tampilkan top user bulanan pada sidebar',

        'terms_required' => 'Require users to accept terms of service before purchase',
        'terms' => 'Terms of service',
        'terms_info' => 'Links in Markdown format, for example: <code>I accept the [terms of service](https://example.com/terms) of the shop.</code>',
    ],

    'variables' => [
        'title' => 'Variables',
        'edit' => 'Edit variable :variable',
        'create' => 'Create variable',

        'info' => 'Variables are custom fields that can be added to packages. They can be used to ask for additional information from the user when purchasing a package.',

        'name' => 'The internal name of the variable, cannot be changed after creation.',
        'required' => 'Should this variable be required?',
        'options' => 'Options',

        'text' => 'Text',
        'number' => 'Number',
        'email' => 'E-Mail',
        'checkbox' => 'Checkbox',
        'dropdown' => 'Dropdown',
    ],

    'logs' => [
        'shop-gateways' => [
            'created' => 'Gateway dibuat #:id',
            'updated' => 'Gateway diperbarui #:id',
            'deleted' => 'Gateway dihapus #:id',
        ],

        'shop-packages' => [
            'created' => 'Paket dibuat #:id',
            'updated' => 'Paket diperbarui #:id',
            'deleted' => 'Paket dihapus #:id',
        ],

        'shop-offers' => [
            'created' => 'Promo dibuat #:id',
            'updated' => 'Promo diperbarui #:id',
            'deleted' => 'Promo dihapus #:id',
        ],

        'shop-giftcards' => [
            'used' => 'Used giftcard #:id (:amount)',
        ],
    ],

    'statistics' => [
        'title' => 'Statistik',
        'total' => 'Jumlah',
        'recent' => 'Pembayaran terakhir',
        'count' => 'Jumlah pembayaran',
        'estimated' => 'Perkiraan pendapatan',
        'month' => 'Pembayaran selama bulan ini',
        'month_estimated' => 'Estimasi penghasilan bulan ini',
    ],

];
