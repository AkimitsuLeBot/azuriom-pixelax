<?php

return [
    'title' => 'Установка',

    'welcome' => 'Azuriom — <strong>новое поколение</strong> игровых CMS. <strong>Бесплатная</strong> и <strong>с открытым исходным кодом</strong>, а также <strong>современная, надёжная, быстрая и безопасная</strong> альтернатива существующим CMS, с которой у вас будет <strong>настолько приятный опыт, насколько возможно</strong>.',

    'back' => 'Назад',

    'requirements' => [
        'php' => 'PHP :version или новее',
        'writable' => 'Права на запись',
        'rewrite' => 'Включена перезапись URL',
        'extension' => 'Расширение :extension',
        'function' => 'Включена функция :function',
        '64bit' => 'PHP 64-бит',

        'refresh' => 'Обновить требования',
        'success' => 'Azuriom готов к конфигурации!',
        'missing' => 'Ваш сервер не поддерживает требования к установке Azuriom.',

        'help' => [
            'writable' => 'Попробуйте эту команду для выдачи прав на запись: <code>:command</code>.',
            'rewrite' => 'Следуйте инструкциям в <a href="https://azuriom.com/docs/installation" target="_blank" rel="noopener noreferrer">нашей документации</a> для включение перезаписи URL.',
            'htaccess' => 'Файл <code>.htaccess</code> или <code>public/.htaccess</code> отсутствует. Убедитесь в том, что вы включили скрытые файлы и в том, что файл существует.',
            'extension' => 'Попробуйте эту команду, чтобы установить недостающие расширения PHP: <code>:command</code>.<br>После этого, перезагрузите Apache или Nginx.',
            'function' => 'Для включения этой функции необходимо поменять значение <code>disable_functions</code> в файле php.ini.',
        ],
    ],

    'database' => [
        'title' => 'База данных',

        'type' => 'Тип',
        'host' => 'Адрес',
        'port' => 'Порт',
        'database' => 'База данных',
        'user' => 'Пользователь',
        'password' => 'Пароль',

        'warn' => 'Эта база данных не рекомендуется и должна использоваться тогда, когда нет других вариантов.',
    ],

    'game' => [
        'title' => 'Игра',

        'locale' => 'Язык',

        'warn' => 'Будьте внимательны, после завершения установки невозможно изменить игру или способ входа в систему без полной переустановки Azuriom!',

        'install' => 'Установить',

        'user' => [
            'title' => 'Учётная запись администратора',

            'name' => 'Имя пользователя',
            'email' => 'Email-адрес',
            'password' => 'Пароль',
            'password_confirm' => 'Подтвердите пароль',
        ],

        'minecraft' => [
            'premium' => 'Войти через Microsoft (самый безопасный способ, необходима лицензия Minecraft)',
        ],

        'steam' => [
            'profile' => 'Ссылка на профиль Steam',
            'profile_info' => 'Эта учётная запись Steam будет администратором сайта.',

            'key' => 'Ключ Steam API',
            'key_info' => 'Найти ключ Steam API можно <a href="https://steamcommunity.com/dev/apikey" target="_blank" rel="noopener noreferrer">на этой странице</a>.',
        ],

        'epic' => [
            'id' => 'Epic ID вашего аккаунта',
            'id_info' => 'Этот пользователь будет администратором на сайте. Вы можете найти свой Epic ID в<a href="https://www.epicgames.com/account/personal" target="_blank" rel="noopener noreferrer">Личном о кабинете Epic Games</a>.',

            'client_id' => 'ID клиента Epic Games',
            'client_secret' => 'Секрет клиента Epic Games',

            'steps' => 'Чтобы получить ID клиента и секрет клиента, выполните следующие действия:',
            'step_1' => 'Откройте <a href="https://dev.epicgames.com/portal/" target="_blank" rel="noopener noreferrer">портал разработчика Epic Games</a> и создайте новый продукт.',
            'step_2' => 'В настройках продукта во вкладке "Клиент" создайте нового клиента с типом политики "GameClient" с перенаправлением на следующий URL: <code>:redirect</code>',
            'step_3' => 'ID Клиента и Секрет Вы можете найти в настройках клиента (Эдит справа от клиента).',
        ],
    ],

    'success' => [
        'thanks' => 'Спасибо за выбор Azuriom!',
        'success' => 'Ваш сайт был успешно установлен, теперь вы можете его использовать и создать что-то прекрасное!',
        'go' => 'Начать',
        'support' => 'Если вам нравится Azuriom и то, что мы делаем, пожалуйста, не забудьте <a href="https://azuriom.com/support-us" target="_blank" rel="noopener noreferrer">поддержать нас</a>.',
    ],
];
