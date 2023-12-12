<div class="d-flex align-items-center justify-content-between">
    <div>
        @if ($item['productFolder']['id'] === '8854033a-48ad-11ed-0a80-0c87007f4175')
            @if ($item['quantity'] == 0)
                <x-badge color="danger" text="Нет в наличии" /> 
            @else
                <x-badge color="34617" text="В наличии {{$item['quantity']}}" />  
            @endif                         
        @else
            @if ($item['volume'] == 0)
                <x-badge color="danger" text="Нет в наличии" />
            @else
                <x-badge color="34617" text="В наличии {{$item['volume']}}" />
            @endif
        @endif
    </div>
    <h5 class="m-0">{!! $currency::summa($item['salePrices'][0]['value']) !!}</h5> 
</div>
<hr style="color: #ddd" />