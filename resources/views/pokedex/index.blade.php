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
    {{-- CSS du Pokédex (11 Ko) intégré : une requête bloquante de moins pour l'affichage --}}
    <style>{!! file_get_contents(public_path('assets/css/pokedex.min.css')) !!}</style>
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

        @php
            // Une entrée compacte par carte : [recherche, types, génération, catégories, lien, badge, badge skin, image, numéro, nom, icône]
            $dexEntries = [];
            foreach ($species as $mon) {
                $kinds = [$mon['wild'] ? 'wild' : 'nowild'];
                if ($mon['legend'] || in_array($mon['cat'], ['legendary', 'mythical'], true)) {
                    $kinds[] = 'legend';
                }
                $typeLabels = array_map(fn ($t) => $dexTypes[$t] ?? $t, $mon['types']);
                $dexEntries[] = [
                    $dexAscii($mon['name'].' '.($mon['en'] ?? '').' '.implode(' ', $typeLabels).' '.$mon['dex']),
                    implode(' ', $mon['types']), (string) $mon['gen'], implode(' ', $kinds), '/pokedex/'.$mon['slug'],
                    $mon['cat'] ? ($dexCategories[$mon['cat']] ?? '') : '', 0, $mon['sprite'] ? '/assets/img/pokedex/s/'.$mon['sprite'].'.webp' : '',
                    '#'.str_pad($mon['dex'], 4, '0', STR_PAD_LEFT), $mon['name'], 'circle-half',
                ];
            }
            foreach ($wikiEntries as $entry) {
                $skin = $entry['kind'] === 'skin';
                $dexEntries[] = [$entry['search'], '', '', $entry['kind'], $entry['url'], $entry['label'] ?? $entry['group'], $skin ? 1 : 0, $entry['image'] ?? '', $skin ? 'Skin' : 'Pokémon custom', $entry['name'], 'stars'];
            }
            // Même rendu que le script plus bas (dexCard)
            $dexCard = function (array $e) use ($dexTypes) {
                return '<li data-s="'.e($e[0]).'" data-t="'.e($e[1]).'" data-g="'.e($e[2]).'" data-k="'.e($e[3]).'"><a class="px-dex-card" href="'.e($e[4]).'">'
                    .($e[7] !== '' ? '<img src="'.e($e[7]).'" alt="" width="72" height="72" loading="lazy" decoding="async">' : '<span class="px-dex-ball" aria-hidden="true"><i class="bi bi-'.$e[10].'"></i></span>')
                    .'<span class="px-dex-num">'.e($e[8]).'</span><span class="px-dex-name">'.e($e[9]).'</span>'
                    .($e[1] !== '' ? '<span class="px-dex-types">'.implode('', array_map(fn ($t) => '<span class="px-type px-type--'.e($t).'">'.e($dexTypes[$t] ?? $t).'</span>', explode(' ', $e[1]))).'</span>' : '')
                    .($e[5] !== '' ? '<span class="px-dex-tag'.($e[6] ? ' px-dex-tag--skin' : '').'">'.e($e[5]).'</span>' : '')
                    .'</a></li>';
            };
        @endphp

        {{-- Perf : les 48 premières cartes dans le HTML (affichage immédiat), les autres (≈ 1 200) construites par le script juste après --}}
        <ul class="px-dex-grid" id="dexGrid">{!! implode('', array_map($dexCard, array_slice($dexEntries, 0, 48))) !!}</ul>
        <script type="application/json" id="dexRest">{!! json_encode(['types' => $dexTypes, 'entries' => array_slice($dexEntries, 48)], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
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

            // Le reste des cartes arrive en JSON : ajouté par paquets après le premier affichage,
            // ou d'un coup dès qu'on cherche ou filtre (la recherche porte toujours sur tous les Pokémon)
            const restTag = document.getElementById('dexRest');
            const data = restTag ? JSON.parse(restTag.textContent) : { types: {}, entries: [] };
            const rest = data.entries;
            const esc = (v) => String(v).replace(/[&<>"]/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]));
            // Même rendu que $dexCard côté serveur
            const dexCard = (e) => '<li data-s="' + esc(e[0]) + '" data-t="' + esc(e[1]) + '" data-g="' + esc(e[2]) + '" data-k="' + esc(e[3]) + '"><a class="px-dex-card" href="' + esc(e[4]) + '">'
                + (e[7] ? '<img src="' + esc(e[7]) + '" alt="" width="72" height="72" loading="lazy" decoding="async">' : '<span class="px-dex-ball" aria-hidden="true"><i class="bi bi-' + esc(e[10]) + '"></i></span>')
                + '<span class="px-dex-num">' + esc(e[8]) + '</span><span class="px-dex-name">' + esc(e[9]) + '</span>'
                + (e[1] ? '<span class="px-dex-types">' + e[1].split(' ').map((t) => '<span class="px-type px-type--' + esc(t) + '">' + esc(data.types[t] || t) + '</span>').join('') + '</span>' : '')
                + (e[5] ? '<span class="px-dex-tag' + (e[6] ? ' px-dex-tag--skin' : '') + '">' + esc(e[5]) + '</span>' : '')
                + '</a></li>';
            const items = Array.from(grid.children);
            function addCards(count) {
                const html = rest.splice(0, count).map(dexCard).join('');
                if (html) {
                    grid.insertAdjacentHTML('beforeend', html);
                    items.length = 0;
                    items.push(...grid.children);
                }
            }
            function renderMore() {
                addCards(150);
                if (rest.length) {
                    (window.requestIdleCallback || ((cb) => setTimeout(cb, 50)))(renderMore);
                }
            }
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
                addCards(rest.length);
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
            } else {
                renderMore();
            }
        })();
    </script>
@endpush
