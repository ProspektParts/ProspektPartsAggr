<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\MakeContract;
use App\Http\Requests\SettingEdit;
use App\Http\Requests\CounterAgent;
use App\Models\Card;
use App\Models\Contract;
use App\Models\Telegram;
use App\Models\MoySklad;
use App\Models\DaData;
use App\Models\Goods;
use App\Models\User;
use App\Models\Steames;



class DachboardController extends Controller
{

    public function Dashboard()
    {
        $uuid = auth()->user()->verified;
        if(isset($uuid)) {
            Card::giveAccess($uuid);
        }
        return view('dashboard');
    }


    public function arrayPack($request) // Request 
    {
        return setcookie("Pack", $request, time()+3600);
    }

    
    public function preOrderViewOne($id)
    {
        $pre = MoySklad::viewOnePreOrder($id);
        return view('dashboard.payment.preorder-detail', ['id' => $id, 'pre' => $pre]);
    }


    public function preOrders()
    {
        $order = MoySklad::viewAllPreOrders();
        // return response()->json($order);
        return view('dashboard.payment.preorders', ['order' => $order]);
    }


    public function createInvoice(Request $request)
    {
        MoySklad::createInvoiceout($request->id);
        $message = 'Счёт выставлен';
        return redirect()->route('orders')->with(['message' => $message]);
    }


    public function noSearch()
    {
        return redirect()->route('dashboard');
    }


    public function RecordDetail($id)
    {
        $demand = MoySklad::getOneDemand($id);
        return view('dashboard.payment.demand', ['id' => $id, 'demand' => $demand]);
    }


    public function EditSettings(SettingEdit $request)
    {
        $request->validate(SettingEdit::rules());
        $message = 'Настройки обновлены.';
        MoySklad::editSetting($request);
        return redirect()->route('settings')->with(['message' => $message]);
    }


    public function resultSearch(Request $request)
    {
        $request->validate(['text' => 'required']); // поиск по артиклу
        $search = MoySklad::searchAssortmentByArticle($request->text);
        $error = 'Слишком короткий запрос, укажите более точные данные';
        if(strlen($request->text) > 2) {
            return view('dashboard.result.search', ['search' => $search, 'text' => $request->text]);
        }
        return view('dashboard.result.search', ['text' => $request->text, 'error' => $error]);
    }


    public function searchDashboard(Request $request)
    {
        $request->validate([
            'type' => 'nullable',
            'text' => 'required',
        ]);
        $url = Steames::getListResult($request->text);
        $search = MoySklad::searchOfResult($url);
        $text = $request->input('text');
        //return response()->json($search);
        return redirect()->route('dashboard')->with(['search' => $search, 'text' => $text]);
    }


    public function Settings()
    {
        $uuid = auth()->user()->verified;
        $profile = MoySklad::getCompany($uuid);
        //return response()->json($profile);
        return view('dashboard.profile.settings', ['profile' => $profile]);
    }


    public function Events() 
    {
        return view('dashboard.events');
    }


    public function Schedule() 
    {
        return view('dashboard.work.schedule');
    }


    public function Help() 
    {
        return view('dashboard.help');
    }


    public function Notifications() 
    {
        return view('dashboard.notifications');
    }


    public function Invoice($invoice) 
    {
        $order = MoySklad::getInvoiceOne($invoice);
        //return response()->json($order);
        return view('dashboard.payment.order', [
            'order' => $order, 
            'id' => $invoice
        ]);
    }


    public function Account() 
    {
        return view('dashboard.account');
    }

    public function updateAgreement(MakeContract $request)
    {
        $uuid = auth()->user()->verified;
        $message = 'Данные договора обновлены. Пожалуйста, сверьте данные и подтвердите.';
        $doc = Contract::updateOrCreate(['uuid' => $uuid], $request->all());
        $contract = MoySklad::createAccoutFromAgent($uuid, $request->all());
        return redirect()->route('contract')->with(['status' => $message]);
    }


    public function sendAgreement(MakeContract $request)
    {
        $message = 'Ваш запрос на заключение договора получен. Пожалуйста, сверьте данные и подтвердите.';
        $request->validate(MakeContract::rules());
        $contract = MoySklad::getContract();
        if(isset($contract['id'])) {
            Telegram::getMessageTelegram(time(), 'Запрос на заключение договора.', $contract['id']);
            Contract::create($request->all()); 
            return back()->with(['status' => $message]);            
            //$message = 'Не удалось создать договор. Свяжитесь с менеджером.';
            //return back()->with(['error' => $message]);
        }
        MoySklad::createContract();
        return back();
    }
    
    
    public function Checkout(Request $request)
    {
        $message = 'Ваш заказ получен.';
        $account = MoySklad::getCheckout($request->name);
        if(isset($account['id'])) {
            Telegram::getMessageTelegram($account['id'], $account['name'], '', 'сheckout');
            return redirect()->route('card')->with(['status' => $message, 'id' => $account['id']]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Не удалось создать заказ.']);
        }
    }


    public function sendDeal(Request $request)
    {
        $uuid = auth()->user()->verified;
        $message = 'Договор составлен, теперь его можно сохранить или распечатать.';
        $deal = new Card;
        $deal->user_id = $uuid;
        $deal->save();
        // MoySklad::enterIntoAcontract($request->deal, $request->accountId);
        return redirect()->route('contract')->with(['status' => $message]);
    }


    public function EditAgreement()
    {
        $uuid = auth()->user()->verified;
        $contract = Contract::find($uuid);
        return view('document.edit-agreement', ['contract' => $contract]);
    }


    public function Agreement() 
    {
        $contract = MoySklad::getContract();
        //return response()->json($contract);
        return view('document.agreement', ['contract' => $contract]);
    }


    public function Record() 
    {
        $demand = MoySklad::getDemand();
        return view('dashboard.payment.record', ['demand' => $demand]);
    }


    public function DetailProduct($id, Request $request)
    {
        if ($request->has(['name', 'phone'])) {
            Telegram::getMessageTelegram($request->num, $request->message, $request->id);
            return back()->with(['status' => 'Ваш тикет отправлен и получен. Ожидайте ответа от менеджера']);
        }
        $image = Goods::where('link', $id)->get();
        
        $product = MoySklad::getOneProduct($id);

        Goods::updateOrCreate(
            ['article' => $product['article']],
            [
                'name' => $product['name'],
                'link' => $product['id'],
                'article' => $product['article'],
                'price' => $product['salePrices'],
                'quantity' => $product['quantity']
            ]
        );

        return view('dashboard.product.details', compact('id', 'product', 'image' ));
    }


    public function CatalogDetail($name, $limit = 10, $offset = 0)
    {
        $product = MoySklad::getAllProduct($limit, $offset);
        //return response()->json($product);
        return view('dashboard.catalog-detail', [
            'name' => $name,
            'product' => $product,
            'limit' => $limit, 
            'offset' => $offset
        ]);
    }


    public function ReportsDetail($order)
    {
        $response = MoySklad::getPaymentReports($order);
        //return response()->json($response);
        return view('dashboard.payment.reports-detail', [
            'data' => $response,
            'order' => $order
        ]);
    }


    public function Сard()
    {
        return view('dashboard.сard');
    }


    public function Reports()
    {
        $reports = MoySklad::getReports();
        //return response()->json($reports);
        return view('dashboard.payment.reports', ['reports' => $reports]);
    }
    

    public function SendSpares(Request $request)
    {
        $uuid = auth()->user()->verified;
        Telegram::getMessageTelegram($uuid, $request->spares, $request->vin, 'spares');
    }


    public function preCheckout(Request $request)
    {
        $message = 'Ваш предзаказ оформлен.';
        $account = MoySklad::getPreCheckout($request->name);
        if(isset($account['id'])) {
            Telegram::getMessageTelegram($account['id'], $account['name'], '', 'preсheckout');
            return redirect()->route('account')->with(['status' => $message, 'id' => $account['id']]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Не удалось создать предзаказ.']);
        } 
    }

    // getUPDfileExport($id)
    public function getUPD(Request $request)
    {
        $pdf = MoySklad::getUPDfileExport($request->name);
        if($pdf) {
            return redirect()->route('record')->with(['pdf' => $pdf]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Не удалось получить УПД']);
        }
    }


    public function addedCounterAgent(CounterAgent $request)
    {
        $request->validate(CounterAgent::rules());
        $account = MoySklad::getContrAgent($request->company);
        $message = 'На ваш email: "'.$request->email.'" была отправлена важная информация. Пожалуйста, ознакомьтесь.';
        $error = 'Не удалось зарегистрировать.';
        sleep(2);
        if(isset($account['id'])) {
            Telegram::getMessageTelegram($account['id'], $account['name'], $request->email, 'counterparty');
            return redirect()->route('signin')->with(['signup' => $message, 'id' => $account['id']]);
        }
        return redirect()->route('signin')->with(['error' => $error]);
    }
    

    public function Orders() 
    {
        $orders = MoySklad::getInvoices();
        return view('dashboard.payment.orders', ['orders' => $orders]);
    }


    public function Manager(Request $request)
    {
        $message = 'Ваш запрос получен.';
        $uuid = auth()->user()->verified;
        Telegram::getMessageTelegram($request->reports, $request->message, $uuid, 'manager');
        return redirect()->route('order')->with(['status' => $message]);
    }


    public function Description(Request $request)
    {
        $request->validate([
            'uuid' => 'required',
            'description' => 'required'
        ]);
        $uuid = $request->input('uuid');
        Goods::updateOrCreate(['link' => $uuid], ['description' => $request->description]);
        return redirect('/dashboard/product/details/'.$uuid)->with(['text' => 'Описание обновлено']);
    }


    public function Users()
    {
        $model = User::all();
        return view('dashboard.users', ['model' => $model]);
    }


    public function Accounts($limit = 15, $offset = 0)
    {
        $model = MoySklad::getAllInvoices($limit, $offset);
        //return response()->json($model);
        return view('dashboard.accounts', ['model' => $model, 'limit' => $limit, 'offset' => $offset]);
    }


    public function OrdersList()
    {
        $model = MoySklad::getAllReports();
        //return response()->json($model);
        return view('dashboard.orders', ['model' => $model]);
    }

    
    public function OrdersListDelete($uuid)
    {
        $message = 'Заказ удалён';
        MoySklad::deleteOrderPosition($uuid);
        return redirect()->route('allorders')->with(['status' => $message]);
    }


    public function AgentDelete($uuid)
    {
        $message = 'Заказ удалён';
        MoySklad::deleteAgent($uuid);
        return redirect()->route('adminusers')->with(['status' => $message]);
    }

}