{{-- Un Pokémon de la famille d'évolution, puis ses évolutions (récursif) --}}
<div class="px-dex-evo-step">
    @php
        $evoTag = $node['slug'] ? 'a' : 'div';
    @endphp
    <{{ $evoTag }} class="px-dex-evo-mon {{ $node['key'] === $current ? 'is-current' : '' }}"
        @if($node['slug']) href="{{ route('pokedex.show', $node['slug']) }}" @endif
        @if($node['key'] === $current) aria-current="page" @endif>
        @if($node['dex'])
            <img src="{{ \Azuriom\Support\Pokedex::sprite($node['dex'], true) }}" alt="" width="56" height="56" loading="lazy" decoding="async">
        @endif
        <span class="px-dex-evo-info">
            {{ $node['name'] }}
            @if(! empty($node['form']))
                <small>{{ $node['form'] }}</small>
            @endif
            @if(! empty($node['types']))
                {{-- Types de la forme (ex. Shifours Style Mille Poings : Combat/Eau) --}}
                <span class="px-dex-types">
                    @foreach($node['types'] as $type)
                        <span class="px-type px-type--{{ $type }}">{{ \Azuriom\Support\Pokedex::meta()['types'][$type] ?? $type }}</span>
                    @endforeach
                </span>
            @endif
        </span>
    </{{ $evoTag }}>

    @if(! empty($node['next']))
        {{-- is-multi : plusieurs évolutions possibles (Évoli…), affichées côte à côte quand la chaîne est empilée --}}
        <div class="px-dex-evo-branch {{ count($node['next']) > 1 ? 'is-multi' : '' }}">
            @foreach($node['next'] as $child)
                <div class="px-dex-evo-step">
                    <span class="px-dex-evo-how">
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        <span>{{ $child['how'] }}</span>
                    </span>
                    @include('pokedex._evo', ['node' => $child, 'current' => $current])
                </div>
            @endforeach
        </div>
    @endif
</div>
