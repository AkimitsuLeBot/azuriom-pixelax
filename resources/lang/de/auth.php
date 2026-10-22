<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'Diese Zugangsdaten wurden nicht in unserer Datenbank gefunden.',
    'throttle' => 'Zu viele Anmeldeversuche. Versuche es bitte in :seconds Sekunden nochmal.',

    'register' => 'Registrieren',
    'login' => 'Anmelden',
    'logout' => 'Abmelden',
    'verify' => 'Bestätige deine E-Mail-Adresse',
    'passwords' => [
        'confirm' => 'Passwort bestätigen',
        'reset' => 'Passwort zurücksetzen',
        'send' => 'Link zum Zurücksetzen des Passworts senden',
    ],
    'fpc' => [
        'title' => 'Erzwungene Passwortänderung',
        'line1' => 'Dein Konto wurde aus Sicherheitsgründen vorübergehend gesperrt. Um die Sperre aufzuheben, ändere bitte dein Passwort.',
        'line2' => 'Wenn du weitere Informationen benötigst oder Probleme mit der Freischaltung deines Kontos hast, wende dich bitte an den Administrator der Website.',
        'action' => 'Mein Passwort ändern',
    ],
    'name' => 'Benutzername',
    'email' => 'E-Mail-Adresse',
    'password' => 'Passwort',
    'confirm_password' => 'Passwort bestätigen',
    'current_password' => 'Aktuelles Passwort',

    'conditions' => 'Ich akzeptiere die  <a href=":url" target="_blank">Bedingungen </a>.',

    '2fa' => [
        'code' => 'Zwei-Faktor-Authentifizierungscode',
        'invalid' => 'Ungültiger Code',
    ],

    'suspended' => 'Dieses Konto ist gesperrt.',

    'maintenance' => 'Die Webseite wird gerade gewartet.',

    'remember' => 'Angemeldet bleiben',
    'forgot_password' => 'Hast Du Dein Passwort vergessen?',

    'verification' => [
        'sent' => 'Ein neuer Bestätigungslink wurde an deine E-Mail-Adresse gesendet.',
        'check' => 'Bevor du fortfährst, überprüfe bitte deine E-Mail auf einen Bestätigungslink.',
        'request' => 'Wenn du die E-Mail nicht erhalten hast, kannst du eine weitere anfordern.',
        'resend' => 'E-Mail erneut senden',
    ],

    'confirmation' => 'Bitte bestätige dein Passwort, bevor du fortfährst.',

    'mail' => [
        'reset' => [
            'subject' => 'Benachrichtigung zum Zurücksetzen des Passworts',
            'line1' => 'Du erhältst diese E-Mail, weil wir eine Anfrage zum Zurücksetzen des Passworts für dein Konto erhalten haben.',
            'action' => 'Passwort zurücksetzen',
            'line2' => 'Dieser Link zum Zurücksetzen des Passworts läuft in :count Minuten ab.',
            'line3' => 'Wenn du kein Zurücksetzen des Passworts angefordert hast, sind keine weiteren Handlungen nötig.',
        ],

        'verify' => [
            'subject' => 'E-Mail-Adresse bestätigen',
            'line1' => 'Bitte klicke auf die Schaltfläche unten, um deine E-Mail-Adresse zu bestätigen. Dieser Link ist :count Minuten gültig.',
            'action' => 'E-Mail-Adresse bestätigen',
            'line2' => 'Wenn du kein Konto erstellt hast, sind keine weiteren Handlungen nötig.',
        ],
    ],
];
