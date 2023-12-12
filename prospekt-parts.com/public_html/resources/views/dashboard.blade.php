@php
    $options = [
        [
            'name' => 'По артикулу',
            'value' => 'article'
        ],
        [
            'name' => 'По наименованию',
            'value' => 'name'
        ]
    ];
    $size = session('search') ? session('search')['meta']['size'] : '';
@endphp
@extends('layout/main')

@section('title', $deal::status() === '1' ? 'Поиск запчастей' : 'Статус договора')

@section('content')

    @if($deal::status() === '0')
        <x-alert type="info" message="Договор составлен. Нужно прислать подписанный договор с печатю. Два экземпляра" />   
        <strong class="d-grid mb-3">Варианты отправки документов:</strong>
        
        <ul class="d-grid gap-3">
            <li>Скан документов с подписью и печатью в PDF - <i>{!!$contact::getEmail('manager@prospekt-parts.com', ['text-dark'])!!}</i></li>
            <li>
                На бумаге, формата А4, почтой - <i>{{ config('app.address') }}</i> <br />
                <strong>Кому:</strong> ООО {{ config('app.name') }}
            </li>
        </ul>  
    @elseif($deal::status() === 'z')
        <x-alert type="danger" message="Договор не заключён" />    
    @elseif($deal::status() === '2')
        <x-alert type="danger" message="Договор расторгнут. Вы не можете пользоваться данной платформой" />    
    @elseif($deal::status() === '1')
        <form action="/dashboard/search" method="post" class="card shadow-sm border-0 mb-5 mt-3">
            @csrf
            <div id="type" class="card-body d-flex align-items-center gap-2">
                @foreach($options as $item)
                <label class="border rounded d-lg-block d-none">
                    <input type="radio" name="type" class="d-none" value="{{$item['value']}}" @if ($item['value'] === old('type')) checked @endif />
                    <span>{{$item['name']}}</span>
                </label>
                @endforeach
                <label class="border rounded" data-bs-toggle="modal" data-bs-target="#vinModal">
                    <input type="radio" name="type" class="d-none" value="vin" />
                    <span>Запрос по VIN</span>
                </label>
            </div>
            <div id="filter" class="card-body pt-0 d-flex gap-2">
                <input 
                    type="text" 
                    name="text" 
                    list="searchlist"
                    class="form-control" 
                    value="{{session('text') ? session('text') : old('text') }}" 
                    v-on:change="onChange(search)"
                    v-model="search"
                    placeholder="Поиск..." 
                />
                {{-- @include('layout.main.ui.selest.list') --}}
                <x-button color="danger" icon="search" type="submit" text="Найти" />
            </div>
        </form>
    @endif



    @error('text')
        <p>Получен пустой запрос.</p>
    @enderror    
    @if(session('search'))
        @if($size === 0)
            <p>По запросу <strong>"{{session('text')}}"</strong> ничего не найдено</p>
        @else
        <p>{{$decl::search($size)}} 
            @if ($size !== 1)
                &#160;<span class="badge bg-danger rounded-pill">{{$size}}</span>
            @endif
        </p>        
        @endif
        <div class="row g-2">
            @foreach(session('search')['rows'] as $item)
            <div class="col-12" :class="[!isOpen ? 'col-lg-3' : 'col-lg-4']">
                <div class="card card-data border-0 shadow">
                    @include('layout.main.ui.card.card-admin-image')
                    <div class="card-body">
                        <h5 class="card-title fs-5 mb-3" style="height: 48px">
                            <a href="/dashboard/product/details/{{$item['id']}}" class="text-dark fw-bold text-decoration-none">
                                <?php
                                    $str = str_replace(
                                        mb_strtolower(session('text')), 
                                        '<mark class="rounded py-0">'.mb_strtolower(session('text')).'</mark>', 
                                        mb_strtolower($item['name'])
                                    );
                                    $str = mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1, mb_strlen($str));
                                    echo $str;
                                ?>
                            </a>
                        </h5>
                        @include('layout.main.ui.quantity.quantity-admin')
                        <div class="d-flex align-items-center justify-content-between">
                            @include('layout.main.ui.card.card-admin-article')
                            @include('layout.main.ui.button.card-admin-button')
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif


    @if(session('search'))
    @else
<!--         <div class="row mb-4">
    <div class="col-12 col-lg-4">
        <a href="/dashboard/promo/Gearax">
            <img src="/img/goods/promo/powerhub.jpg" alt="Gearax" class="w-100 rounded shadow-sm" />
        </a>
    </div>
    <div class="col-12 col-lg-4">
        <a href="/dashboard/promo/GMS">
            <img src="/img/goods/promo/gms.jpg" alt="GMS" class="w-100 rounded shadow-sm" />
        </a>
    </div>
</div>   -->      
    @endif

    @role('admin')
        <hr />
        <strong>Admin-Панель</strong> 
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 mb-lg-5 mb-0 mt-3">
                    <div class="card-body">
                        <a href="/dashboard/accounts" class="d-flex align-items-center text-decoration-none">
                            <div class="p-2">
                                <span class="material-symbols-outlined text-secondary fs-1">inventory</span>
                            </div> 
                            <div class="p-2 flex-grow-1">
                                <h5 class="fw-bold text-dark m-0">Счета</h5> 
                                <small class="text-muted">Список всех счетов</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 mb-lg-5 mb-0 mt-3">
                    <div class="card-body">
                        <a href="/dashboard/orders" class="d-flex align-items-center text-decoration-none">
                            <div class="p-2">
                                <span class="material-symbols-outlined text-secondary fs-1">order_approve</span>
                            </div> 
                            <div class="p-2 flex-grow-1">
                                <h5 class="fw-bold text-dark m-0">Заказы</h5> 
                                <small class="text-muted">Список всех заказов</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>            
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 mb-lg-5 mb-0 mt-3">
                    <div class="card-body">
                        <a href="/dashboard/users" class="d-flex align-items-center text-decoration-none">
                            <div class="p-2">
                                <span class="material-symbols-outlined text-secondary fs-1">group</span>
                            </div> 
                            <div class="p-2 flex-grow-1">
                                <h5 class="fw-bold text-dark m-0">Пользователи</h5> 
                                <small class="text-muted">Список всех пользователей</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endrole

    
    <!-- @role('customer')
        <p>Project Manager Panel</p> 
    @endrole
    @role('admin')
        <strong>Admin Panel</strong> 
    @endrole -->


    <div class="modal fade" id="vinModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content border-0" novalidate @submit.prevent="Save" v-if="!send">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5">Заказ по VIN номеру</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="mt-2">
                        <input 
                            type="text" 
                            class="form-control" 
                            :class="[error.vin && vin === '' ? 'is-invalid' : '']"
                            v-model="vin" 
                            placeholder="Укажите VIN номер" 
                        />
                        <div class="invalid-feedback d-block m-0" v-if="error.vin && vin === ''">
                            Пожалуйста, укажите VIN номер модели
                        </div>
                    </div>
                    <div class="mt-2">
                        <textarea 
                            rows="5" 
                            class="form-control" 
                            :class="[error.spares && spares === '' ? 'is-invalid' : '']"
                            v-model="spares" 
                            placeholder="Укажите список запчастей"
                        >
                        </textarea>
                        <div class="invalid-feedback d-block m-0" v-if="error.spares && spares === ''">
                            Пожалуйста, напишите через запятую, какие запчасти вам нужны
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="btn btn-outline-light text-dark" data-bs-dismiss="modal">Отмена</div>
                    <button type="submit" class="btn btn-dark px-4 d-flex align-items-center gap-2 justify-content-center" v-if="loading">
                        <span class="material-symbols-outlined spin">autorenew</span>
                        Отправляю...
                    </button>
                    <x-button color="dark" icon="forward" type="submit" text="Отправить менеджеру" v-on:click="Send" v-else />
                </div>
            </form>
            <div class="modal-content border-0" v-else>
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5">Заказ по VIN номеру</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <x-alert type="success" message="Ваша заявка принята." close="false" />
                </div>
            </div>
        </div>
    </div>

@if($deal::status() === 'z')
    <div data-bs-backdrop="static" data-bs-keyboard="false" class="modal fade show" aria-modal="true" role="dialog" style="display: block;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 fw-bold">Здравствуйте</h1>
                </div>
                <div class="modal-body py-0">
                    <p>
                        В настоящий момент, вы не можете пользоваться нашей платформой,
                        так как у вас не заключён договор. Чтобы начать пользоваться, нажмите кнопку:
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <x-button type="a" href="/dashboard/document/agreement" color="dark" icon="quick_reference" text="Заключить договор" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
@endif

@endsection