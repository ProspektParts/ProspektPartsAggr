{{-- <x-icon-favorite color="#b02a37" />
<small>{{rand(4, 5)}}.{{rand(0, 9)}} рейтинг</small>  --}}
@if ($stock === '416a3aff-0f66-11ee-0a80-0d9c00124798')
    <span 
        class="badge rounded-pill text-bg-danger px-3" 
        data-bs-toggle="tooltip"
    >
         <!-- Срок 5 дней  data-bs-title="Доставка заказа осуществляется в течении 5 рабочих дней" -->
    </span>
@elseif ($stock === 'a2a12edf-1642-11ee-0a80-13ab00041ab9')
    <span 
        class="badge rounded-pill text-bg-danger px-3" 
        data-bs-toggle="tooltip" 
        data-bs-title="Доставка заказа осуществляется в течении 28 рабочих дней"
    >
        <!--Срок 28 дней-->
    </span>
@else
@endif