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
            'wikiEntries' => Pokedex::wikiEntries(),
        ]);
    }

    /**
     * Show the full sheet of a Pokémon: spawns, evolutions, stats, moves...
     */
    public function show(string $slug)
    {
        $pokemon = Pokedex::find($slug);

        abort_if($pokemon === null, 404);

        $list = Pokedex::species();
        $position = array_search($slug, array_column($list, 'slug'), true);

        return view('pokedex.show', [
            'pokemon' => $pokemon,
            'meta' => Pokedex::meta(),
            'previous' => $position > 0 ? $list[$position - 1] : null,
            'next' => $list[$position + 1] ?? null,
            'skins' => Pokedex::skinsFor($pokemon['name']),
            'variants' => Pokedex::customVariantsFor($pokemon['name']),
        ]);
    }
}
