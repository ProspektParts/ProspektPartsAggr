@extends('layout/index', [
    'title' => 'Наше производство | Проспект Партс',
    'keywords' => 'сервис, service, компания, автосервис, мерседес бенц, актрос',
    'description' => 'Информация о компании.',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Производство')

@section('content')
<div class="w-100" style="background-image: url(/img/sklad.jpg);background-position: center -180px;background-attachment: fixed;background-size: cover;height: 250px;text-shadow: 1px 2px 3px #000">
    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: rgb(0 0 0 / 62%)">
        <h2 class="text-white pt-5 mb-0">Производство</h2>
    </div>
</div>
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 text">
                <div class="d-flex align-items-center justify-content-center gap-4 mb-5">
                    <img src="/img/guayaquillib/renault.png" alt="Renault" style="width: 40px" />
                    <img src="/public/img/mercedes-benz.png" alt="Mercedes-Benz" style="width: 40px" />
                    <img src="/img/guayaquillib/volvo.png" alt="Volvo" style="width: 40px" />
                </div>
                <h2 class="fw-bold text-center mb-4">Медиа {{ config('app.name') }} <img src="/img/about/offer.png" style="width: 80px" alt="offer" /></h2>
                <hr class="bar" />
                
                <p class="text-justify">
                    <strong>Видео о нашей продукции ,а также видео: </strong> — крупнейший дистрибьютор автомобильных запасных частей, 
                    компонентов и расходных материалов на рынке Восточной Европы.
                </p>
            </div>
            
            
            
        </div>
        
        
        
    </div>
</section>


       <div class="content">

                    <div class="video-gallery"> 
                      <figure class="gallery-item"> 
                        <img src="https://i.vimeocdn.com/video/548219872_1280.jpg" alt="Editor Reel"/>
                        <figcaption>
                          <div>
                            <h2>Editor <span>Reel</span></h2>
                            <p>Personal highlights of work</p>
                          </div> 
                          <a class="vimeo-popup" href="https://i.vimeocdn.com/video/548219872_1280.jpg" >View more</a>
                        </figcaption>			
                      </figure>
                              
                              
                          <figure class="gallery-item">
                        <img src="https://i.vimeocdn.com/video/545880891_1280.jpg" alt="True Facet"/>
                        <figcaption>
                          <div>
                            <h2>True <span>Facet</span></h2>
                            <p>Web commercial</p>
                          </div>
                          <a class="vimeo-popup" href="https://vimeo.com/147262512">View more</a>
                        </figcaption>			              
                      </figure>
                         
                      <figure class="gallery-item">
                        <img src="https://i.vimeocdn.com/video/544782555_1280.jpg" alt="Dirty Rotten Survival"/>
                        <figcaption>
                          <div>
                            <h2>Dirty <span>Rotten </span>Survival</h2>
                            <p>National Geographic Channel | Episode: Timber!</p>
                          </div>
                          <a class="vimeo-popup" href="https://vimeo.com/146398302">View more</a>
                        </figcaption>			
                      </figure>
                       
                      <figure class="gallery-item">
                        <img src="https://i.vimeocdn.com/video/548225675_1280.jpg" alt="Amazing Wedding Cakes"/>
                        <figcaption>
                          <div>
                            <h2>Amazing <span>Wedding </span>Cakes</h2>
                            <p>weTV | Episode: Crazy Client Requests</p>
                          </div>
                          <a class="vimeo-popup" href="https://vimeo.com/124839857">View more</a>
                        </figcaption>			
                      </figure>
                              
                              
                      <figure class="gallery-item">
                        <img src="https://i.vimeocdn.com/video/514737858_1280.jpg" alt="Sober Trailer"/>
                        <figcaption>
                          <div>
                            <h2>Sober <span>Trailer</span></h2>
                            <p>Original movie trailer</p>
                          </div>
                          <a class="vimeo-popup" href="https://vimeo.com/124853389">View more</a>
                        </figcaption>			
                      </figure>     
                         
                              
                      <figure class="gallery-item">
                        <img src="https://i.vimeocdn.com/video/514715300_1280.jpg" alt="Bait Car"/>
                        <figcaption>
                          <div>
                            <h2>Bait <span>Car</span></h2>
                            <p>TruTV | Episode: Catch and Release</p>
                          </div>
                          <a class="vimeo-popup" href="https://vimeo.com/124840953">View more</a>
                        </figcaption>			
                      </figure>     
                         
                              
                      <figure class="gallery-item">
                        <img src="https://i.vimeocdn.com/video/539646688_1280.jpg" alt="FarmersChile.com"/>
                        <figcaption>
                          <div>
                            <h2>FarmersChile <span>.com</span></h2>
                            <p>Truffle Reel</p>
                          </div>
                          <a class="vimeo-popup" href="https://vimeo.com/141566799">View more</a>
                        </figcaption>			
                      </figure>      
                            
                              
                      <figure class="gallery-item">
                        <img src="https://i.vimeocdn.com/video/514731176_1280.jpg" alt="Sober Scene One"/>
                        <figcaption>
                          <div>
                            <h2> <span>Sober</span></h2>
                            <p>Scene one</p>
                          </div>
                          <a class="vimeo-popup" href="https://vimeo.com/124852939">View more</a>
                        </figcaption>			
                      </figure>       
                       
                    </div>
                  </div>



<section class="bg-body-tertiary">
    <div class="container">
        <div class="row">
            <div class="text-center col-12">
                <h5 class="text-primary m-0 text" style="color: #000">Мы занимаемся</h5> 
                <h2 class="fw-bold">Фотографии нашей продукции</h2> 
                <hr class="bar mb-5">
            </div>
        </div>
        <div class="row g-2">
            {{-- <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/about/goods.png" 
                            alt="Продажа" 
                            class="w-50" 
                            style="cursor: default;filter: saturate(100%);height: auto; opacity: 1" 
                        /> 
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Продажа</h5>
                        <p class="text-muted">
                            только оригинальных запасных частей для грузовых автомобилей
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/about/manufacturer.png" 
                            alt="Диагностика" 
                            class="w-50" 
                            style="cursor: default;filter: saturate(100%);height: auto; opacity: 1" 
                        /> 
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Диагностика</h5>
                        <p class="text-muted">
                            и ремонт грузовых автомобилей импортного производства.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/actros___kopiya.png" 
                            alt="Импорт" 
                            class="w-75 mb-1" 
                            style="cursor: default;filter: saturate(100%); height: auto; opacity: 1" 
                        />
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Импорт</h5>
                        <p class="text-muted">
                            оригинальных запчастей для грузовых автомобилей мы закупаем напрямую у изготовителей.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/about/logistic.png" 
                            alt="Логистика" 
                            class="w-50" 
                            style="cursor: default;filter: saturate(100%); height: auto; opacity: 1" 
                        />
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Логистика</h5>
                        <p class="text-muted">
                            Сами оформляем контракт и осуществляем логистику.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/about/customs.png" 
                            alt="Логистика" 
                            class="w-50" 
                            style="cursor: default;filter: saturate(100%); height: auto; opacity: 1" 
                        />
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Таможенное оформление</h5>
                        <p class="text-muted">
                            Поэтому у каждого нашего товара есть <abbr title="Грузовая Таможенная Декларация" class="initialism">ГТД</abbr>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/about/storing.png" 
                            alt="Складирование товара" 
                            class="w-50" 
                            style="cursor: default;filter: saturate(100%); height: auto; opacity: 1" 
                        />
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Складирование товара</h5>
                        <p class="text-muted">
                            У нас собственные складские помещения.
                        </p>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="text-center col-12 mt-4 col-lg-8 offset-lg-2">
                <p class="fs-3 text">
                    <sub class="text-danger fs-1">*</sub> 
                    Для наших клиентов это означает оптимальные цены на качественные запасные части из Европы.
                </p>
            </div>
        </div>
    </div>
</section>


<script>

</script>

@endsection