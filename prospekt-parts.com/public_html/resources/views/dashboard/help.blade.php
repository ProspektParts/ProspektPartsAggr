@extends('layout/main')
@section('title', 'Помощь')

@section('content')
<h6 class="text-muted">Вы можете связаться с нами по всем вашим вопросам.</h6>
<h6 class="text-muted">Все наши актуальные контакты.</h6>
<div class="row mt-4">
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex flex-column rounded">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="/img/contact/newsletter.png" style="width: 40px" alt="E-mail" />
                        <div class="d-grid gap-2">
                            <strong>По вопросам сотрудничества: </strong> 
                            {!! $contact::getEmail(config('app.email'), ['text-muted']) !!}                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div>
                    <strong>Связаться с менеджером:</strong> 
                    <div class="d-flex gap-2 mt-2">
                        <x-icon-call size="22px" color="#310062"/>
                        {!! $contact::getPhone(config('app.phone'), ['text-muted']) !!}
                    </div>
                </div> 
            </div>
        </div>
    </div>    
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div>
                    <strong>Связаться с тех.поддержкой:</strong> 
                    <div class="d-flex gap-2 mt-2">
                        <x-icon-call size="22px" color="#310062"/>
                        {!! $contact::getPhone('89151389077', ['text-muted']) !!}
                    </div> 
                </div> 
            </div>
        </div>
    </div>

</div>
@endsection