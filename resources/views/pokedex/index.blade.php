@extends('layouts.app')

@section('title', 'Pokédex')
@section('full_title', 'Pokédex Cobblemon : spawns, évolutions et stats de tous les Pokémon | Pixelax')
@section('description', 'Pokédex du serveur Minecraft Cobblemon Pixelax : où trouver chaque Pokémon (biomes, rareté, niveaux), évolutions, talents, statistiques, objets, légendaires, Pokémon customs et skins.')

@php
    $dexTypes = $meta['types'];
    unset($dexTypes['stellar']);
    $dexAscii = fn (string $text) => \Illuminate\Support\Str::lower(\Illuminate\Support\Str::ascii($text));
    $dexCategories = ['legendary' => 'Légendaire', 'mythical' => 'Fabuleux', 'ultra_beast' => 'Ultra-Chimère', 'paradox' => 'Paradoxe'];

    // Construit dans @php : hors de ce bloc, Blade prendrait "@context" pour une directive
    $dexJsonLd = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => trans('messages.home'), 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Pokédex', 'item' => route('pokedex.index')],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
@endphp

@push('meta')
    <script type="application/ld+json">{!! $dexJsonLd !!}</script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pokedex.css') }}?v={{ filemtime(public_path('assets/css/pokedex.css')) }}">
@endpush

@section('content')
    <div class="px-dex">
        <div class="banner">
            <div class="banner-title no-image">
                <h1>Pokédex</h1>
            </div>
        </div>

        <p class="px-dex-intro">
            Tous les Pokémon de Pixelax, tirés directement des données du serveur (Cobblemon {{ $meta['cobblemon'] }} et nos datapacks) :
            où les trouver, comment les faire évoluer, leurs talents, statistiques et objets. Les Pokémon customs et les skins renvoient vers leur page du wiki.
        </p>

        <form class="px-dex-tools" role="search" onsubmit="return false">
            <div class="px-dex-search">
                <i class="bi bi-search" aria-hidden="true"></i>
                <label class="visually-hidden" for="dexSearch">Rechercher un Pokémon</label>
                <input type="search" class="form-control" id="dexSearch" placeholder="Nom, numéro, type…" autocomplete="off">
            </div>
            <label class="visually-hidden" for="dexType">Type</label>
            <select class="form-select" id="dexType">
                <option value="">Tous les types</option>
                @foreach($dexTypes as $type => $label)
                    <option value="{{ $type }}">{{ $label }}</option>
                @endforeach
            </select>
            <label class="visually-hidden" for="dexGen">Génération</label>
            <select class="form-select" id="dexGen">
                <option value="">Toutes les générations</option>
                @foreach(range(1, 9) as $gen)
                    <option value="{{ $gen }}">Génération {{ $gen }}</option>
                @endforeach
            </select>
            <label class="visually-hidden" for="dexKind">Catégorie</label>
            <select class="form-select" id="dexKind">
                <option value="">Tous les Pokémon</option>
                <option value="wild">Apparaissent à l’état sauvage</option>
                <option value="legend">Légendaires et fabuleux</option>
                <option value="nowild">Sans apparition sauvage</option>
                <option value="custom">Pokémon customs Pixelax</option>
                <option value="skin">Skins</option>
            </select>
            <p class="px-dex-count" id="dexCount" aria-live="polite">{{ count($species) + count($wikiEntries) }} Pokémon</p>
        </form>

        <ul class="px-dex-grid" id="dexGrid">
            @foreach($species as $mon)
                @php
                    $kinds = [$mon['wild'] ? 'wild' : 'nowild'];
                    if ($mon['legend'] || in_array($mon['cat'], ['legendary', 'mythical'], true)) {
                        $kinds[] = 'legend';
                    }
                    $typeLabels = array_map(fn ($t) => $dexTypes[$t] ?? $t, $mon['types']);
                    // Une ligne par carte (≈ 1 200 cartes) : HTML plus léger et plus rapide à analyser
                    $card = '<li data-s="'.e($dexAscii($mon['name'].' '.($mon['en'] ?? '').' '.implode(' ', $typeLabels).' '.$mon['dex'])).'"'
                        .' data-t="'.e(implode(' ', $mon['types'])).'" data-g="'.e($mon['gen']).'" data-k="'.implode(' ', $kinds).'">'
                        .'<a class="px-dex-card" href="/pokedex/'.e($mon['slug']).'">'
                        .($mon['cat'] && isset($dexCategories[$mon['cat']]) ? '<span class="px-dex-tag">'.e($dexCategories[$mon['cat']]).'</span>' : '')
                        .($mon['sprite']
                            ? '<img src="/assets/img/pokedex/'.(int) $mon['sprite'].'.webp" alt="" width="72" height="72" loading="lazy" decoding="async">'
                            : '<span class="px-dex-ball" aria-hidden="true"><i class="bi bi-circle-half"></i></span>')
                        .'<span class="px-dex-num">#'.str_pad($mon['dex'], 4, '0', STR_PAD_LEFT).'</span>'
                        .'<span class="px-dex-name">'.e($mon['name']).'</span><span class="px-dex-types">'
                        .implode('', array_map(fn ($t) => '<span class="px-type px-type--'.e($t).'">'.e($dexTypes[$t] ?? $t).'</span>', $mon['types']))
                        .'</span></a></li>';
                @endphp
                {!! $card !!}
            @endforeach

            @foreach($wikiEntries as $entry)
                @php
                    $skin = $entry['kind'] === 'skin';
                    $card = '<li data-s="'.e($entry['search']).'" data-t="" data-g="" data-k="'.e($entry['kind']).'">'
                        .'<a class="px-dex-card" href="'.e($entry['url']).'">'
                        .'<span class="px-dex-tag'.($skin ? ' px-dex-tag--skin' : '').'">'.($skin ? 'Skin' : 'Custom').'</span>'
                        .($entry['image']
                            ? '<img src="'.e($entry['image']).'" alt="" width="72" height="72" loading="lazy" decoding="async">'
                            : '<span class="px-dex-ball" aria-hidden="true"><i class="bi bi-stars"></i></span>')
                        .'<span class="px-dex-num">'.e($entry['group']).'</span>'
                        .'<span class="px-dex-name">'.e($entry['name']).'</span></a></li>';
                @endphp
                {!! $card !!}
            @endforeach
        </ul>
        <p class="px-dex-empty" id="dexEmpty" hidden>Aucun Pokémon ne correspond à ta recherche.</p>
    </div>
@endsection

@push('footer-scripts')
    <script>
        (function () {
            const grid = document.getElementById('dexGrid');
            if (!grid) {
                return;
            }

            const items = Array.from(grid.children);
            const search = document.getElementById('dexSearch');
            const type = document.getElementById('dexType');
            const gen = document.getElementById('dexGen');
            const kind = document.getElementById('dexKind');
            const count = document.getElementById('dexCount');
            const empty = document.getElementById('dexEmpty');
            const normalize = (text) => text.normalize('NFD').replace(/[̀-ͯ]/g, '').toLowerCase().trim();
            const params = new URLSearchParams(location.search);

            search.value = params.get('q') || '';
            type.value = params.get('type') || '';
            gen.value = params.get('gen') || '';
            kind.value = params.get('cat') || '';

            function apply() {
                const words = normalize(search.value).split(/\s+/).filter(Boolean);
                let shown = 0;

                items.forEach(function (item) {
                    const match = words.every((word) => item.dataset.s.includes(word.replace(/^#0*/, '')))
                        && (!type.value || item.dataset.t.split(' ').includes(type.value))
                        && (!gen.value || item.dataset.g === gen.value)
                        && (!kind.value || item.dataset.k.split(' ').includes(kind.value));
                    item.hidden = !match;
                    shown += match ? 1 : 0;
                });

                count.textContent = shown + ' Pokémon';
                empty.hidden = shown > 0;

                const query = new URLSearchParams();
                if (search.value.trim()) query.set('q', search.value.trim());
                if (type.value) query.set('type', type.value);
                if (gen.value) query.set('gen', gen.value);
                if (kind.value) query.set('cat', kind.value);
                history.replaceState(null, '', location.pathname + (query.toString() ? '?' + query : ''));
            }

            let timer;
            search.addEventListener('input', function () {
                clearTimeout(timer);
                timer = setTimeout(apply, 120);
            });
            [type, gen, kind].forEach((select) => select.addEventListener('change', apply));

            if (search.value || type.value || gen.value || kind.value) {
                apply();
            }
        })();
    </script>
@endpush
