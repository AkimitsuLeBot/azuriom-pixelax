<?php

namespace Azuriom\Support;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Throwable;

/**
 * Pixelax Pokédex: data generated from the server's Cobblemon files (resources/data/pokedex),
 * plus the custom Pokémon and skins documented in the wiki (subcategories of
 * "pokemon-customs" and "skins"), which link to their wiki page.
 */
class Pokedex
{
    protected const WIKI_PARENTS = ['pokemon-customs' => 'custom', 'skins' => 'skin'];

    /**
     * Badge of a wiki entry: its category, in the singular (one card = one Pokémon).
     * Categories not listed here (One Piece, Sanrio, Battle pass Saison 1…) keep their name.
     */
    protected const CATEGORY_LABELS = [
        'pokemon-fusions' => 'Fusion',
        'pokemon-type-swap' => 'Type swap',
        'evolitions' => 'Évolition',
        'pokemon-bebes-legendaires' => 'Bébé légendaire',
        'evenements' => 'Événement',
        'autres' => 'Skin',
    ];

    protected static ?array $index = null;

    public static function path(string $file = ''): string
    {
        return resource_path('data/pokedex'.($file !== '' ? '/'.$file : ''));
    }

    public static function index(): array
    {
        if (static::$index !== null) {
            return static::$index;
        }

        return static::$index = json_decode(file_get_contents(static::path('index.json')), true);
    }

    public static function species(): array
    {
        return static::index()['species'];
    }

    public static function meta(): array
    {
        return static::index()['meta'];
    }

    public static function find(string $slug): ?array
    {
        if (! preg_match('/^[a-z0-9-]+$/', $slug)) {
            return null;
        }

        $file = static::path('species/'.$slug.'.json');

        return is_file($file) ? json_decode(file_get_contents($file), true) : null;
    }

    /**
     * URL of a Pokédex picture, with the version of the renders: the pictures are cached for 30 days
     * (Cloudflare and browsers), so a new render must get a new URL.
     */
    public static function image(string $path): string
    {
        return asset('img/pokedex/'.$path).static::imageVersion();
    }

    /**
     * Query string of the renders version (« ?v=… »), from version.txt written by the build scripts.
     */
    public static function imageVersion(): string
    {
        static $version = null;
        $version ??= trim((string) @file_get_contents(static::path('version.txt')));

        return $version !== '' ? '?v='.$version : '';
    }

    /**
     * Render of the Cobblemon model: 192 px, or the 128 px thumbnail for lists and small images.
     */
    public static function sprite(int|string|null $sprite, bool $small = false): ?string
    {
        return $sprite !== null ? static::image(($small ? 's/' : '').$sprite.'.webp') : null;
    }

    /**
     * Shiny render of the Cobblemon model, when the model has a shiny texture.
     */
    public static function shiny(int|string|null $sprite): ?string
    {
        if ($sprite === null || ! is_file(public_path('assets/img/pokedex/shiny/'.$sprite.'.webp'))) {
            return null;
        }

        return static::image('shiny/'.$sprite.'.webp');
    }

    /**
     * Entries shown after the Pokémon in the list: wiki customs and skins grouped by category,
     * with the custom Pokémon of the data (e.g. Thu-Fi-Zer) added to the group of the same badge.
     */
    public static function extraEntries(): array
    {
        $entries = static::wikiEntries();

        foreach (static::species() as $pokemon) {
            if (empty($pokemon['custom'])) {
                continue;
            }

            $group = collect($entries)->last(fn ($entry) => $entry['label'] === $pokemon['custom']);
            $entry = [
                'name' => $pokemon['name'],
                'kind' => 'custom',
                'group' => $group['group'] ?? 'Pokémon customs',
                'groupTitle' => $group['groupTitle'] ?? 'Pokémon customs',
                'label' => $pokemon['custom'],
                'url' => route('pokedex.show', $pokemon['slug']),
                'image' => static::sprite($pokemon['sprite'], true),
                'search' => Str::lower(Str::ascii($pokemon['name'].' '.($group['group'] ?? 'custom'))),
            ];
            $position = $group !== null ? array_search($group, $entries, true) + 1 : count($entries);
            array_splice($entries, $position, 0, [$entry]);
        }

        return $entries;
    }

    /**
     * Custom Pokémon and skins from the wiki, as Pokédex entries linking to their wiki page.
     */
    public static function wikiEntries(): array
    {
        return Cache::remember('pokedex.wiki.v3', now()->addMinutes(10), function () {
            try {
                if (! plugins()->isEnabled('wiki') || ! Schema::hasTable('wiki_pages')) {
                    return [];
                }

                $categoryClass = 'Azuriom\Plugin\Wiki\Models\Category';
                // Même ordre que le wiki : Pokémon customs puis Skins, chaque catégorie à sa position
                $categories = $categoryClass::with(['pages', 'parent'])->where('is_enabled', true)->get()
                    ->sortBy(fn ($category) => [$category->parent?->position ?? 0, $category->position])
                    ->values();
                $entries = [];

                foreach ($categories as $category) {
                    $parentSlug = $category->parent?->slug;
                    $kind = $parentSlug !== null ? (static::WIKI_PARENTS[$parentSlug] ?? null) : null;

                    if ($kind === null || $category->roles !== null || $category->parent->roles !== null || ! $category->parent->is_enabled) {
                        continue;
                    }

                    foreach ($category->pages as $page) {
                        // « Fusion entre Mewtwo & Lugulabre » : les deux Pokémon de la fusion
                        $text = html_entity_decode(strip_tags(str_replace('<', ' <', (string) $page->content)), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $components = preg_match('/Fusion entre\s+(.+?)\s*(?:&|\bet\b)\s*(.+?)\s*(?:Type\b|$|\s{2})/u', $text, $fusion)
                            ? [trim($fusion[1]), trim($fusion[2])] : [];

                        $entries[] = [
                            'name' => $page->title,
                            'kind' => $kind,
                            'category' => $category->slug,
                            'key' => static::key($page->slug),
                            'components' => $components,
                            'group' => $category->name,
                            'groupTitle' => $kind === 'skin' ? 'Skins · '.$category->name : $category->name,
                            'label' => static::CATEGORY_LABELS[$category->slug] ?? preg_replace('/^Pokémon\s+/u', '', $category->name),
                            'url' => route('wiki.pages.show', [$category, $page]),
                            'image' => static::firstImage((string) $page->content),
                            'search' => Str::lower(Str::ascii($page->title.' '.$category->name)),
                        ];
                    }
                }

                return $entries;
            } catch (Throwable $e) {
                report($e);

                return [];
            }
        });
    }

    /**
     * Length of the longest common substring of two keys ("polagriffe" / "tankgriffe" -> 6).
     */
    protected static function commonLength(string $a, string $b): int
    {
        $best = 0;
        $previous = array_fill(0, strlen($b) + 1, 0);
        for ($i = 1, $la = strlen($a); $i <= $la; $i++) {
            $current = [0];
            for ($j = 1, $lb = strlen($b); $j <= $lb; $j++) {
                $current[$j] = $a[$i - 1] === $b[$j - 1] ? $previous[$j - 1] + 1 : 0;
                $best = max($best, $current[$j]);
            }
            $previous = $current;
        }

        return $best;
    }

    /**
     * Comparison key: lowercase letters and digits only ("Pikachu Gros" -> "pikachugros").
     */
    public static function key(string $text): string
    {
        return preg_replace('/[^a-z0-9]/', '', Str::lower(Str::ascii($text)));
    }

    /**
     * Skins of the server resource pack, by species key: [{id, label, keys}].
     */
    public static function packSkins(): array
    {
        static $skins = null;

        return $skins ??= is_file(static::path('skins.json')) ? json_decode(file_get_contents(static::path('skins.json')), true) : [];
    }

    /**
     * The wiki page of a pack skin, if it has one: same name ("Pikachu Gros", "Laboolord"),
     * or the species' page in the Halloween / Évolitions categories.
     */
    protected static function wikiPageFor(array $skin): ?array
    {
        static $index = null;

        // Index des pages du wiki par clé (slug et titre), construit une fois par requête
        if ($index === null) {
            $index = ['keys' => [], 'halloween' => [], 'evolitions' => []];
            foreach (static::wikiEntries() as $entry) {
                $nameKey = static::key($entry['name']);
                $index['keys'][$entry['key']] ??= $entry;
                $index['keys'][$nameKey] ??= $entry;
                if (str_contains($entry['category'], 'halloween')) {
                    $index['halloween'][] = [$nameKey, $entry];
                }
                if ($entry['category'] === 'evolitions') {
                    $index['evolitions'][$nameKey] ??= $entry;
                }
            }
        }

        foreach ($skin['keys'] as $key) {
            if (str_starts_with($key, 'halloween:')) {
                $species = substr($key, 10);
                foreach ($index['halloween'] as [$nameKey, $entry]) {
                    if (str_starts_with($nameKey, $species)) {
                        return $entry;
                    }
                }
            } elseif (str_starts_with($key, 'franchise:')) {
                // « franchise:sanrio:pikachu:pikachu » : la page de la catégorie qui partage le plus long morceau
                // de nom (français ou anglais) avec le Pokémon, si elle est la seule (Kurochu, Tankgriffe…)
                [, $category, $fr, $en] = array_pad(explode(':', $key, 4), 4, '');
                $scores = [];
                foreach (static::wikiEntries() as $entry) {
                    if ($entry['category'] === $category) {
                        $title = static::key($entry['name']);
                        $scores[] = [max(static::commonLength($fr, $title), static::commonLength($en, $title)), $entry];
                    }
                }
                usort($scores, fn ($a, $b) => $b[0] <=> $a[0]);
                if (isset($scores[0]) && $scores[0][0] >= 3 && (! isset($scores[1]) || $scores[1][0] < $scores[0][0])) {
                    return $scores[0][1];
                }
            } elseif (str_starts_with($key, 'evolition:')) {
                if (isset($index['evolitions'][substr($key, 10)])) {
                    return $index['evolitions'][substr($key, 10)];
                }
            } elseif (isset($index['keys'][$key])) {
                return $index['keys'][$key];
            }
        }

        return null;
    }

    /**
     * Skins, custom versions and fusions of a species, for its page: renders of the pack skins (with their
     * wiki page when there is one), then wiki pages of the same Pokémon (type swap, Évolitions, bébés…)
     * and the fusions made with it.
     */
    public static function variantsFor(array $pokemon): array
    {
        $name = static::key($pokemon['name']);
        $used = [];
        $variants = [];

        foreach (static::packSkins()[$pokemon['key']] ?? [] as $skin) {
            $page = static::wikiPageFor($skin);
            if ($page !== null) {
                $used[] = $page['url'];
            }
            $variants[] = [
                'name' => $page['name'] ?? $pokemon['name'].' '.$skin['label'],
                'group' => $page !== null ? $page['label'] : 'Skin',
                'url' => $page['url'] ?? null,
                'image' => static::image('skins/s/'.$skin['id'].'.webp'),
            ];
        }

        foreach (static::wikiEntries() as $entry) {
            if (in_array($entry['url'], $used, true)) {
                continue;
            }
            $entryName = static::key($entry['name']);
            $components = array_map([static::class, 'key'], $entry['components'] ?? []);
            $related = $entryName === $name                                     // type swap, Évolitions
                || $entryName === 'bebe'.$name                                  // Bébé Keldeo
                || ($entry['kind'] === 'skin' && str_starts_with($entryName, $name) && $entryName !== $name)
                || in_array($name, $components, true);                          // fusions avec ce Pokémon
            if ($related) {
                $variants[] = [
                    'name' => $entry['name'],
                    'group' => in_array($name, $components, true) ? 'Fusion' : $entry['label'],
                    'url' => $entry['url'],
                    'image' => static::wikiRenders()[$entry['url']] ?? $entry['image'],
                ];
            }
        }

        return $variants;
    }

    /**
     * Render of a pack skin for each wiki page that has one (keyed by page URL), to show the Cobblemon
     * render in the list instead of the wiki picture.
     */
    public static function wikiRenders(): array
    {
        static $renders = null;

        if ($renders !== null) {
            return $renders;
        }

        $renders = [];

        // Pokémon customs du pack (fusions, type swap, bébés…) : rendu Cobblemon à la place de l'image du wiki
        $customs = is_file(static::path('customs.json')) ? json_decode(file_get_contents(static::path('customs.json')), true) : [];
        foreach (static::wikiEntries() as $entry) {
            $key = $entry['category'] === 'pokemon-type-swap' ? 'swap:'.static::key($entry['name']) : null;
            $file = ($key !== null ? ($customs[$key] ?? null) : null) ?? $customs[$entry['key']] ?? $customs[static::key($entry['name'])] ?? null;
            if ($file !== null) {
                $renders[$entry['url']] = static::image('custom/s/'.$file.'.webp');
            }
        }

        foreach (static::packSkins() as $speciesKey => $skins) {
            foreach ($skins as $skin) {
                $page = static::wikiPageFor($skin);
                if ($page !== null) {
                    $renders[$page['url']] ??= static::image('skins/s/'.$skin['id'].'.webp');
                }
            }
        }

        return $renders;
    }

    protected static function firstImage(string $html): ?string
    {
        if (! preg_match('/<img\b[^>]*\ssrc\s*=\s*["\']([^"\']+)["\']/i', $html, $match)) {
            return null;
        }

        $src = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');

        if (str_starts_with($src, '/') && ! str_starts_with($src, '//')) {
            return $src;
        }

        return preg_match('#^https://#i', $src) ? $src : null;
    }
}
