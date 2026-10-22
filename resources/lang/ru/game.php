<?php

return [
    'fivem' => [
        'id' => 'Cfx.re ID',
        'name' => 'Cfx.re ник',
        'commands' => 'Вы можете использовать <code>{name}</code> для имени пользователя, <code>{id}</code> для ID, <code>{fivem_id}</code> для Cfx.re ID, <code>{steam_id}</code> для SteamID 64 и <code>{steam_hex}</code> для HEX Steam ID',
    ],

    'steam' => [
        'id' => 'SteamID 64',
        'commands' => 'Вы можете использовать <code>{name}</code> для имени пользователя, <code>{steam_id}</code> для игрока SteamID 64 и <code>{steam_id_32}</code> для игрока SteamID 32.',
    ],

    'epic' => [
        'id' => 'Epic Games ID',
        'commands' => 'Вы можете использовать <code>{name}</code> для имени игрока и <code>{game_id}</code> для ID игрока Epic Games.',
    ],

    'xbox' => [
        'missing' => 'Эта учётная запись Microsoft не подключена к профилю Xbox.',
    ],

    'minecraft' => [
        'id' => 'UUID',
        'missing' => 'Эта учётная запись Xbox не привязана к профилю Minecraft.',
        'child' => 'Эта учетная запись является ребенком (в возрасте до 18 лет) и должна быть добавлена в семью взрослым, чтобы войти в систему.',
        'commands' => 'Вы можете использовать <code>{name}</code> для имени игрока и <code>{uuid}</code> для UUID игрока',
    ],

    'minecraft_bedrock' => [
        'id' => 'XUID',
        'commands' => 'Вы можете использовать <code>{name}</code> для имени игрока и <code>{xuid}</code> для XUID игрока',
    ],
];
