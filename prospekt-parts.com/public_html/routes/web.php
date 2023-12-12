<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DachboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\RSSFeedController;
use App\Http\Middleware\Authenticate;


Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('', [DachboardController::class, 'Dashboard'])->name('dashboard');
    Route::get('result/search', [DachboardController::class, 'noSearch']);
    Route::post('result/search', [DachboardController::class, 'resultSearch']);
    Route::post('search', [DachboardController::class, 'searchDashboard']);
    Route::get('card', [DachboardController::class, 'Сard'])->name('card');
    Route::get('help', [DachboardController::class, 'Help']);
    Route::get('events', [DachboardController::class, 'Events']);
    Route::get('notifications', [DachboardController::class, 'Notifications']);
    Route::get('work/schedule', [DachboardController::class, 'Schedule']);
    Route::post('settings', [DachboardController::class, 'EditSettings']);
    Route::get('settings/profile', [DachboardController::class, 'Settings'])->name('settings');
    Route::match(['get', 'post'],'product/details/{id}', [DachboardController::class, 'DetailProduct'])->name('productdetails');
    Route::get('catalog/category/{name}/{limit?}/{offset?}', [DachboardController::class, 'CatalogDetail']);
    Route::get('payment/preorder/{id}', [DachboardController::class, 'preOrderViewOne']);
    Route::get('payment/preorders', [DachboardController::class, 'preOrders'])->name('preorders');
    Route::get('payment/orders', [DachboardController::class, 'Orders'])->name('orders');
    Route::get('payment/order/{invoice}', [DachboardController::class, 'Invoice']);
    Route::get('payment/record', [DachboardController::class, 'Record'])->name('record');
    Route::get('payment/record/{id}', [DachboardController::class, 'RecordDetail']);
    Route::get('account', [DachboardController::class, 'Account'])->name('account');;
    Route::get('payment/reports', [DachboardController::class, 'Reports']);
    Route::get('payment/reports/{order}', [DachboardController::class, 'ReportsDetail'])->name('order');
    Route::get('organization/{id}/file{extension?}', [PDFController::class, 'getOrganizationCard'])->where(['extension' => '^(.pdf)|(.csv)|(.json)$']);
    Route::get('organization/{id}/download{extension?}', [PDFController::class, 'getOrganizationCardDownload'])->where(['extension' => '^(.pdf)|(.csv)|(.json)$']);
    Route::get('doc/{id}/{name}{extension?}', [PDFController::class, 'generatePDF'])->where(['extension' => '^(.pdf)|(.csv)|(.json)$']);
    Route::get('contract/{type}/{id}/{name}{extension?}', [PDFController::class, 'contractGenerate'])->where(['extension' => '^(.pdf)|(.csv)|(.json)$']);
    Route::get('contract/download/{type}/{id}/{name}{extension?}', [PDFController::class, 'contractDownload'])->where(['extension' => '^(.pdf)|(.csv)|(.json)$']);
    Route::get('document/agreement', [DachboardController::class, 'Agreement'])->name('contract');
    Route::get('document/agreement/edit', [DachboardController::class, 'EditAgreement']);
    Route::post('/create/invoice', [DachboardController::class, 'createInvoice']);
    Route::post('/agreements', [DachboardController::class, 'sendAgreement']);
    Route::post('/agreements/update', [DachboardController::class, 'updateAgreement']);
    Route::post('/action/deal', [DachboardController::class, 'sendDeal']);
    Route::post('upd/pdf/export', [DachboardController::class, 'getUPD']);
    Route::get('/promo/{uuid?}', [MainController::class, 'PromoView']);
    Route::get('/promo/catalog/{id?}', [MainController::class, 'PromoCatalog']);    
    Route::get('accounts/{limit?}/{offset?}', [DachboardController::class, 'Accounts']);
    
    Route::get('about', [MainController::class, 'about'])->name('about');
    Route::get('production', [MainController::class, 'production'])->name('production');
    
    Route::get('/stock/{id}/{limit?}/{offset?}', [MainController::class,'stockFolder']);
    
    //document for dashboarduser
    Route::get('doc/license', [MainController::class, 'License']);
    Route::get('doc/responsibility', [MainController::class, 'Responsibility']);
    Route::get('doc/privatepolice', [MainController::class, 'Private']);
    Route::get('doc/return-policy', [MainController::class, 'ReturnPolicy']);
    Route::get('doc/guaranty', [MainController::class, 'Guaranty']);
    
    
    
    
    // Admin-Панель
    Route::get('admin/stock', [AdminController::class, 'stockTable'])->name('stockable');
    Route::get('mail/inbox', [AdminController::class, 'Email']);
    Route::get('users', [DachboardController::class, 'Users']);
    Route::get('orders', [DachboardController::class, 'OrdersList'])->name('allorders');
    Route::post('orders/delete/{uuid}', [DachboardController::class, 'OrdersListDelete']);
    Route::post('agent/delete/{uuid}', [DachboardController::class, 'AgentDelete']);
    Route::get('admin/doc', [AdminController::class, 'adminDoc']);
    Route::get('admin/accounting', [AdminController::class, 'Accounting']);
    Route::get('admin/users', [AdminController::class, 'Users'])->name('adminusers');
    Route::get('admin/contracts', [AdminController::class, 'Contracts']);
    Route::get('admin/contract/{id}', [AdminController::class, 'oneContract']);
    Route::get('admin/access/{id?}', [AdminController::class, 'Access']);
    Route::get('admin/users/okved/{okved}', [AdminController::class, 'Okved']);
    Route::get('admin/user/{uuid}', [AdminController::class, 'User']);
    Route::get('admin/nomenclature', [AdminController::class, 'Nomenclature']);
    Route::get('/admin/nomenclature/gtd/{id}', [AdminController::class, 'Gtd']);
    Route::get('admin/promo', [AdminController::class, 'Promo']);
    Route::get('admin/posting', [AdminController::class, 'Posting']);
});

Route::prefix('api')->group(function () {
    Route::post('files', [MainController::class, 'Files']);
    Route::post('files/delete', [MainController::class, 'FilesDelete']);
    Route::post('loadstock', [ApiController::class, 'loadStock']);
    Route::post('download/files', [ApiController::class, 'downloadFiles']);
    Route::post('signup', [AuthController::class, 'Sigature']);
    Route::post('customer', [AuthController::class, 'Customer']);
    Route::post('mail', [AuthController::class, 'SendMail']);
    Route::post('spares', [DachboardController::class, 'SendSpares']);
    Route::post('array/pack', [DachboardController::class, 'arrayPack']);
    Route::post('checkout', [DachboardController::class, 'Checkout']);
    Route::post('precheckout', [DachboardController::class, 'preCheckout']);
    Route::post('counterparty', [DachboardController::class, 'addedCounterAgent']);
    Route::post('manager', [DachboardController::class, 'Manager']);
    Route::post('description', [DachboardController::class, 'Description']);
    Route::post('active/{id}', [AdminController::class, 'activeContract']);
    Route::post('block/{id}', [AdminController::class, 'blockContract']);
    Route::post('promo/{id}', [AdminController::class, 'updatePromo']);
    Route::post('create/promo', [AdminController::class, 'createPromo']);
    Route::get('all/promo', [AdminController::class, 'getPromo']);
    Route::get('delete/promo/{id}', [AdminController::class, 'deletePromo']);
});

Route::get('/feed', [RSSFeedController::class, 'feedRSS']);

Route::controller(PasswordController::class)->group(function () {
    // Маршруты запроса ссылки для сброса пароля
    Route::get('/forgot-password', 'getEmail');
    Route::post('/forgot-password', 'postEmail')->middleware('guest')->name('forgot');
    Route::post('/confirm-reset-password', 'resetPasswordAuth');

    // Маршруты сброса пароля
    Route::get('/reset/{token}', 'getReset')->middleware('guest')->name('password.reset');
    Route::get('/reset', 'notReset')->middleware('guest');
    Route::post('/reset', 'postReset')->middleware('guest');
});

Route::controller(AuthController::class)->group(function () {
    // Авторизация и Регистрация
    Route::get('/', 'home')->name('index');
    Route::match(['get', 'post'], '/signin', 'Signin')->name('signin');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/login', 'login')->name('login');
    Route::get('/signup', 'register')->name('signup');
});

// Оформление заказа для незарегистрированных пользователей
Route::controller(OrderController::class)->group(function () {
    Route::get('/order/{uuid?}', 'Order')->name('userorder');
    Route::post('/checkout', 'Checkout');
});


Route::controller(MainController::class)->group(function () {
    Route::get('/card', 'Card');
    Route::get('/test', 'Test');
    Route::get('/about', 'About');
    Route::get('/production', 'Production');
    Route::get('/shipper', 'Shipper');
    Route::get('/developers', 'Developers');
    Route::get('/partner', 'Partner');
    Route::post('/product', 'Product');
    Route::get('/contact', 'Сontact');
    Route::get('/customers', 'Customers');
    Route::get('/doc', 'Documentation');
    Route::get('/products/mercedes-benz/{limit?}/{offset?}', 'Catalog')->name('search');
    Route::get('/stock/{id}/{limit?}/{offset?}', 'stockFolder');
    Route::get('/product/mercedes-benz/{id}', 'DetailProduct');
    Route::get('/product', 'NoProduct');
    Route::get('/promotion', 'Promotion');
});

Route::prefix('doc')->group(function () {
    // Страницы с Юр.документами
    Route::get('license', [MainController::class, 'License']);
    Route::get('responsibility', [MainController::class, 'Responsibility']);
    Route::get('privatepolice', [MainController::class, 'Private']);
    Route::get('return-policy', [MainController::class, 'ReturnPolicy']);
    Route::get('guaranty', [MainController::class, 'Guaranty']);
});