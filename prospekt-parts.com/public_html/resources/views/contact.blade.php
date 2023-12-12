@extends('layout/index', [
    'title' => 'Контакты | Проспект Партс',
    'keywords' => 'контакты, сервис, service, чинить, автосервис, мерседес бенц, актрос',
    'description' => 'Контактная информация компании ООО '.config('app.name'),
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Контакты')

@section('content')
<div class="w-100 bg-primary" style="height: 170px">
    <div class="d-flex justify-content-center align-items-center h-100" style="background-color: #00000059">
        <h2 class="text-white pt-5 mb-0 mt-1">Контакты</h2>
    </div>
</div>
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row text">
                    <div class="col-12 col-md-4">
                        <h3 class="text-dark mb-4">ООО {{ config('app.name') }}</h3>
                        <p><strong>ИНН:</strong> 9715447266</p>
                        <p><strong>ОГРН:</strong> 1237700266726</p>
                        <p><strong>КПП:</strong> 771501001</p>   
                        
                        <iframe src="https://yandex.ru/sprav/widget/rating-badge/8347363005?type=rating" width="150" height="50" frameborder="0"></iframe>         
                        {{-- &theme=dark --}}
                        <div class="d-flex align-items-center gap-3 mt-5">
                            <div class="border p-2" style="width:100px">
                                <img src="/img/qr.png" class="w-100" alt="QR код" />
                            </div>      
                            <div>
                                <strong>QR-code Визитка</strong>  
                                <p class="m-0">для мобильного телефона.</p> 
                                <a href="https://yandex.ru/maps/-/CCUG7IeaKC" class="badge bg-dark text-decoration-none" target="_blank" rel="noopener noreferrer">
                                    Оставить отзыв
                                </a>
                            </div>                          
                        </div>
                        <div class="d-block mt-3 mb-5 mb-lg-0">
                            <a href="/doc" class="text-muted">Юридическая информация</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="d-flex flex-column border rounded p-3 mb-2 bg-white">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="/img/contact/newsletter.png" style="width: 40px" alt="E-mail" />
                                <div class="d-grid">
                                    <strong>По вопросам сотрудничества: </strong> 
                                    {!! $contact::getEmail(config('app.email'), ['text-muted']) !!}                                    
                                </div>
                            </div>
                        </div>
                        <div class="row gx-2">
                            <div class="col-12 col-lg-6">
                                <div class="border rounded p-3 mb-2 bg-white">
                                    <strong>Связаться с менеджером:</strong> 
                                    <div class="d-flex gap-2 mt-2">
                                        <x-icon-call size="22px" color="#310062"/>
                                        {!! $contact::getPhone(config('app.phone'), ['text-muted']) !!}
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="border rounded p-3 mb-2 bg-white">
                                    <strong>Связаться с тех.поддержкой:</strong> 
                                    <div class="d-flex gap-2 mt-2">
                                        <x-icon-call size="22px" color="#310062"/>
                                        {!! $contact::getPhone('89151389077', ['text-muted']) !!}
                                    </div> 
                                </div> 
                            </div>
                            {{-- <div class="col-12 col-lg-4">
                                <div class="border rounded p-3 mb-2 bg-white">
                                    <strong>По корпоративным<br /> вопросам:</strong> 
                                    <div class="d-flex gap-2 mt-2">
                                        <x-icon-call size="22px" color="#310062"/>
                                        $contact::getPhone('84957682473', ['text-muted'])
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div class="d-flex flex-column border rounded p-3 mb-2 bg-white">
                            <strong>Юридический адрес:</strong> 
                            <div class="d-flex gap-1 align-items-center">
                                <x-icon-location size="25px" color="#310062"/> {{ config('app.address') }}
                            </div>
                        </div>
                        <div class="d-flex flex-column border rounded p-3 bg-white">
                            <strong>Фактический адрес:</strong> 
                            <div class="d-flex gap-1 align-items-center">
                                <x-icon-location size="25px" color="#310062"/> 141006, г.Мытищи, Московская область, 4536-й проезд, стр. 10
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
<div class="bg-light border-top">
    <p class="container mb-1 text">
        <strong>Фактический Адрес:</strong> 
        <a href="https://yandex.ru/maps/-/CCUG7IeaKC" class="text-dark" target="_blank" rel="noopener noreferrer">
            141006, г.Мытищи, Московская область, 4536-й проезд, стр. 10
        </a> 
    </p>
    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Acb78d2e01e4906db46d1cb905adc20776626bb0d53f91909978164445bf6ffa7&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
</div>
@endsection