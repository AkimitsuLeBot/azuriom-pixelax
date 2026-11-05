<?php

namespace Azuriom\Support;

use Azuriom\Models\User;
use Azuriom\Plugin\Vote\Models\Site;
use Azuriom\Plugin\Vote\Verification\VoteChecker;
use Azuriom\Plugin\Vote\Verification\VoteVerifier;
use Illuminate\Support\Facades\Http;

/**
 * Pixelax: the vote plugin checks serveur-prive.net votes by IP only. On mobile data
 * the IP often changes between the vote and the check, so the vote is never found.
 * serveur-prive.net can also look up a recent vote by username, so we try the IPs
 * first (same behaviour as the plugin) and then the player's name.
 */
class PixelaxVoteChecker extends VoteChecker
{
    public function __construct()
    {
        parent::__construct();

        $this->register(VoteVerifier::for('serveur-prive.net')
            ->requireKey('api_key')
            ->verifyByCallback(function (User $user, Site $site, array $ips) {
                $url = 'https://serveur-prive.net/api/v1/servers/'.rawurlencode($site->verification_key).'/votes/';

                foreach (array_filter($ips) as $ip) {
                    if (Http::timeout(5)->get($url.rawurlencode($ip))->json('success') === true) {
                        return true;
                    }
                }

                return Http::timeout(5)
                    ->get($url.rawurlencode($user->name), ['type' => 'username'])
                    ->json('success') === true;
            }));
    }
}
