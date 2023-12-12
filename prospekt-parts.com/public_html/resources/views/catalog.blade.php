@php
    $result = array_merge($listorder, $bestsellers, $alllist);
    $size = session('search') ? session('search')['meta']['size'] : '';
    $stock = isset($product['rows'][0]['productFolder']) ? $product['rows'][0]['productFolder'] : null;
@endphp

@extends('layout/index', [
    'title' => 'Каталог запчастей Mercedes-Benz | Проспект Партс',
    'keywords' => 'ремонт в москве, ремонт машин в мытищи, ремонт двигателя, сервис, service, чинить, автосервис, мерседес бенц, актрос',
    'description' => 'Каталог запчастей Mercedes-Benz, широкий ассортимент комплектующих и расходных материалов для грузовых автомобилей',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Каталог запчастей Mercedes-Benz | Проспект Партс')

@section('content')
<section class="bg-secondary-subtle catalog">
    <div class="container position-relative py-4 py-lg-2">
        <div class="row">
            <div class="col-12">
                @error('text')
                    <p>Получен пустой запрос.</p>
                @enderror
            </div>
        </div>
        
        @if (session('error'))
            <x-alert type="warning" header=" " message="{{session('error')}}" />
        @endif
        @if(session('search'))
            @if($size === 0)
{{--                тут проблем--}}
                @include('layout.main.ui.empty.no-result', ['text' => session('text')])
            @else
                <p>{{$decl::search($size)}} <span class="badge bg-danger text-white rounded-pill">{{$size}}</span></p>
                <div class="row g-2">
                @foreach(session('search')['rows'] as $item)
                    @if(isset($item['article']))
                    <div class="col-lg-3 col-12">
                        <div class="card card-data border-0 shadow order">
                            <a href="/product/mercedes-benz/{{$item['id']}}" class="card-body pb-0 position-relative">
                                <div 
                                    itemprop="aggregateRating" 
                                    itemscope 
                                    itemtype="https://schema.org/AggregateRating" 
                                    class="d-flex align-items-center gap-1 z-3 position-absolute rounded-2 m-2"
                                >
                                    @include('layout.main.ui.badge.stock', ['stock' => $item['productFolder']['id']])
                                    <meta itemprop="worstRating" content="1">
                                    <meta itemprop="ratingValue" content="4.9">
                                    <meta itemprop="bestRating" content="5">
                                </div>
                                <img 
                                    loading="lazy"
                                    itemprop="image"
                                    src="{{$images::src($item['id'])}}" 
                                    class="card-img-top rounded" 
                                    alt="{{$item['name']}}, Проспект Транс, {{$item['pathName']}}"
                                />
                            </a>
                            <div class="card-body">
                                <h5 class="card-title fw-bold fs-6" style="height: 39px">
                                    <a itemprop="name" href="/product/mercedes-benz/{{$item['id']}}">
                                        {{mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8")}}
                                    </a>
                                </h5>
                                <hr style="color: #ddd">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @if ($item['productFolder']['id'] === '8854033a-48ad-11ed-0a80-0c87007f4175')
                                            <p 
                                                itemprop="offers" 
                                                itemscope
                                                itemtype="https://schema.org/Offer" 
                                                class="{{$images::quantity($item['quantity'])['class']}}"
                                            >
                                                <link itemprop="availability" href="https://schema.org/InStock">
                                                {{$images::quantity($item['quantity'])['text']}}
                                            </p>                                             
                                        @else 
                                            <p 
                                                itemprop="offers" 
                                                itemscope
                                                itemtype="https://schema.org/Offer" 
                                                class="{{$item['quantity'] == 0 ? 'label-danger' : 'label'}}"
                                            >
                                                <link itemprop="availability" href="https://schema.org/InStock">
                                                {{$item['quantity'] == 0 ? 'Нет в наличии' : 'В наличии '.$item['quantity']}}
                                            </p>
                                        @endif                    
                                    </div>
                                    <strong>
                                        {!!$currency::summa($item['salePrices'][0]['value'])!!}
                                    </strong>                            
                                </div>
                                <hr style="color: #ddd">
                                <div class="d-flex align-items-center justify-content-between">
                               <div class="d-flex align-items-center gap-2">
                                   
                              <!--           <div>
                                  <img src="/img/mercedes-benz.png" alt="Mercedes-Benz" style="width: 37px;height: 37px">
                              </div> -->
<!--                                 <div class="lh-sm">
    <small class="text-muted d-block w-100">
        {{$item['article']}}
    </small>
    <strong class="text-secondary">Mercedes-Benz</strong>
</div --> 
                                    </div>
                                    
                                    @include('layout.main.ui.logo.car-logo', ['stock' => $item['productFolder']])
                                    <div>
                                        @if($item['quantity'] == 0)
                                        <div onclick="isNotSignUp()" class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                            <x-icon-add-card size="25px" color="#fff" />
                                        </div>
                                        @else
                                        <div
                                        
                                            id="card{{$item['id']}}" 
                                            data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},1,{{$item['salePrices'][0]['value']}},{{$item['salePrices'][0]['value']}},{{$images::src($item['id'])}}" 
                                            v-on:click="addToCard('{{$item['id']}}')"
                                            class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2"
                                        >
                                
                                            <x-icon-add-card size="25px" color="#fff" />
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
                </div>
            @endif
        @else
            <div class="row" itemscope itemtype="https://schema.org/Product">
                <div class="d-flex justify-content-between">
                    <h2 class="text fw-bold text-dark">{{$stock['name'] ?? 'Name not available' }}</h2>
                    <div class="d-print-none">
                        <div id="loadingpage" class="text"></div>
                    </div>
                </div>
                <div class="col-12"><hr /></div>
                <div class="col-12 d-flex align-items-center justify-content-between py-3">
                    <p class="text text-muted m-0">
                           
                        Всего {{$product['meta']['size']}} {{$decl::cart($product['meta']['size'])}}
                         
                    </p>
                    <div>
                        <select id="selectOffset" class="form-select" onchange="selectOffset()">
                            @foreach ([12, 24, 48, 64, 100] as $key)
                                <option value="/products/mercedes-benz/{{$key}}/0" @if($key == $limit) selected @endif >
                                    {{$key}}
                                </option>
                            @endforeach
                        </select>                        
                    </div>
                    <div class="btn-group">
                        <button class="btn border-0" :class="[design === 'grid' ? 'bg-dark-subtle' : 'bg-white']" v-on:click="isGrid()">
                            <x-icon-grid size="27px" />
                        </button>
                        <button class="btn border-0" :class="[design === 'line' ? 'bg-dark-subtle' : 'bg-white']" v-on:click="isLine()">
                            <x-icon-line size="27px" />
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="row g-2 grid-design"> 
                @include('layout.main.ui.card.card-empty')
            </div>
            
<!--вывод togglebar со складов-->
<!--             <div class="showcase-items">
        <div class="col-md-3.offset-0">
<div class="showcase-filter">
    <nav id="sidebar">
        
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <div class="p-4 pt-5 bg-light sidebar">
        Ваш код сайдбара здесь

        <h5 style="color: black">Выберите Запчасти</h5>
        <ul class="list-unstyled components mb-5">
            <li>
                <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Запасные части</a>
                <ul class="collapse list-unstyled" id="pageSubmenu1">
                    <li><a href="/products/mercedes-benz"><span class="fa fa-chevron-right mr-2"></span> Mercedes-benz запчасти</a></li>
                    <li><a href="/stock/a2a12edf-1642-11ee-0a80-13ab00041ab9"><span class="fa fa-chevron-right mr-2"></span> GMS Водяные насосы</a></li>
                    <li><a href="/stock/81cf7449-727a-11ee-0a80-130600173515"><span class="fa fa-chevron-right mr-2"></span> POWERHUB диски/колодки</li>
                    <li><a href="/stock/d295833c-8399-11ee-0a80-0fb9000b7477"><span class="fa fa-chevron-right mr-2"></span> POWERHUB фильтры</a></li>
                    <li><a href="/stock/e3295a56-770c-11ee-0a80-096e0020d4ec"><span class="fa fa-chevron-right mr-2"></span> AYKU IDEAL КОЛЕНВАЛЫ</a></li>
                    <li><a href="/stock/ef56740b-77e0-11ee-0a80-0cfa001004ff"><span class="fa fa-chevron-right mr-2"></span> MVS Маховики</a></li>
                    <li><a href="/stock/6f6ad146-794c-11ee-0a80-0290001d2dad"><span class="fa fa-chevron-right mr-2"></span> SUNEX клапана ДВС</a></li>
                    <li><a href="/stock/c07653f3-5d3d-11ee-0a80-0418001257ed"><span class="fa fa-chevron-right mr-2"></span> TURBO SuotePower</a></li>
                     <li><a href="/stock/416a3aff-0f66-11ee-0a80-0d9c00124798"><span class="fa fa-chevron-right mr-2"></span>ЗАПАСНЫЕ части СКЛАД 2</a></li>
                </ul>
            </li>
        </ul>
        <div class="mb-5">
            <h5 style="color: black">Востребованные Товары</h5>
            <div class="tagcloud">
                <a href="/product/mercedes-benz/2d667681-328f-11ee-0a80-1016000f76fa" class="tag-cloud-link">A0003238185</a>
                
                <a href="/product/mercedes-benz/0585bb51-3213-11ee-0a80-139a002d8414" class="tag-cloud-link">A4700908352</a>
                
                <a href="/product/mercedes-benz/f97e0afa-56e0-11ee-0a80-1382000e4782" class="tag-cloud-link">A9064200320</a>
                
                <a href="/product/mercedes-benz/062178a5-3213-11ee-0a80-139a002d8458" class="tag-cloud-link">A9604200120</a>
                
                <a href="/product/mercedes-benz/933734e7-6e75-11ee-0a80-14270010b11b" class="tag-cloud-link">A9360903755</a>
                
                <a href="/product/mercedes-benz/069710e6-3213-11ee-0a80-139a002d848c" class="tag-cloud-link">A4710902755</a>
                
                <a href="/product/mercedes-benz/07320620-3213-11ee-0a80-139a002d84d0" class="tag-cloud-link">A0290742502</a>
                
                 <a href="/product/mercedes-benz/081bb31f-3213-11ee-0a80-139a002d8538" class="tag-cloud-link">A4720780480</a>
                 
                 <a href="/product/mercedes-benz/0849fff3-3213-11ee-0a80-139a002d854a" class="tag-cloud-link">A5410161620</a>
                 
                 <a href="/product/mercedes-benz/08f449f4-3213-11ee-0a80-139a002d85af" class="tag-cloud-link">A0169975746</a>
                 
                 <a href="/product/mercedes-benz/856b2840-3213-11ee-0a80-008300270a52" class="tag-cloud-link">A0060179721</a>
                 
                 <a href="/product/mercedes-benz/0c0219a3-3213-11ee-0a80-139a002d87c9" class="tag-cloud-link">A0018206745</a>
                 
                 <a href="/product/mercedes-benz/07725742-3213-11ee-0a80-139a002d84ec" class="tag-cloud-link">A9616902244 8R35</a>
            </div>
        </div>
        {{-- <div class="mb-5">
            <h5>Newsletter</h5>
            <form action="#" class="subscribe-form">
                <div class="form-group d-flex">
                    <div class="icon"><span class="icon-paper-plane"></span></div>
                    <input type="text" class="form-control" placeholder="Enter Email Address">
                </div>
            </form>
        </div> --}}
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
    
</div>
        </div> -->
            
            
            
            <div class="row g-2" itemscope itemtype="https://schema.org/Product">
                @foreach ($product["rows"] as $item)
                    <template v-if="design === 'line'">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-white py-2 px-3 shadow-sm mb-1 rounded">
                                <div class="d-flex gap-3 w-50 align-items-center">
                                    <div style="width: 50px;height: 50px;overflow: hidden;background: #ddd;border-radius: 5px">
                                        @include('layout.main.ui.card.card-image')
                                    </div>
                                    <div class="text-start">
                                        @include('layout.main.ui.card.card-title') 
                                    </div>                                    
                                </div>
                                <div class="w-25">
                                    @include('layout.main.ui.quantity.quantity')
                                </div>
                                <div class="px-4">
                                    @include('layout.main.ui.logo.car-logo', ['stock' => $item['productFolder']])
                                </div>
                                <div>
                                    @include('layout.main.ui.button.card-button')
                                </div>
                            </div>
                        </div>                        
                    </template>
                    <template v-else>
                        <div class="col-lg-3 col-12">
                            <div class="card card-data border-0 shadow-sm order">
                                @include('layout.main.ui.card.card-image')
                                <div class="card-body">
                                    <div style="height: 39px">
                                        @include('layout.main.ui.card.card-title')                                    
                                    </div>
                                    <hr style="color: #ddd">
                                    @include('layout.main.ui.quantity.quantity')
                                    <hr style="color: #ddd">
                                    <div class="d-flex align-items-center justify-content-between">
                                        @include('layout.main.ui.logo.car-logo', ['stock' => $item['productFolder']])
                                        <div>
                                            @include('layout.main.ui.button.card-button')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                @endforeach                    


                @if (isset($product['meta']['nextHref']) || $offset > 0)
                    <div class="mt-5 d-flex align-items-center justify-content-between">
                        <div>
                            <select id="selectOffsetBottom" class="form-select" onchange="selectOffsetBottom()">
                                @foreach ([12, 24, 48, 64, 100] as $key)
                                    <option value="/products/mercedes-benz/{{$key}}/0" @if($key == $limit) selected @endif >
                                        {{$key}}
                                    </option>
                                @endforeach
                            </select>                        
                        </div>
                        <nav>
                            <ul class="pagination m-0">
                                @if (isset($product['meta']['previousHref']))
                                    <?php 
                                        $url_previous = parse_url($product['meta']['previousHref'], PHP_URL_QUERY);
                                        parse_str($url_previous, $previous);
                                    ?>
                                    <li class="page-item p-0">
                                        <a class="page-link text-primary border-0" href="/products/mercedes-benz/{{$previous['limit']}}/{{$previous['offset']}}">
                                            <span>&laquo;</span> Назад
                                        </a>
                                    </li>  
                                @else
                                    <li class="page-item p-0 disabled">
                                        <a class="page-link border-0">
                                            <span>&laquo;</span> Назад
                                        </a>
                                    </li>                                
                                @endif

                                @if (isset($product['meta']['nextHref']))
                                    <?php 
                                        $url_next = parse_url($product['meta']['nextHref'], PHP_URL_QUERY);
                                        parse_str($url_next, $next);
                                    ?>
                                    <li class="page-item p-0">
                                        <a class="page-link text-primary border-0" href="/products/mercedes-benz/{{$next['limit']}}/{{$next['offset']}}">
                                            Далее <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>                                
                                @else
                                @endif

                            </ul>
                        </nav>
                        <div>
                            Показано: 
                            <span>
                                @if($product['meta']['size']-$offset < $limit)
                                    {{$offset+$product['meta']['size']-$offset}}
                                @else
                                    {{$offset == 0 ? $limit : $limit+$offset}}
                                @endif
                            </span> из 
                            <span>{{$product['meta']['size']}}</span>
                        </div>
                    </div>
                @endif
            </div>        
        @endif
    </div>
</section>
@endsection