<?php

namespace App\Models;

use Shuchkin\SimpleXLSX;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Goods;


class Excel
{

    public static function parse($path, $sheet = false)
    {
        if ( $xlsx = SimpleXLSX::parse($path) ) {
            return $sheet ? $xlsx->sheetNames() : $xlsx->rows();
        } else {
            return false;
            //SimpleXLSX::parseError();
        }
    }


    public static function reader($file)
    {
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        return $worksheet;
    }


    public static function loading($request)
    {
        // http://prospektrans.host/api/array/pack
        return setcookie("Pack", $request, time()+3600);
    }


    public static function insert($db)
    {
        try {
            DB::transaction(function() use ($db) {
                foreach($db as $item) {
                    //updateOrInsert updateOrCreate
                    Goods::updateOrCreate(
                        ['article' => $item['article']], 
                    [
                        'link' => $item['id'],
                        'image' => '',
                        //'article' => $item['article'],
                        'name' => $item['name'],
                        'description' => isset($item['description']) ? $item['description'] : '',
                        'price' => $item['salePrices'][0]['value'],
                        'quantity' => $item['volume']
                    ]);            
                }
            },3);  //3 но зачем)? Повторить три раза, прежде чем признать неудачу
            DB::commit();
            return [
                'type' => 'success',
                'header' => 'Успешно!',
                'message' => ' Данные обновлены и записаны в базу данных.'
            ];
        } catch (\Exception $exception) {
            return [
                'type' => 'danger',
                'header' => 'Ошибка: ',
                'message' => $exception
            ];
        }

    }

}