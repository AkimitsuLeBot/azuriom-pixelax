<?php

return [
    'fivem' => [
        'id' => 'Cfx.re ID',
        'name' => 'Cfx.re username',
        'commands' => 'You can use <code>{name}</code> for the username, <code>{id}</code> for the ID, <code>{fivem_id}</code> for Cfx.re ID, <code>{steam_id}</code> for the SteamID 64 and <code>{steam_hex}</code> for the HEX Steam ID',
    ],

    'steam' => [
        'id' => 'SteamID 64',
        'commands' => '<code>{name}</code>를 플레이어 닉네임으로, <code>{steam_id}</code>를 플레이어 SteamID 64로, <code>{steam_id_32}</code>를 플레이어 SteamID 32로 사용할 수 있습니다.',
    ],

    'epic' => [
        'id' => 'Epic Games ID',
        'commands' => 'You can use <code>{name}</code> for the player username and <code>{game_id}</code> for the player Epic Games ID.',
    ],

    'xbox' => [
        'missing' => '이 마이크로소프트 계정은 Xbox 프로필을 갖고있지 않습니다.',
    ],

    'minecraft' => [
        'id' => 'UUID',
        'missing' => '이 Xbox 계정은 마인크래프트 프로필을 갖고있지 않습니다.',
        'child' => 'This account is a child (under 18) and must be added to a family by an adult in order to login.',
        'commands' => '<code>{name}</code>를 플레이어 닉네임으로, <code>{uuid}</code>를 플레이어 UUID로 사용할 수 있습니다.',
    ],

    'minecraft_bedrock' => [
        'id' => 'XUID',
        'commands' => '<code>{name}</code>를 플레이어 닉네임으로, <code>{xuid}</code>를 플레이어 XUID로 사용할 수 있습니다.',
    ],
];
