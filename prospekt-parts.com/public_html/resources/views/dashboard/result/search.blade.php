@php
    $size = isset($error) || $search === null ? 0 : $search['meta']['size'];
@endphp
@extends('layout/main')
@section('title', 'Результат поиска: "'.$text.'"')

@section('content')
    <hr />
    @if (isset($error) && $size !== 0)
        <x-alert type="danger" message="{{$error}}" />
    @endif
    @if($size === 0)
        @include('layout.main.ui.empty.no-result', [
            'text' => $text, 
            'link' => '/dashboard/catalog/category/8854033a-48ad-11ed-0a80-0c87007f4175/10/0',
            'dashboard' => true
        ])
    @else
        <p class="text-muted">{{$decl::search($size)}} <span class="badge bg-soft-danger text-danger rounded-pill">{{$size}}</span> </p>        
        <div class="row g-2">
            @foreach($search['rows'] as $item)
            <div class="col-12" :class="[!isOpen ? 'col-lg-3' : 'col-lg-4']">
                <div class="card card-data border-0 shadow">
                    @include('layout.main.ui.card.card-admin-image')
                    <div class="card-body">
                        <h5 class="card-title fs-5 mb-3">
                            <a 
                                href="/dashboard/product/details/{{$item['id']}}" 
                                title="{{$item['name']}}" 
                                class="text-dark fw-bold text-decoration-none w-100 text-truncate d-inline-block"
                            >
                                {{$item['name']}}
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
@endsection