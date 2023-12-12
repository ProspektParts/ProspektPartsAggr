@if(isset($item['article']))
    <div class="col-lg-3 col-12">
        <div class="card card-data border-0 shadow order">
            <a href="/product/mercedes-benz/{{$item['id']}}" class="card-body pb-0 position-relative">
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
                        {{ $item['name'] }}
                    </a>
                </h5>
                <hr style="color: #ddd" />
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="{{$images::quantity($item['quantity'])['class']}}">
                            {{$images::quantity($item['quantity'])['text']}}
                        </p>                              
                    </div>
                    <strong>
                        {!!$currency::summa($item['salePrices'][0]['value'])!!}
                    </strong>                            
                </div>
                <hr style="color: #ddd">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div>
                            <img src="/img/mercedes-benz.png" alt="Mercedes-Benz" style="width: 37px;height: 37px">
                        </div>
                        <div class="lh-sm">
                            <small class="text-muted d-block w-100">
                                {{$item['article']}}                                            
                            </small>
                            <strong class="text-secondary">Mercedes-Benz</strong>
                        </div>
                    </div>
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