<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;


class Telegram 
{

    public static function layout($num, $product, $link, $type = '')
    {
        switch ($type) {
            case 'ticket':
                return self::ticket($num, $product, $link);
                break;
            case 'neworder':
                return self::neworder($num, $product, $link);
                break;
            case 'spares':
                return self::spares($num, $product, $link);
                break;
            case 'сheckout':
                return self::сheckout($num, $product, $link);
                break;
            case 'preсheckout':
                return self::preсheckout($num, $product, $link);
                break;
            case 'manager':
                return self::manager($num, $product, $link);
                break;
            case 'counterparty':
                return self::counterparty($num, $product, $link);
                break;
            default:
                return self::product($num, $product, $link);
        }
    }

    public static function neworder($num, $product, $link)
    {
        $msd = '<b>Новый заказ №'.$product.'</b>'.PHP_EOL.
        '------'.PHP_EOL.
        'Покупатель: '.$link['name'].PHP_EOL.
        'E-mail: '.$link['email'].PHP_EOL.
        'Телефон: '.$link['phone'].PHP_EOL.
        '------'.PHP_EOL.
        '<a href="https://prospekt-parts.com/dashboard/payment/reports/'.$num.'">[Подробнее]</a>';
        //'<a href="https://online.moysklad.ru/app/#Company/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }

    public static function counterparty($num, $product, $link)
    {
        $msd = '<b>Зарегистрировалась новая компания</b>'.PHP_EOL.
        '<i>'.$product.'</i>'.PHP_EOL.
        'E-mail адрес: '.$link.PHP_EOL.
        '------'.PHP_EOL.
        '<a href="https://online.moysklad.ru/app/#Company/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }

    public static function manager($num, $product, $link)
    {
        $msd = '<b>Вопрос менеджеру #'.time().
        ' <a href="https://online.moysklad.ru/app/#customerorder/edit?id='.$num.'">по заказу</a></b>'.PHP_EOL.
        '------'.PHP_EOL.
        PHP_EOL.$product.PHP_EOL.
        '<a href="https://online.moysklad.ru/app/#Company/edit?id='.$link.'">[Подробнее]</a>';
        return $msd;
    }

    public static function preсheckout($num, $product, $link)
    {
        $msd = '<b>Предаказ #'.$product.'</b>'.PHP_EOL.
        '------'.PHP_EOL.
        'Дата: '.date('d.m.Y | H:i').PHP_EOL.
        '==========.'.PHP_EOL.
        '<a href="https://online.moysklad.ru/app/#internalorder/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }

    public static function сheckout($num, $product, $link)
    {   
        $msd = '<b>Заказ #'.$product.'</b>'.PHP_EOL.
        '------'.PHP_EOL.
        'Дата: '.date('d.m.Y | H:i').PHP_EOL.
        'На вашем сервисе '.config('app.name').' был оформлен заказ товаров.'.PHP_EOL.
        '<a href="https://online.moysklad.ru/app/#customerorder/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }
    
    public static function spares($num, $product, $link)
    {
        $msd = '<b>Заказ #'.time().'</b>'.PHP_EOL.
        '------'.PHP_EOL.
        '<b>VIN номер:</b> '.$link.PHP_EOL.PHP_EOL.
        '<b>Сообщение:</b>'.PHP_EOL.$product.PHP_EOL.
        '<a href="https://online.moysklad.ru/app/#Company/edit?id='.$num.'">[Подробнее]</a>';
        return $msd;
    }

    public static function ticket($num, $product, $link)
    {
        $msd = '<b>Тикет #'.$num.'</b>'.PHP_EOL.
        '<b>Сообщение:</b>'.PHP_EOL.$product.PHP_EOL.
        '<a href="https://prospekt-parts.com/dashboard/product/details/'.$link.'">[Подробнее]</a>';
        return $msd;
    }

    public static function product($num, $product, $link)
    {
        $msd = '<b>Запрос #'.$num.'</b>'.PHP_EOL.
        '<b>Информация:</b>'.PHP_EOL.$product.PHP_EOL.
        '<a href="https://online.moysklad.ru/app/#Contract/edit?id='.$link.'">[Подробнее]</a>';
        return $msd;
    }

    public static function getMessageTelegram($num, $product, $link, $type = '')
    {
        $msd = self::layout($num, $product, $link, $type);
        $url = config('app.tg_url').config('app.tg_apikey').'/sendMessage';
        $response = Http::asForm()->post($url, [
            'text' => htmlspecialchars_decode($msd),
            'chat_id' => -1002004240593,    
            'parse_mode' => 'HTML'
            
        ]);
        //return $response;
        // Записать ответ для отладки
    \Log::info('Ответ от Telegram API: ' . $response);
    return $response;
    }

}