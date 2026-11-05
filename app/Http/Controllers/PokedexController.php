<?php

namespace Azuriom\Http\Controllers;

use Azuriom\Support\Pokedex;

class PokedexController extends Controller
{
    /**
     * Show every Pokémon of the server, with search and filters.
     */
    public function index()
    {
        return view('pokedex.index', [
            'species' => Pokedex::species(),
            'meta' => Pokedex::meta(),
            'wikiEntries' => Pokedex::extraEntries(),
        ]);
    }

    /**
     * Show the full sheet of a Pokémon: spawns, evolutions, stats, moves...
     */
    public function show(string $slug)
    {
        $pokemon = Pokedex::find($slug);

        abort_if($pokemon === null, 404);

        // Précédent / suivant : seulement les Pokémon numérotés (pas les customs comme Thu-Fi-Zer)
        $list = array_values(array_filter(Pokedex::species(), fn (array $pokemon) => empty($pokemon['custom'])));
        $position = array_search($slug, array_column($list, 'slug'), true);

        return view('pokedex.show', [
            'pokemon' => $pokemon,
            'meta' => Pokedex::meta(),
            'previous' => $position !== false && $position > 0 ? $list[$position - 1] : null,
            'next' => $position !== false ? ($list[$position + 1] ?? null) : null,
            'variants' => Pokedex::variantsFor($pokemon),
        ]);
    }
}
