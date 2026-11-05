{{-- Un Pokémon de la famille d'évolution, puis ses évolutions (récursif) --}}
<div class="px-dex-evo-step">
    @php
        $evoTag = $node['slug'] ? 'a' : 'div';
    @endphp
    <{{ $evoTag }} class="px-dex-evo-mon {{ $node['key'] === $current ? 'is-current' : '' }}"
        @if($node['slug']) href="{{ route('pokedex.show', $node['slug']) }}" @endif
        @if($node['key'] === $current) aria-current="page" @endif>
        @if($node['dex'])
            <img src="{{ \Azuriom\Support\Pokedex::sprite($node['dex']) }}" alt="" width="56" height="56" loading="lazy" decoding="async">
        @endif
        {{ $node['name'] }}
        @if(! empty($node['form']))
            <small>{{ $node['form'] }}</small>
        @endif
    </{{ $evoTag }}>

    @if(! empty($node['next']))
        <div class="px-dex-evo-branch">
            @foreach($node['next'] as $child)
                <div class="px-dex-evo-step">
                    <span class="px-dex-evo-how">
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        {{ $child['how'] }}
                    </span>
                    @include('pokedex._evo', ['node' => $child, 'current' => $current])
                </div>
            @endforeach
        </div>
    @endif
</div>
