<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Checkout;
use Illuminate\Support\Facades\Mail;
use App\Models\MoySklad;
use App\Models\Telegram;
use App\Mail\VerifyEmail;


class OrderController extends Controller
{

    public function Checkout(Checkout $request)
    {
        $request->validate(Checkout::rules());
        $code = strval(rand(1000, 9999));
        $res =[ 
            'counterparty' => [
                'name' => $request->name,
                'code' => $code,
                'companyType' => 'individual',
                'email' => $request->email,
                'phone' => $request->phone,
                'actualAddress' => $request->address == '' ? '...' : $request->address,
                'legalAddress' => $request->address == '' ? '...' : $request->address,
                'tags' => [  
                    'незарегистрированный', 
                    'пользователь'
                ],
            ]
        ];
        $user = MoySklad::newUserAlien($res['counterparty']);
        if($user) {
            $result = MoySklad::getNewOrderFromGuest($user['id'], $request->сheckout);
            Mail::to($request->email)->send(new VerifyEmail($result));
            Telegram::getMessageTelegram($result['id'], $result['name'], $res['counterparty'], 'neworder');
            return redirect()->route('userorder')->with(
                [
                    'data' => $res['counterparty'], 
                    'order' => $result['name'],
                    'id' => $result['id']
                ]
            );
            //return response()->json($result['id']);
            return redirect()->route('userorder')->with(['error' => 'Не удалось отправить заказ']);
        }
    }

    public function Order($uuid = '')
    {
        if($uuid) {
            $order = MoySklad::newOrderView($uuid);
            return view('order', compact('order'));            
        }
        return view('order');
    }
    
}
