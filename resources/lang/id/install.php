<?php

return [
    'title' => 'Pemasangan',

    'welcome' => 'Azuriom adalah CMS game <strong>generasi baru</strong>, <strong>gratis</strong> dan <strong>opensource</strong>, dan merupakan <strong>modern, handal, cepat, dan aman< /strong> alternatif dari CMS yang ada sehingga kamu dapat memiliki <strong>pengalaman web terbaik</strong>.',

    'back' => 'Kembali',

    'requirements' => [
        'php' => 'PHP :version atau diatasnya',
        'writable' => 'Ijin Write',
        'rewrite' => 'URL rewrite diaktifkan',
        'extension' => 'Ekstensi :extension',
        'function' => 'Fungsi :function diaktifkan',
        '64bit' => '64-bit PHP',

        'refresh' => 'Segarkan persyaratan',
        'success' => 'Azuriom sudah siap untuk di konfigurasi!',
        'missing' => 'Server kamu tidak memenuhi persyaratan untuk memasang Azuriom.',

        'help' => [
            'writable' => 'Kamu bisa mencoba perintah ini untuk memberi akses ijin write: <code>:command</code>.',
            'rewrite' => 'Kamu dapat mengikuti petunjuk di <a href="https://azuriom.com/docs/installation" target="_blank" rel="noopener noreferrer">dokumentasi kami</a> untuk mengaktifkan penulisan ulang URL.',
            'htaccess' => 'File <code>.htaccess</code> atau <code>public/.htaccess</code> tidak ada. Pastikan kamu telah mengaktifkan file tersembunyi dan file tersebut ada.',
            'extension' => 'Kamu dapat mencoba perintah ini untuk menginstal ekstensi PHP yang hilang: <code>:command</code>.<br>Setelah selesai, restart Apache atau Nginx.',
            'function' => 'Kamu perlu mengaktifkan fungsi ini di file php.ini PHP dengan mengedit nilai <code>disable_functions</code>.',
        ],
    ],

    'database' => [
        'title' => 'Database',

        'type' => 'Jenis',
        'host' => 'Host',
        'port' => 'Port',
        'database' => 'Database',
        'user' => 'Pengguna',
        'password' => 'Kata Sandi',

        'warn' => 'Jenis database ini tidak disarankan dan hanya boleh digunakan jika tidak memungkinkan untuk melakukan sebaliknya.',
    ],

    'game' => [
        'title' => 'Permainan',

        'locale' => 'Bahasa',

        'warn' => 'Be careful, once the installation is finished it will not be possible to change the game or login method without reinstalling Azuriom entirely!',

        'install' => 'Pasang',

        'user' => [
            'title' => 'Akun admin',

            'name' => 'Nama',
            'email' => 'Alamat E-Mail',
            'password' => 'Kata Sandi',
            'password_confirm' => 'Konfirmasi kata sandi',
        ],

        'minecraft' => [
            'premium' => 'Masuk dengan akun Microsoft (paling aman tetapi harus membeli Minecraft)',
        ],

        'steam' => [
            'profile' => 'Steam Profil URL',
            'profile_info' => 'Pengguna Steam ini akan menjadi admin untuk situs ini.',

            'key' => 'Kunci Steam API',
            'key_info' => 'Kamu dapat menemukan Kunci API Steam di <a href="https://steamcommunity.com/dev/apikey" target="_blank" rel="noopener noreferrer">Steam</a>.',
        ],

        'epic' => [
            'id' => 'Epic ID of your account',
            'id_info' => 'This user will be admin on the site. You can find your Epic ID on your <a href="https://www.epicgames.com/account/personal" target="_blank" rel="noopener noreferrer">Epic Games account</a>.',

            'client_id' => 'Epic Games Client ID',
            'client_secret' => 'Epic Games Client Secret',

            'steps' => 'To get the Client ID and Client Secret, follow these steps:',
            'step_1' => 'Go on the <a href="https://dev.epicgames.com/portal/" target="_blank" rel="noopener noreferrer">Epic Games Developer Portal</a> and create a new product.',
            'step_2' => 'In the product settings, in the "Clients" tab, create a new client with the "GameClient" policy type and the following redirect URL: <code>:redirect</code>',
            'step_3' => 'You can find the Client ID and Client Secret in the client settings (Edit on the right of the client).',
        ],
    ],

    'success' => [
        'thanks' => 'Terima kasih sudah memilih Azuriom !',
        'success' => 'Website kamu telah berhasil terpasang, sekarang kamu dapat menggunakan website kamu dan membuat sesuatu yang luar biasa!',
        'go' => 'Memulai',
        'support' => 'Jika kamu menghargai Azuriom dan karya yang kami berikan, jangan lupa untuk <a href="https://azuriom.com/support-us" target="_blank" rel="noopener noreferrer">dukung kami</a >.',
    ],
];
