@extends('layouts.app')

@php
    $mon = $pokemon;
    $types = $meta['types'];
    $num = '#'.str_pad($mon['dex'], 4, '0', STR_PAD_LEFT);
    $categories = ['legendary' => 'Pokémon légendaire', 'mythical' => 'Pokémon fabuleux', 'ultra_beast' => 'Ultra-Chimère', 'paradox' => 'Pokémon Paradoxe'];
    $statLabels = ['hp' => 'PV', 'atk' => 'Attaque', 'def' => 'Défense', 'spa' => 'Atq. Spé.', 'spd' => 'Déf. Spé.', 'spe' => 'Vitesse'];
    $statColors = ['hp' => '#9fd36b', 'atk' => '#f5ac78', 'def' => '#fae078', 'spa' => '#9db7f5', 'spd' => '#a7db8d', 'spe' => '#fa92b2'];
    $total = array_sum(array_filter($mon['stats'], 'is_numeric'));
    $sprite = \Azuriom\Support\Pokedex::sprite($mon['sprite']);

    // SEO : description propre à chaque Pokémon (où le trouver en premier, c'est ce qu'on cherche)
    $where = collect($mon['spawns'])->flatMap(fn ($s) => array_column($s['biomes'], 'label'))->unique()->take(3)->implode(', ');
    $rarities = collect($mon['spawns'])->pluck('bucketLabel')->unique()->implode(' / ');
    if ($where !== '') {
        $seoWhere = "apparaît dans : {$where} ({$rarities}, niv. ".collect($mon['spawns'])->pluck('level')->first().')';
    } elseif (! empty($mon['legends'])) {
        $seoWhere = 'apparition légendaire aléatoire près des joueurs';
    } else {
        $seoWhere = 'pas d’apparition sauvage';
    }
    $seoDescription = \Illuminate\Support\Str::limit("{$mon['name']} ({$num}) sur Pixelax, serveur Minecraft Cobblemon : {$seoWhere}. Évolutions, talents, statistiques, objets et capacités.", 158, '…');

    $crumbs = [
        ['name' => trans('messages.home'), 'url' => route('home')],
        ['name' => 'Pokédex', 'url' => route('pokedex.index')],
        ['name' => $mon['name'], 'url' => route('pokedex.show', $mon['slug'])],
    ];
    // Construit dans @php : hors de ce bloc, Blade prendrait "@context" pour une directive
    $jsonLd = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => collect($crumbs)->values()->map(fn ($c, $i) => ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $c['name'], 'item' => $c['url']])->all(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);

    $levelMoves = $mon['moves']['level'];
@endphp

@section('title', $mon['name'].' – Pokédex')
@section('full_title', $mon['name'].' : spawn, évolutions et stats – Pokédex Cobblemon | Pixelax')
@section('description', $seoDescription)
@if($sprite)
    @section('og_image', $sprite)
@endif

@push('meta')
    <script type="application/ld+json">{!! $jsonLd !!}</script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pokedex.css') }}?v={{ filemtime(public_path('assets/css/pokedex.css')) }}">
@endpush

@section('content')
    <div class="px-dex">
        <nav aria-label="Fil d’Ariane">
            <ol class="px-dex-crumbs">
                @foreach($crumbs as $crumb)
                    <li>
                        @if($loop->last)
                            <span aria-current="page">{{ $crumb['name'] }}</span>
                        @else
                            <a href="{{ $crumb['url'] }}">{{ $crumb['name'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        {{-- En-tête --}}
        <div class="card mb-3">
            <div class="card-body px-dex-hero">
                <div class="px-dex-hero-art">
                    @if($sprite)
                        <img src="{{ $sprite }}" alt="{{ $mon['name'] }}" width="150" height="150" fetchpriority="high">
                    @else
                        <span class="px-dex-ball" aria-hidden="true"><i class="bi bi-circle-half"></i></span>
                    @endif
                </div>
                <div>
                    <span class="px-dex-num">{{ $num }}</span>
                    <h1>{{ $mon['name'] }}</h1>
                    <div class="px-dex-types">
                        @foreach($mon['types'] as $type)
                            <span class="px-type px-type--{{ $type }}">{{ $types[$type] ?? $type }}</span>
                        @endforeach
                    </div>
                    <div class="px-dex-sub">
                        @if($mon['gen'])<span>Génération {{ $mon['gen'] }}</span>@endif
                        @if($mon['cat'])<span>{{ $categories[$mon['cat']] ?? '' }}</span>@endif
                        @if(! empty($mon['en']))<span lang="en">{{ $mon['en'] }} en anglais</span>@endif
                        @if($mon['wild'])
                            <span><i class="bi bi-geo-alt" aria-hidden="true"></i> Sauvage sur le serveur</span>
                        @endif
                    </div>
                    @if($mon['desc'])
                        <p class="px-dex-desc">{{ $mon['desc'] }}</p>
                    @endif
                </div>
            </div>
        </div>

        <nav class="px-dex-pager" aria-label="Pokémon précédent et suivant">
            @if($previous)
                <a href="{{ route('pokedex.show', $previous['slug']) }}" rel="prev">
                    <i class="bi bi-chevron-left" aria-hidden="true"></i>
                    @if($previous['sprite'])<img src="{{ \Azuriom\Support\Pokedex::sprite($previous['sprite']) }}" alt="" width="32" height="32" loading="lazy">@endif
                    {{ $previous['name'] }}
                </a>
            @else
                <span></span>
            @endif
            <a href="{{ route('pokedex.index') }}"><i class="bi bi-grid-3x3-gap" aria-hidden="true"></i> Tous les Pokémon</a>
            @if($next)
                <a href="{{ route('pokedex.show', $next['slug']) }}" rel="next">
                    {{ $next['name'] }}
                    @if($next['sprite'])<img src="{{ \Azuriom\Support\Pokedex::sprite($next['sprite']) }}" alt="" width="32" height="32" loading="lazy">@endif
                    <i class="bi bi-chevron-right" aria-hidden="true"></i>
                </a>
            @else
                <span></span>
            @endif
        </nav>

        {{-- Où le trouver --}}
        <section class="card mb-3 px-dex-section" aria-labelledby="dex-where">
            <div class="card-body">
                <h2 id="dex-where"><i class="bi bi-geo-alt" aria-hidden="true"></i> Où trouver {{ $mon['name'] }}</h2>

                @if(! empty($mon['spawns']))
                    <div class="px-dex-spawns">
                        @foreach($mon['spawns'] as $spawn)
                            <article class="px-dex-spawn">
                                <div class="px-dex-spawn-head">
                                    <span class="px-dex-rarity px-dex-rarity--{{ $spawn['bucket'] }}">{{ $spawn['bucketLabel'] }}</span>
                                    <span class="px-dex-chip">Niv. {{ $spawn['level'] }}</span>
                                    <span class="px-dex-chip">{{ $spawn['context'] }}</span>
                                    @if($spawn['form'])
                                        <span class="px-dex-chip">{{ $spawn['form'] }}</span>
                                    @endif
                                </div>
                                <dl>
                                    @if(! empty($spawn['biomes']))
                                        <dt>Biomes</dt>
                                        <dd>
                                            <ul class="px-dex-chips">
                                                @foreach($spawn['biomes'] as $biome)
                                                    <li>
                                                        @if(! empty($biome['biomes']))
                                                            <details class="px-dex-chip">
                                                                <summary>{{ $biome['label'] }}</summary>
                                                                <p>{{ implode(', ', $biome['biomes']) }}</p>
                                                            </details>
                                                        @else
                                                            <span class="px-dex-chip">{{ $biome['label'] }}</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </dd>
                                    @endif
                                    @if(! empty($spawn['excluded']))
                                        <dt>Sauf</dt>
                                        <dd>{{ implode(', ', $spawn['excluded']) }}</dd>
                                    @endif
                                    @if(! empty($spawn['structures']))
                                        <dt>Structures</dt>
                                        <dd>{{ implode(', ', $spawn['structures']) }}</dd>
                                    @endif
                                    @if(! empty($spawn['conditions']))
                                        <dt>Conditions</dt>
                                        <dd>{{ implode(' · ', $spawn['conditions']) }}</dd>
                                    @endif
                                    @if(! empty($spawn['boosts']))
                                        <dt>Bonus</dt>
                                        <dd>Plus fréquent {{ implode(', ', $spawn['boosts']) }}</dd>
                                    @endif
                                </dl>
                            </article>
                        @endforeach
                    </div>
                @endif

                @if(! empty($mon['legends']))
                    <h3>Apparition légendaire</h3>
                    <p class="px-dex-muted">
                        Toutes les {{ $meta['legendInterval'] }}, le serveur a {{ $meta['legendChance'] }} % de chances de faire apparaître un légendaire
                        près d’un joueur, au niveau {{ $meta['legendLevel'] }}. Voir aussi
                        <a href="{{ url('/wiki/divers/spawns-des-legendaires') }}">les spawns des légendaires</a>.
                    </p>
                    <div class="px-dex-spawns">
                        @foreach($mon['legends'] as $legend)
                            <article class="px-dex-spawn">
                                <div class="px-dex-spawn-head">
                                    <span class="px-dex-rarity px-dex-rarity--legend">Légendaire</span>
                                    <span class="px-dex-chip">{{ str_replace('.', ',', $legend['share']) }} % des apparitions</span>
                                    @if($legend['form'])
                                        <span class="px-dex-chip">{{ $legend['form'] }}</span>
                                    @endif
                                </div>
                                <dl>
                                    <dt>Biomes</dt>
                                    <dd>
                                        <ul class="px-dex-chips">
                                            @foreach($legend['biomes'] as $biome)
                                                <li>
                                                    @if(! empty($biome['biomes']))
                                                        <details class="px-dex-chip">
                                                            <summary>{{ $biome['label'] }}</summary>
                                                            <p>{{ implode(', ', $biome['biomes']) }}</p>
                                                        </details>
                                                    @else
                                                        <span class="px-dex-chip">{{ $biome['label'] }}</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </dd>
                                    <dt>Moment</dt>
                                    <dd>{{ \Illuminate\Support\Str::ucfirst($legend['time']) }}{{ $legend['weather'] ? ' · '.$legend['weather'] : '' }}</dd>
                                    @if($legend['underground'] || $legend['underwater'])
                                        <dt>Lieu</dt>
                                        <dd>{{ $legend['underwater'] ? 'Sous l’eau' : 'Sous terre (sans voir le ciel)' }}</dd>
                                    @endif
                                </dl>
                            </article>
                        @endforeach
                    </div>
                @endif

                @if(empty($mon['spawns']) && empty($mon['legends']))
                    <p class="px-dex-muted mb-0">
                        {{ $mon['name'] }} n’apparaît pas à l’état sauvage sur le serveur.
                        @if($mon['family'] && $mon['family']['key'] !== $mon['key'])
                            Il s’obtient en faisant évoluer {{ $mon['family']['name'] }} (voir ci-dessous), par l’élevage ou par l’échange.
                        @else
                            Il s’obtient par l’élevage, l’échange ou lors d’événements.
                        @endif
                    </p>
                @endif
            </div>
        </section>

        {{-- Évolutions --}}
        @if($mon['family'] && (! empty($mon['family']['next']) || $mon['family']['key'] !== $mon['key']))
            <section class="card mb-3 px-dex-section" aria-labelledby="dex-evo">
                <div class="card-body">
                    <h2 id="dex-evo"><i class="bi bi-arrow-repeat" aria-hidden="true"></i> Évolutions</h2>
                    <div class="px-dex-evo">
                        @include('pokedex._evo', ['node' => $mon['family'], 'current' => $mon['key']])
                    </div>
                </div>
            </section>
        @endif

        <div class="row">
            {{-- Statistiques --}}
            <div class="col-lg-6">
                <section class="card mb-3 px-dex-section" aria-labelledby="dex-stats">
                    <div class="card-body">
                        <h2 id="dex-stats"><i class="bi bi-bar-chart" aria-hidden="true"></i> Statistiques de base</h2>
                        <dl class="px-dex-stats">
                            @foreach($statLabels as $key => $label)
                                <dt>{{ $label }}</dt>
                                <dd>{{ $mon['stats'][$key] ?? '–' }}</dd>
                                <div class="px-dex-bar" aria-hidden="true"><span style="width: {{ min(100, round(($mon['stats'][$key] ?? 0) / 255 * 100)) }}%; --b: {{ $statColors[$key] }}"></span></div>
                            @endforeach
                            <dt>Total</dt>
                            <dd><strong>{{ $total }}</strong></dd>
                            <span></span>
                        </dl>
                        @if(! empty($mon['ev']))
                            <p class="px-dex-muted mt-3 mb-0">EV donnés : {{ implode(', ', $mon['ev']) }}</p>
                        @endif
                    </div>
                </section>
            </div>

            {{-- Talents --}}
            <div class="col-lg-6">
                <section class="card mb-3 px-dex-section" aria-labelledby="dex-abilities">
                    <div class="card-body">
                        <h2 id="dex-abilities"><i class="bi bi-stars" aria-hidden="true"></i> Talents</h2>
                        <ul class="px-dex-abilities">
                            @foreach($mon['abilities'] as $ability)
                                <li>
                                    <strong>{{ $ability['name'] }}</strong>
                                    @if($ability['hidden'])<span class="px-dex-chip ms-1">Talent caché</span>@endif
                                    @if($ability['desc'])<p>{{ $ability['desc'] }}</p>@endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>

        {{-- Informations --}}
        <section class="card mb-3 px-dex-section" aria-labelledby="dex-infos">
            <div class="card-body">
                <h2 id="dex-infos"><i class="bi bi-info-circle" aria-hidden="true"></i> Informations</h2>
                <dl class="px-dex-facts">
                    @if($mon['height'] !== null)
                        <div><dt>Taille</dt><dd>{{ str_replace('.', ',', $mon['height']) }} m</dd></div>
                    @endif
                    @if($mon['weight'] !== null)
                        <div><dt>Poids</dt><dd>{{ str_replace('.', ',', $mon['weight']) }} kg</dd></div>
                    @endif
                    <div><dt>Taux de capture</dt><dd>{{ $mon['catchRate'] }} / 255</dd></div>
                    <div>
                        <dt>Sexe</dt>
                        <dd>
                            @if($mon['maleRatio'] === null || $mon['maleRatio'] < 0)
                                Asexué
                            @else
                                {{ round($mon['maleRatio'] * 100, 1) }} % ♂ · {{ round((1 - $mon['maleRatio']) * 100, 1) }} % ♀
                            @endif
                        </dd>
                    </div>
                    <div><dt>Groupes d’œufs</dt><dd>{{ implode(', ', $mon['eggGroups']) ?: '–' }}</dd></div>
                    <div><dt>Éclosion</dt><dd>{{ $mon['eggCycles'] }} cycles</dd></div>
                    <div><dt>Croissance</dt><dd>{{ $mon['xpGroup'] }}</dd></div>
                    <div><dt>Bonheur de base</dt><dd>{{ $mon['friendship'] }}</dd></div>
                    <div><dt>Expérience donnée</dt><dd>{{ $mon['baseXp'] }}</dd></div>
                    @if($mon['shoulder'])
                        <div><dt>Épaule</dt><dd>Se porte sur l’épaule</dd></div>
                    @endif
                    @if($mon['rideable'])
                        <div><dt>Monture</dt><dd>Peut être chevauché</dd></div>
                    @endif
                </dl>
            </div>
        </section>

        {{-- Objets --}}
        @if(! empty($mon['drops']['items']))
            <section class="card mb-3 px-dex-section" aria-labelledby="dex-drops">
                <div class="card-body">
                    <h2 id="dex-drops"><i class="bi bi-bag" aria-hidden="true"></i> Objets lâchés</h2>
                    <p class="px-dex-muted">Objets que {{ $mon['name'] }} peut laisser tomber quand il est vaincu{{ $mon['drops']['rolls'] ? ' (jusqu’à '.$mon['drops']['rolls'].' objets)' : '' }}.</p>
                    <table class="px-dex-table">
                        <thead><tr><th>Chance</th><th>Objet</th><th>Quantité</th></tr></thead>
                        <tbody>
                            @foreach($mon['drops']['items'] as $item)
                                <tr>
                                    <td>{{ str_replace('.', ',', $item['chance']) }} %</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['qty'] ?? '1' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        @endif

        {{-- Formes --}}
        @if(! empty($mon['forms']))
            <section class="card mb-3 px-dex-section" aria-labelledby="dex-forms">
                <div class="card-body">
                    <h2 id="dex-forms"><i class="bi bi-intersect" aria-hidden="true"></i> Formes</h2>
                    <div class="px-dex-spawns">
                        @foreach($mon['forms'] as $form)
                            <article class="px-dex-spawn">
                                <div class="px-dex-spawn-head">
                                    <strong>{{ $form['name'] }}</strong>
                                    @if($form['battleOnly'])<span class="px-dex-chip">En combat</span>@endif
                                </div>
                                <div class="px-dex-types justify-content-start">
                                    @foreach($form['types'] as $type)
                                        <span class="px-type px-type--{{ $type }}">{{ $types[$type] ?? $type }}</span>
                                    @endforeach
                                </div>
                                @if($form['stats'])
                                    <p class="px-dex-muted mb-0">
                                        @foreach($statLabels as $key => $label)
                                            {{ $label }} {{ $form['stats'][$key] ?? '–' }}@if(! $loop->last) · @endif
                                        @endforeach
                                    </p>
                                @endif
                                @if($form['abilities'])
                                    <p class="px-dex-muted mb-0">Talents : {{ implode(', ', array_unique($form['abilities'])) }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Skins et variantes du wiki --}}
        @if(! empty($skins) || ! empty($variants))
            <section class="card mb-3 px-dex-section" aria-labelledby="dex-skins">
                <div class="card-body">
                    <h2 id="dex-skins"><i class="bi bi-palette" aria-hidden="true"></i> Skins et variantes Pixelax</h2>
                    <ul class="px-dex-links">
                        @foreach(array_merge($variants, $skins) as $entry)
                            <li>
                                <a class="px-dex-card" href="{{ $entry['url'] }}">
                                    @if($entry['image'])
                                        <img src="{{ $entry['image'] }}" alt="" width="80" height="80" loading="lazy" decoding="async">
                                    @endif
                                    <span class="px-dex-name">{{ $entry['name'] }}</span>
                                    <span class="px-dex-num">{{ $entry['group'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif

        {{-- Capacités --}}
        <section class="card mb-3 px-dex-section" aria-labelledby="dex-moves">
            <div class="card-body">
                <h2 id="dex-moves"><i class="bi bi-lightning-charge" aria-hidden="true"></i> Capacités</h2>
                @if(! empty($levelMoves))
                    <h3>Par montée de niveau</h3>
                    <table class="px-dex-table">
                        <thead><tr><th>Niveau</th><th>Capacité</th></tr></thead>
                        <tbody>
                            @foreach($levelMoves as [$level, $move])
                                <tr><td>{{ $level === 0 ? 'Évolution' : $level }}</td><td>{{ $move }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                @foreach(['tm' => 'Par CT', 'egg' => 'Par reproduction (capacités œuf)', 'tutor' => 'Par maître des capacités et autres'] as $key => $label)
                    @if(! empty($mon['moves'][$key]))
                        <details class="px-dex-moves">
                            <summary>{{ $label }} ({{ count($mon['moves'][$key]) }})</summary>
                            <ul class="px-dex-chips">
                                @foreach($mon['moves'][$key] as $move)
                                    <li class="px-dex-chip">{{ $move }}</li>
                                @endforeach
                            </ul>
                        </details>
                    @endif
                @endforeach
            </div>
        </section>

        <p class="px-dex-muted small">
            Données générées depuis le serveur Pixelax (Cobblemon {{ $meta['cobblemon'] }} et datapacks), mises à jour le {{ \Carbon\Carbon::parse($meta['generatedAt'])->translatedFormat('j F Y') }}.
        </p>
    </div>
@endsection
