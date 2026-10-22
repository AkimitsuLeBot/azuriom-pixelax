<?php

return [
    'title' => 'Toko',
    'welcome' => 'Selamat datang!',

    'buy' => 'Beli',

    'free' => 'Gratis',

    'periods' => [
        'hours' => 'hours',
        'days' => 'days',
        'weeks' => 'weeks',
        'months' => 'months',
        'years' => 'years',
    ],

    'fields' => [
        'balance' => 'Balance',
        'category' => 'Kategori',
        'code' => 'Kode',
        'commands' => 'Perintah',
        'currency' => 'Mata uang',
        'discount' => 'Diskon',
        'expire_date' => 'Sampai tanggal',
        'gateways' => 'Gateway',
        'global_limit' => 'Global purchase limit',
        'original_balance' => 'Original Balance',
        'package' => 'Paket',
        'packages' => 'Paket',
        'payment_id' => 'ID Pembayaran',
        'payments' => 'Payments',
        'price' => 'Harga',
        'quantity' => 'Kuantitas',
        'renewal_date' => 'Renewal date',
        'required' => 'Required',
        'required_packages' => 'Required packages',
        'required_roles' => 'Role dibutuhkan',
        'role' => 'Peran yang akan ditetapkan setelah pembelian',
        'start_date' => 'Mulai tanggal',
        'subscription' => 'Subscription',
        'subscription_id' => 'Subscription ID',
        'total' => 'Jumlah',
        'user_id' => 'ID Pengguna',
        'user_limit' => 'Batas pembelian pengguna',
    ],

    'actions' => [
        'subscribe' => 'Subscribe',
        'move' => 'Move',
    ],

    'goal' => [
        'title' => 'Target bulan ini',
        'progress' => ':count% selesai',
    ],

    'recent' => [
        'title' => 'Pembayaran Terakhir',
        'empty' => 'Tidak ada pembayaran terakhir',
    ],

    'top' => [
        'title' => 'Top user',
    ],

    'cart' => [
        'title' => 'Troli',
        'success' => 'Pembelian kamu berhasil diselesaikan.',
        'guest' => 'Kamu harus login untuk melakukan pembelian.',
        'empty' => 'Troli kamu kosong.',
        'checkout' => 'Lanjut ke pembayaran',
        'clear' => 'Bersihkan troli',
        'pay' => 'Bayar',
        'back' => 'Kembali ke toko',
        'total' => 'Jumlah: :total',
        'payable_total' => 'Total to pay: :total',
        'credit' => 'Kredit',

        'confirm' => [
            'title' => 'Bayar?',
            'price' => 'Apa kamu yakin ingin membeli semua yang ada di troli ini dengan harga :price.',
        ],

        'errors' => [
            'money' => 'Kamu tidak memiliki cukup uang untuk melakukan pembelian ini.',
            'execute' => 'Terjadi kesalahan saat proses pembayaran, pembelianmu mendapatkan refund.',
        ],
    ],

    'coupons' => [
        'title' => 'Kupon',
        'add' => 'Tambah kupon',
        'error' => 'Kupon ini tidak ada, kawaluwarsa, atau tidak dapat digunakan lagi.',
        'cumulate' => 'Kamu tidak dapat menggukan kupon ini dengan kupon lain.',
    ],

    'payment' => [
        'title' => 'Pembayaran',
        'manual' => 'Pembayaran manual',

        'empty' => 'Tidak ada metode pembayaran yang tersedia.',

        'info' => 'Membeli #:id di :website',
        'subscription' => ':package - Subscription (User #:user)',
        'error' => 'Pembayaran tidak dapat diselesaikan.',

        'success' => 'Pembayaran berhasil, kamu akan mendapatkan barang didalam game kurang dari satu menit.',
        'pending' => 'Payment pending, you\'ll receive your purchase in-game once the payment is confirmed.',

        'webhook' => 'Pembayaran baru di toko',
        'webhook_info' => 'Total: :total, ID: :id (:gateway)',
        'webhook_chargeback' => 'Payment chargeback on the shop',
        'webhook_refund' => 'Payment refund on the shop',
    ],

    'categories' => [
        'empty' => 'Kategori ini kosong.',
    ],

    'packages' => [
        'limit' => 'Kamu telah membeli semaksimal mungkin untuk paket ini.',
        'requirements' => 'Kamu tidak memiliki persyaratan untuk membeli paket ini.',
        'cumulate' => 'You cannot buy this package with an other from the same category in the same purchase.',
    ],

    'offers' => [
        'gateway' => 'Jenis pembayaran',
        'amount' => 'Jumlah',

        'empty' => 'Tidak ada promo yang tersedia saat ini.',
    ],

    'profile' => [
        'payments' => 'Pembayaran kamu',
        'subscriptions' => 'Your subscriptions',
        'money' => 'Uang: :balance',
    ],

    'giftcards' => [
        'title' => 'Giftcards',
        'error' => 'Giftcard ini tidak ada, kedaluwarsa, atau tidak dapat digunakan lagi.',
        'add' => 'Add a gift card',
        'notification' => 'You received a giftcard, the code is :code (:balance).',
        'pending' => 'A payment has already started for this giftcard. Complete the payment or wait a few minutes.',
    ],
];
