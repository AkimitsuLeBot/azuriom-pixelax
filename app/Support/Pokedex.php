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
     * Render of the Cobblemon model: 192 px, or the 128 px thumbnail for lists and small images.
     */
    public static function sprite(int|string|null $sprite, bool $small = false): ?string
    {
        return $sprite !== null ? asset('img/pokedex/'.($small ? 's/' : '').$sprite.'.webp') : null;
    }

    /**
     * Shiny render of the Cobblemon model, when the model has a shiny texture.
     */
    public static function shiny(int|string|null $sprite): ?string
    {
        if ($sprite === null || ! is_file(public_path('assets/img/pokedex/shiny/'.$sprite.'.webp'))) {
            return null;
        }

        return asset('img/pokedex/shiny/'.$sprite.'.webp');
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
        return Cache::remember('pokedex.wiki.v2', now()->addMinutes(10), function () {
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
                        $entries[] = [
                            'name' => $page->title,
                            'kind' => $kind,
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
     * Skins documented in the wiki for a species, e.g. "Pikachu Gros" for Pikachu.
     */
    public static function skinsFor(string $name): array
    {
        $prefix = Str::lower(Str::ascii($name)).' ';

        return array_values(array_filter(static::wikiEntries(), function (array $entry) use ($prefix) {
            return $entry['kind'] === 'skin' && str_starts_with(Str::lower(Str::ascii($entry['name'])), $prefix);
        }));
    }

    /**
     * Evolitions-like custom pages named exactly like the species (e.g. "Nymphali" in "Évolitions").
     */
    public static function customVariantsFor(string $name): array
    {
        $needle = Str::lower(Str::ascii($name));

        return array_values(array_filter(static::wikiEntries(), function (array $entry) use ($needle) {
            return $entry['kind'] === 'custom' && Str::lower(Str::ascii($entry['name'])) === $needle;
        }));
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
