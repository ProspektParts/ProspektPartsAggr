<div class="d-flex align-items-center gap-2">
    <div>
        @if ($stock['id'] === '254c7d33-15ba-11ee-0a80-09a00027e0da')
            <img 
                src="/img/partner/Gearax/gearax.png" 
                alt="Gearax" 
                style="background: #efeded;border-radius: 50em;width: 37px;height: 37px"
            />
        @elseif ($stock['id'] === 'a2a12edf-1642-11ee-0a80-13ab00041ab9')
            <img 
                src="/img/partner/GMS/gms.png" 
                alt="GMS"
                style="background: #efeded;border-radius: 50em;width: 37px;height: 37px"
            />
        @else
            <img src="/img/mercedes-benz.png" alt="Mercedes-Benz" style="width: 37px;height: 37px">
        @endif
    </div>
    <div class="lh-sm">
        <small class="text-muted d-block w-100">
            {{$item['article']}}                                            
        </small>
        <strong class="text-secondary">
            @if ($stock['id'] === 'a2a12edf-1642-11ee-0a80-13ab00041ab9')
                {{$stock['name']}}
            @elseif ($stock['id'] === '254c7d33-15ba-11ee-0a80-09a00027e0da')
                {{$stock['name']}}
            @else
                Mercedes-Benz
            @endif
        </strong>
    </div>
</div>