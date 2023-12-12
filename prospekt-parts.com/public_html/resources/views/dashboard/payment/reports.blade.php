@extends('layout/main')
@section('title', 'Заказы')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header d-flex align-items-center justify-content-between bg-white border-0">
        <div class="mb-2 mb-md-0">
            <form>
                <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text bg-white border-end-0 border-light ps-2 pe-0">
                        <span class="material-symbols-outlined text-secondary fs-5">search</span>
                    </div>
                    <input id="datatableSearch" type="search" placeholder="Поиск заказов" class="form-control border-light border-start-0" />
                </div>
            </form>
        </div>
        <div class="d-grid d-sm-flex gap-2">
            <div class="dropdown">
                <button 
                    id="usersExportDropdown" 
                    data-bs-toggle="dropdown" 
                    class="d-flex align-items-center gap-1 btn btn-white btn-sm dropdown-toggle w-100"
                >
                    <span class="material-symbols-outlined text-secondary fs-6">download</span>Экспорт
                </button> 
                <div aria-labelledby="usersExportDropdown" class="dropdown-menu dropdown-menu-sm-end">
                    <span class="dropdown-header">Варианты загрузки</span> 
                    <a id="export-excel" href="javascript:;" class="dropdown-item">
                        <img src="/img/card/excel-icon.svg" alt="..." class="avatar avatar-xss avatar-4x3 me-2" style="width: 30px" />
                        Excel
                    </a> 
                    <a id="export-csv" href="javascript:;" class="dropdown-item">
                        <img src="/img/card/placeholder-csv-format.svg" alt="..." class="avatar avatar-xss avatar-4x3 me-2" style="width: 30px" />
                        .CSV
                    </a> 
                    <a id="export-pdf" href="javascript:;" class="dropdown-item">
                        <img src="/img/card/pdf-icon.svg" alt="..." class="avatar avatar-xss avatar-4x3 me-3" style="width: 27px" />
                        PDF
                    </a>
                </div>
            </div>
            <div class="dropdown">
                <button id="showHideDropdown" data-bs-toggle="dropdown" class="d-flex align-items-center gap-1 btn btn-white btn-sm w-100">
                    <span class="material-symbols-outlined text-secondary fs-6">table</span>
                    Столбцы
                    <span class="badge bg-soft-dark text-dark rounded-circle ms-1">7</span>
                </button> 
                <div aria-labelledby="showHideDropdown" class="dropdown-menu dropdown-menu-end dropdown-card" style="width: 15rem">
                    <div class="card card-sm border-0">
                        <div class="card-body py-1 pe-0">
                            <div class="d-grid gap-2 ms-2">
                                <label for="toggleColumn_order" class="row form-check form-switch">
                                    <span class="col-8 col-sm-9 ms-0">
                                        <span class="me-2">Заказ</span>
                                    </span> 
                                    <span class="col-4 col-sm-3 text-end">
                                        <input type="checkbox" id="toggleColumn_order" checked="checked" class="form-check-input" />
                                    </span>
                                </label> 
                                <label for="toggleColumn_date" class="row form-check form-switch">
                                    <span class="col-8 col-sm-9 ms-0">
                                        <span class="me-2">Дата</span>
                                    </span> 
                                    <span class="col-4 col-sm-3 text-end">
                                        <input type="checkbox" id="toggleColumn_date" checked="checked" class="form-check-input" />
                                    </span>
                                </label> 
                                <label for="toggleColumn_payment_status" class="row form-check form-switch">
                                    <span class="col-8 col-sm-9 ms-0">
                                        <span class="me-2">Статус платежа</span>
                                    </span> 
                                    <span class="col-4 col-sm-3 text-end">
                                        <input type="checkbox" id="toggleColumn_payment_status" checked="checked" class="form-check-input" />
                                    </span>
                                </label> 
                                <label for="toggleColumn_fulfillment_status" class="row form-check form-switch">
                                    <span class="col-8 col-sm-9 ms-0">
                                        <span>Статус выполнения</span>
                                    </span> 
                                    <span class="col-4 col-sm-3 text-end">
                                        <input type="checkbox" id="toggleColumn_fulfillment_status" checked="checked" class="form-check-input" />
                                    </span>
                                </label> 
                                <label for="toggleColumn_payment_method" class="row form-check form-switch">
                                    <span class="col-8 col-sm-9 ms-0">
                                        <span class="me-2">Способ оплаты</span>
                                    </span> 
                                    <span class="col-4 col-sm-3 text-end">
                                        <input type="checkbox" id="toggleColumn_payment_method" checked="checked" class="form-check-input" />
                                    </span>
                                </label> 
                                <label for="toggleColumn_total" class="row form-check form-switch">
                                    <span class="col-8 col-sm-9 ms-0">
                                        <span class="me-2">Всего</span>
                                    </span> 
                                    <span class="col-4 col-sm-3 text-end">
                                        <input type="checkbox" id="toggleColumn_total" class="form-check-input" />
                                    </span>
                                </label> 
                                <label for="toggleColumn_actions" class="row form-check form-switch">
                                    <span class="col-8 col-sm-9 ms-0">
                                        <span class="me-2">Действия</span>
                                    </span> 
                                    <span class="col-4 col-sm-3 text-end">
                                        <input type="checkbox" id="toggleColumn_actions" checked="checked" class="form-check-input" />
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive datatable-custom">
        <div id="datatable_wrapper" class="dataTables_wrapper no-footer">

            <table class="table table-hover table-thead-bordered mb-2">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3 text-muted" style="width: 24px;">
                            <label>#</label>
                        </th>
                        <th class="text-muted" style="width: 70px;"><small>Заказ</small></th>
                        <th class="text-muted" style="width: 125px;"><small>Дата</small></th>
                        <th class="text-muted" style="width: 180px;"><small>Контрагент</small></th>
                        <th class="text-muted" style="width: 124px;text-align: center"><small>Статус заказа</small></th>
                        <th class="text-muted" style="width: 124px;"><small>Сумма платежа</small></th>
                        <th class="text-secondary text-center" style="width: 119px;"><small>Действия</small></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports['list'] as $item)
                    <tr>
                        <td class="ps-3" style="vertical-align: middle">{{$loop->iteration}}.</td>
                        <td class="table-column-ps-0" style="vertical-align: middle">
                            <a href="reports/{{$item['id']}}" class="fw-bold text-dark text-decoration-none">
                                #{{$item['name']}}
                            </a>
                        </td>
                        <td style="vertical-align: middle">
                            <small class="text-muted">
                                {{$time::parse($item['created'])->locale('ru')->translatedFormat('d M. Y / H:i')}}
                            </small>
                        </td>
                        <td style="vertical-align: middle"><small>{{$item['agent']['name']}}</small></td>
                        <td style="vertical-align: middle;text-align: left">
                            <x-badge 
                                color="{{$item['state']['color']}}" 
                                text="{{$item['state']['name']}}" 
                            />
                        </td>
                        <td style="vertical-align: middle">
                            {!!$currency::summa($item['sum'])!!}
                            <!-- <div class="d-flex align-items-center">
                                <img src="/img/card/mastercard.svg" alt="..." class="me-2" style="width: 22px" /> 
                                <span class="text-dark">•••• 4242</span>
                            </div> -->
                        </td>
                        <td style="text-align: right">
                            <a href="reports/{{$item['id']}}" class="d-flex align-items-center gap-1 btn btn-white btn-sm">
                                <span class="material-symbols-outlined fs-6">visibility</span> 
                                Посмотреть
                            </a>                         
                            <!-- <div class="btn-group">
                                <div class="btn-group">
                                    <button type="button" id="ordersExportDropdown1" data-bs-toggle="dropdown" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty"></button> 
                                    <div aria-labelledby="ordersExportDropdown1" class="dropdown-menu dropdown-menu-end mt-1">
                                        <a href="javascript:;" class="d-flex align-items-center gap-1 dropdown-item">
                                            <span class="text-secondary material-symbols-outlined fs-5">print</span>
                                            Распечатать
                                        </a> 
                                        <a href="javascript:;" class="d-flex align-items-center gap-1 dropdown-item">
                                            <span class="text-secondary material-symbols-outlined fs-5">delete</span>
                                            Удалить
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 pt-0">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                    <span class="text-secondary me-2">Показано:</span> 
                    <div class="tom-select-custom">
                        <select id="datatableEntries" autocomplete="off" class="border-0 form-select text-secondary w-auto">
                            <option value="12" selected="selected">12</option>
                            <option value="14">14</option>
                            <option value="16">16</option>
                            <option value="18">18</option>
                        </select>
                    </div>
                    <span class="text-secondary me-2">из</span> <span class="text-secondary">20</span>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="d-flex justify-content-center justify-content-sm-end">
                    <nav id="datatablePagination" aria-label="Activity pagination">
                        <div id="datatable_paginate" class="dataTables_paginate paging_simple_numbers">
                            <ul id="datatable_pagination" class="pagination m-0">
                                <li class="paginate_item page-item disabled">
                                    <a id="datatable_previous" class="paginate_button previous page-link">
                                        <span aria-hidden="true">←</span>
                                    </a>
                                </li>
                                <li class="paginate_item page-item active">
                                    <a class="paginate_button page-link">1</a>
                                </li>
                                <li class="paginate_item page-item">
                                    <a class="paginate_button page-link">2</a>
                                </li>
                                <li class="paginate_item page-item">
                                    <a id="datatable_next" class="paginate_button next page-link">
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>                 
@endsection